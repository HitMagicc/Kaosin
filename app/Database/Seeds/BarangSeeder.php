<?php

namespace App\Database\Seeds;

use App\Models\Kategori;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $kategoriModel = new Kategori();

        // Fetch the desired categories
        $kategoriCelanaCowo = $kategoriModel->where('Name', 'Celana')->where('Sex', 1)->first();
        $kategoriCelanaCewe = $kategoriModel->where('Name', 'Celana')->where('Sex', 2)->first();
        $kategoriBajuCowo = $kategoriModel->where('Name', 'Baju')->where('Sex', 1)->first();
        $kategoriBajuCewe = $kategoriModel->where('Name', 'Baju')->where('Sex', 2)->first();

        // Ensure $kategoriX variables contain data
        if (!$kategoriCelanaCowo || !$kategoriCelanaCewe || !$kategoriBajuCowo || !$kategoriBajuCewe) {
            throw new \Exception('Kategori data is missing. Please seed the Kategori table first.');
        }

        $faker = Factory::create();

        $data = [
            [
                'id'          => $this->generateUUID(),
                'name'        => $faker->name . " Shirt",
                'price'       => 150000,
                'desc'        => "Kemeja",
                'kategori_id' => is_array($kategoriBajuCowo) ? $kategoriBajuCowo['id'] : $kategoriBajuCowo->id,
                'stock'       => 100,
                'image_path'  => "uploads/photo1.png"
            ],
            [
                'id'          => $this->generateUUID(),
                'name'        => $faker->name . " Pants",
                'price'       => 200000,
                'desc'        => "Celana",
                'kategori_id' => is_array($kategoriCelanaCowo) ? $kategoriCelanaCowo['id'] : $kategoriCelanaCowo->id,
                'stock'       => 100,
                'image_path'  => "uploads/photo1.png"
            ],
            [
                'id'          => $this->generateUUID(),
                'name'        => $faker->name . " Shirt",
                'price'       => 150000,
                'desc'        => "Kemeja",
                'kategori_id' => is_array($kategoriBajuCewe) ? $kategoriBajuCewe['id'] : $kategoriBajuCewe->id,
                'stock'       => 100,
                'image_path'  => "uploads/photo1.png"
            ],
            [
                'id'          => $this->generateUUID(),
                'name'        => $faker->name . " Pants",
                'price'       => 200000,
                'desc'        => "Celana",
                'kategori_id' => is_array($kategoriCelanaCewe) ? $kategoriCelanaCewe['id'] : $kategoriCelanaCewe->id,
                'stock'       => 100,
                'image_path'  => "uploads/photo1.png"
            ],
        ];

        $this->db->table('barang')->insertBatch($data);
    }

    private function generateUUID()
    {
        return strtoupper(bin2hex(random_bytes(16)));
    }
}
