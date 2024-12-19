<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Barang;
use App\Models\ModelPemesananDetail;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Config\Services;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Ramsey\Uuid\Uuid;

class PaymentController extends BaseController
{
    protected $userId;

    public function __construct()
    {
        $this->userId = session()->get('user_id');
    }

    public function show($idpemesanan)
    {
        $MDP = new ModelPemesananDetail();
        $MP = new Pemesanan();
        $MBayar = new Pembayaran();
        $hargatotal = $MP->where('id', $idpemesanan)->first();
        // dd($idpemesanan);
        $pembayaran = $MBayar->where('pemesanan_id', $idpemesanan)->first();
        if ($pembayaran['status'] == 0) {
            $MBayar->where('pemesanan_id', $idpemesanan)->set([
                'status' => 1,
                'method' => 'QRIS'
            ])->update();
        }
        $pemesanan = $MDP->select('pemesanandetail.*, barang.name as name, pembayaran.method as paymentMethod')
            ->join('pembayaran', 'pembayaran.pemesanan_id = pemesanandetail.pemesanan_id')
            ->join('barang', 'barang.id = pemesanandetail.barang_id', 'left')
            ->where('pemesanandetail.pemesanan_id', $idpemesanan)
            ->findAll();
        // dd($pemesanan[0]['paymentMethod']);

        return view('payment-summary', [
            'pemesanan' => $pemesanan,
            'hargatotal' => $hargatotal,
        ]);
    }

    public function insert()
    {

        if (!$this->userId) {
            return $this->response->setJSON([
                'error' => 'User not logged in. Please log in first.'
            ])->setStatusCode(401);
        }

        $client_key = 'SB-Mid-client-b-Yef8fUz-ErQiF4';
        $server_key = 'SB-Mid-server-_NkQGyqngmtD9V1m2fJWlw1M';
        // $merchant = '(myMerchantId)';
        // $client_key = '(my client id)';
        // $server_key = '(my server id)';

        Config::$clientKey = $client_key;
        Config::$serverKey = $server_key;
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $order_id = Uuid::uuid4()->toString();
        $userModel = new User();
        $barangModel = new Barang();
        $sessuserId = session()->get('user_id');
        $userId = $userModel->find($sessuserId);
        $request = $this->request;
        $method = $request->getPost('method');
        $full_name = $request->getPost('full_name');
        $email = $request->getPost('email');
        $phone = $request->getPost('phone');

        $cart = json_decode($this->request->getCookie('cart'), true);

        $total_amount = 0;
        $item_details = [];
        $pemesananDetail = new ModelPemesananDetail();
        $pemesananModel = new Pemesanan();

        $pemesananData = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $this->userId,
            'total_price' => null,
            'status' => 'pending',
        ];

        $pemesananModel->insert($pemesananData);

        $ambilIdPemesanan = $pemesananData['id'];
        foreach ($cart as $item) {
            $quantity = $item['quantity'];
            $price = $item['id']['price'];
            $total_amount += $quantity * $price;

            $pemesananDetail->insert([
                'id' => Uuid::uuid4()->toString(),
                'pemesanan_id' => $ambilIdPemesanan,
                'barang_id' => $item['id']['id'],
                'quantity' => $quantity,
                'price' => $price,
            ]);

            $item_details[] = [
                'id' => $item['id']['id'],
                'price' => $price,
                'quantity' => $quantity,
                'name' => $item['id']['name'],
            ];
            $stok_barang = $barangModel->where('id',$item['id']['id'])->first()['stock'];
            $barangModel->update($item['id']['id'],[
                'stock' => $stok_barang-$quantity
            ]);

        }

        $pemesananModel->where('id', $ambilIdPemesanan)->set(['total_price' => $total_amount])->update();

        $snapPayload = [
            'transaction_details' => [
                'order_id' => $ambilIdPemesanan,
                'gross_amount' => $total_amount,
            ],
            'customer_details' => [
                'first_name' => $full_name,
                'email' => $email,
                'phone' => $phone,
            ],
            'callbacks' => [
                'finish' => base_url('/payment-summary/' . $ambilIdPemesanan),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($snapPayload);

            log_message('debug', 'Payload: ' . json_encode($snapPayload));
            log_message('debug', 'Snap Token: ' . $snapToken);
            log_message('debug', 'Total Price: ' . $total_amount);
            log_message('debug', 'Id Pemesanan: ' . $ambilIdPemesanan);

            $pembayaranModel = new Pembayaran();
            $pembayaranModel->insert([
                'id' => Uuid::uuid4()->toString(),
                'pemesanan_id' => $ambilIdPemesanan,
                'method' => null,
                'status' => 0,
                'jumlah' => $total_amount,
                'payment_date' => Time::now()->toDateString(),
            ]);

            return $this->response->setJSON(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function update($param = null)
    {
        log_message('debug', 'User ID: ' . json_encode($this->userId));
        if (!$this->userId) {
            return $this->response->setJSON(['error' => 'User not logged in. Please log in first.'])->setStatusCode(401);
        }

        $requestData = $this->request->getJSON(true);
        $orderId = $requestData['order_id'] ?? null;

        if (!$orderId) {
            return $this->response->setJSON(['error' => 'Order ID is required'])->setStatusCode(400);
        }

        log_message('debug', 'Order ID: ' . $orderId);

        $pemesananModel = new Pemesanan();
        $pemesananDetailModel = new ModelPemesananDetail();

        $order = $pemesananModel->find($orderId);
        if (!$order) {
            return $this->response->setJSON(['error' => 'Order not found'])->setStatusCode(404);
        }

        $orderDetails = $pemesananDetailModel->where('pemesanan_id', $orderId)->findAll();

        if (empty($orderDetails)) {
            return $this->response->setJSON(['error' => 'Order details not found'])->setStatusCode(404);
        }

        log_message('debug', 'Order Details: ' . json_encode($orderDetails));

        $client_key = 'SB-Mid-client-b-Yef8fUz-ErQiF4';
        $server_key = 'SB-Mid-server-_NkQGyqngmtD9V1m2fJWlw1M';
        Config::$clientKey = $client_key;
        Config::$serverKey = $server_key;
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Prepare Snap Payload
        $snapPayload = [
            'transaction_details' => [
                'order_id' => $order['id'],
                'gross_amount' => $order['total_price'],
            ],
            'item_details' => array_map(function ($detail) {
                return [
                    'id' => $detail['barang_id'],
                    'price' => $detail['price'],
                    'quantity' => $detail['quantity'],
                    'name' => 'Item ' . $detail['barang_id'], 
                ];
            }, $orderDetails),
            'customer_details' => [
                'first_name' => session()->get('full_name'),
                'email' => session()->get('email'),
                'phone' => session()->get('phone'),
            ],
            'finish' => base_url('/payment-verify/' . $orderId),
        ];

        try {
            log_message('debug', 'Snap Payload: ' . json_encode($snapPayload));

            $snapToken = Snap::getSnapToken($snapPayload);

            log_message('debug', 'Snap Token: ' . $snapToken);

            return $this->response->setJSON(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            log_message('error', 'Error Generating Snap Token: ' . $e->getMessage());
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }
    }


    public function verify($idPemesanan)
    {
        $serverKey = 'SB-Mid-server-_NkQGyqngmtD9V1m2fJWlw1M';
        $signatureKey = $this->request->getHeaderLine('X-Signature-Key');

        $input = $this->request->getJSON(true);
        $generatedKey = hash('sha512', $input['order_id'] . $input['status_code'] . $input['gross_amount'] . $serverKey);

        if ($generatedKey !== $signatureKey) {
            return $this->response->setJSON(['error' => 'Invalid Signature'])->setStatusCode(403);
        }

        $status = $input['transaction_status'];
        $pembayaranModel = new Pembayaran();

        if ($status === 'settlement') {
            $pembayaranModel->where('pemesanan_id', $idPemesanan)->set(['status' => 1])->update();
        } else {
            $pembayaranModel->where('pemesanan_id', $idPemesanan)->set(['status' => 0])->update();
        }

        return $this->response->setJSON(['message' => 'Payment status updated successfully.']);
    }
}
