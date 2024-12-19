<?php

namespace App\Controllers;

use App\Models\Barang;

class Home extends BaseController
{
    public function index(): string
    {
        $barangModel = new Barang();

        $barangData = $barangModel->orderBy('price')->findAll(6);
        $barangBaru = $barangModel->orderBy('created_at')->findAll(5);
        // dd($barangBaru);
        // dd(session()->get("user_id"));
        return view('index', [
            'barang' => $barangData,
            'barangBaru' => $barangBaru,
        ]);
    }
}
