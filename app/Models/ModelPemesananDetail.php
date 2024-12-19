<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPemesananDetail extends Model
{
    // Define the table name
    protected $table = 'pemesanandetail';
    protected $useAutoIncrement = false;


    // Define the primary key for the table
    protected $primaryKey = 'id';

    // Define which fields can be inserted or updated
    protected $allowedFields = [
        'id',
        'pemesanan_id',
        'barang_id',
        'quantity',
        'price',
    ];

    protected $useTimestamps = false;

    protected $returnType = 'array'; // Return results as an array
    protected $useSoftDeletes = false;

    public function getPemesananDetails($pemesananId)
    {
        return $this->select('pemesanandetail.*, barang.name as barang_name, barang.image_path as barang_image')
            ->join('barang', 'barang.id = pemesanandetail.barang_id', 'left')
            ->where('pemesanandetail.pemesanan_id', $pemesananId)
            ->findAll();  // Use first() to return a single record
    }

    public function getBarangDetails($barangId)
    {
        return $this->where('barang_id', $barangId)->findAll();
    }
}
