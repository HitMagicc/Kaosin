<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\User;

use CodeIgniter\HTTP\ResponseInterface;
use Midtrans\Notification;

class ProfileController extends BaseController
{
    public function index()
    {

        $userModel = new User();
        $pembayaranModel = new Pembayaran();
        $pemesananModel = new Pemesanan();

        $getId = session()->get('user_id');
        $profile = $userModel->find($getId);

        $pemesanan = $pemesananModel
            ->where('user_id', $getId)
            ->findAll();

        $data = $pembayaranModel
            ->select('pemesanan.user_id, pemesanan.id as pemesanan_id, pembayaran.status, pembayaran.jumlah, pemesanandetail.barang_id, pemesanandetail.quantity, barang.name as barang_name')
            ->join('pemesanan', 'pemesanan.id = pembayaran.pemesanan_id')
            ->join('pemesanandetail', 'pemesanandetail.pemesanan_id = pemesanan.id')
            ->join('barang', 'barang.id = pemesanandetail.barang_id')
            ->where('pemesanan.user_id', $getId)
            ->findAll();

        $groupedData = [];

        // Group data by pemesanan_id
        foreach ($data as $row) {
            $pemesananId = $row['pemesanan_id'];

            if (!isset($groupedData[$pemesananId])) {
                $groupedData[$pemesananId] = [
                    'user_id' => $row['user_id'],
                    'status' => $row['status'],
                    'jumlah' => $row['jumlah'],
                    'items' => [] 
                ];
            }

            $groupedData[$pemesananId]['items'][] = [
                'barang_id' => $row['barang_id'],
                'quantity' => $row['quantity'],
                'barang_name' => $row['barang_name']
            ];
        }
        $pemesananIds = array_keys($groupedData);
        $snapToken = session()->get('snapToken');

        return view('/profile', [
            'profile' => $profile,
            'groupedData' => $groupedData,
            'pemesananIds'=>$pemesananIds,
            'snapToken'=>$snapToken
        ]);
    }

}
