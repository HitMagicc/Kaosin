<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Pemesanan;
use App\Models\ModelPemesananDetail;
use App\Models\Pembayaran;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/index');
    }
    public function category(){
        return view('admin/kategori/index');
    }
    public function barang(){
        return view('admin/barang/index');
    
    }
    public function AllUser(){
        return view('admin/user/index');
    }
    public function allOrders(){
        $PemesananModel = new Pemesanan();

        $pemesanan = $PemesananModel->getAllWithUserAndQuantity();
        // dd($pemesanan);
        return view('admin/orders/index',['pemesanan'=> $pemesanan]);
    }
    public function orderDetail($id)
    {
        $pemesananModel = new Pemesanan();
        $pemesananDetailModel = new ModelPemesananDetail();

        // Fetch the pemesanan record by ID
        $pemesanan = $pemesananModel
            ->select('pemesanan.*, users.username as buyer_name, SUM(pemesanandetail.quantity) as total_quantity')
            ->join('users', 'users.id = pemesanan.user_id', 'left') // Join with the users table
            ->join('pemesanandetail', 'pemesanandetail.pemesanan_id = pemesanan.id', 'left') // Join with pemesanandetail
            ->where('pemesanan.id', $id)
            ->groupBy('pemesanan.id')
            ->first();

        if (!$pemesanan) {
            return redirect()->to('/admin/orders')->with('error', 'Order not found.');
        }

        // Fetch the pemesanan details with barang info
        $pemesananDetails = $pemesananDetailModel->getPemesananDetails($id);

        // Pass all data to the view
        return view('admin/orders/detail', [
            'pemesanan' => $pemesanan,
            'pemesananDetails' => $pemesananDetails
        ]);
    }
    public function ordersStatus($id){
        $MP = new Pemesanan();
        $MP->update($id,['status'=>"Success"]);
        return redirect()->to('/admin/orders/detail/'.$id)->with('message', 'Order status updated successfully.');
    }
    public function ordersDelete($id){
        $MP = new Pemesanan();
        $MPD = new ModelPemesananDetail();
        $MBayar = new Pembayaran();

        $MBayar->delete('pemesanan_id',$id);
        $MPD->where('pemesanan_id',$id)->delete();
        $MP->where('id', $id)->delete();
        return redirect()->to('admin/orders')->with('message', 'Order status updated successfully.');

    }
    public function allPayment(){
        $pembayaranModel = new Pembayaran();

        $dataPembayaran = $pembayaranModel->findAll();
        return view('admin/payment/index', ['datapembayaran'=>$dataPembayaran]);    
    }
    public function paymentDetail($id){
        $pembayaranModel = new Pembayaran();
        $dataPembayaran = $pembayaranModel->getAllWithUser($id);
        return view('admin/payment/detail', ['datapembayaran'=>$dataPembayaran]);
    }
}
