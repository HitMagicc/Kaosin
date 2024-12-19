<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'price', 'desc', 'kategori_id', 'stock','image_path', 'created_at', 'updated_at', 'deleted_at'];
    protected $useTimestamps = true;
    protected $useAutoIncrement=false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getKategori($kategoriId)
    {
        return $this->where('kategori_id', $kategoriId)->findAll();
    }
    public function  index(){
        $barangModel = new Barang();

    }
    public function getBarangByKategori($kategoriId)
    {
        return $this->where('kategori_id', $kategoriId)->findAll();
    }

    // Fetch all barang records, joining with kategori for kategori name
    public function getAllBarangWithKategori()
    {
        return $this->join('kategori', 'kategori.id = barang.kategori_id', 'left')
                    ->select('barang.*, kategori.Name as kategori_name, kategori.Sex as kategori_sex')
                    ->findAll();
    }
    public function getBarangBySex($sex)
    {
        return $this->select('barang.*, kategori.Name AS kategori_name')
                    ->join('kategori', 'kategori.id = barang.kategori_id') // Join with the Kategori table
                    ->where('kategori.Sex', $sex) // Filter by Sex
                    ->findAll(); // Fetch all matching products
    }
    public function getBarangWithSexAndType($sex,$name)
    {
        return $this->join('kategori', 'kategori.id = barang.kategori_id', 'left')
        ->select('barang.*, kategori.Name as kategori_name, kategori.Sex as kategori_sex')
        ->where('kategori.Sex', $sex)
        ->where('kategori.Name', $name)
        ->findAll();
    }

        public function getBarangMasukHariIni()
    {
        return $this->join('kategori', 'kategori.id = barang.kategori_id', 'left') // Ganti 'barang.category_id' menjadi 'barang.kategori_id' jika sesuai
                    ->select('barang.*, kategori.Name as kategori_name')
                    ->where('DATE(barang.created_at)', date('Y-m-d'))
                    ->findAll();
    }

    
    

    


}
