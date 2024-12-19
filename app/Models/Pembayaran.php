<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'pemesanan_id', 'method', 'status', 'jumlah', 'payment_date'];
    protected $useTimestamps = false;
    public function updateStatus($orderId, $status)
    {
        return $this->update($orderId, ['status' => $status]);
    }
    public function getAllWithUser($id)
    {
        return $this->select('pembayaran.*, pemesanan.*, users.full_name as user_name')  
        ->join('pemesanan', 'pemesanan.id = pembayaran.pemesanan_id', 'left')  
        ->join('users', 'users.id = pemesanan.user_id', 'left')
        ->where('pembayaran.id', $id) 
        ->first();
    }
}
