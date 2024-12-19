<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\Pembayaran;
use CodeIgniter\HTTP\ResponseInterface;

class CartController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $cartData = $this->request->getCookie('cart');
        $barangModel = new BarangModel();

        if ($cartData) {
            $cart = json_decode($cartData, true);
            // dd($cart);
            if ($userId) {
                $cart = array_filter($cart, function ($item) use ($userId) {
                    return isset($item['id']) && $item['id']['user_id'] === $userId;
                });
            }
            
            $prod = array_column($cart, 'id');
            $productIds = array_column($prod,'id');
            
            if (!empty($productIds)) {
                $validProducts = $barangModel->whereIn('id', $productIds)->findAll();
                
                $validProductIds = array_column($validProducts, 'id');
                
                $cart = array_filter($cart, function ($item) use ($validProductIds) {
                    // dd($item['id']['id']);
                    return in_array($item['id']['id'], $validProductIds);
                });
            } else {
                $cart = [];
            }
        } else {
            $cart = [];
        }
        return view('cart', ['cart' => $cart]);
    }



    public function updatePembayaran()
    {
        $request = $this->request->getJSON(); // Get JSON data from the request
        $orderId = $request->order_id; // Extract the order ID

        if (!$orderId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Order ID is required']);
        }

        $pembayaranModel = new Pembayaran();

        // Update the status in the database
        $updateSuccess = $pembayaranModel->update($orderId, ['status' => 1]); // Set status to 1 (paid)

        if ($updateSuccess) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update payment status']);
        }
    }
}
