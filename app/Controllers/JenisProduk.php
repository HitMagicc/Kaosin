<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Barang;
use App\Models\Kategori;
class JenisProduk extends BaseController
{
    public function index()
    {
        return view('type-list');
    }
    public function viewBarangBySexAndJenis($sex, $jenis)
    {
        $barangModel = new Barang();
        $kategoriModel = new Kategori();

        // Get the category ID based on `sex` and `jenis`
        $kategori = $kategoriModel
            ->where('Sex', $sex)
            ->where('Jenis', $jenis)
            ->first();

        if (!$kategori) {
            // If the category does not exist, show a 404 error
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "No category found for Sex: $sex and Jenis: $jenis"
            );
        }

        // Fetch all barang (products) matching this category
        $products = $barangModel->where('category_id', $kategori['id'])->findAll();

        // Return the view with the category and product data
        return view('barang/type-list', [
            'sex' => $sex,
            'jenis' => $jenis,
            'products' => $products,
        ]);
    }
}
