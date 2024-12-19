<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'user_id', 'total_price', 'status'];
    protected $useTimestamps = false;

    public function getAllWithUser()
    {
        return $this->select('pemesanan.*, users.username as buyer_name')
            ->join('users', 'users.id = pemesanan.user_id', 'left')
            ->findAll();
    }
    public function getAllWithUserAndQuantity()
    {
        return $this->select('pemesanan.*, users.full_name as buyer_name, SUM(pemesanandetail.quantity) as total_quantity')
            ->join('users', 'users.id = pemesanan.user_id', 'left') // Join with the users table
            ->join('pemesanandetail', 'pemesanandetail.pemesanan_id = pemesanan.id', 'left') // Join with the pemesanandetail table
            ->groupBy('pemesanan.id, users.full_name') // Group by pemesanan ID to calculate totals
            ->findAll();
    }
}
