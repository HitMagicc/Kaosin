<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        // Generate data with UUIDs
        $data = [
            [
                'id'   => $this->generateUUID(),
                'Sex'  => 1,
                'Name' => 'Baju',
            ],
            [
                'id'   => $this->generateUUID(),
                'Sex'  => 1,
                'Name' => 'Celana',
            ],
            [
                'id'   => $this->generateUUID(),
                'Sex'  => 2,
                'Name' => 'Baju',
            ],
            [
                'id'   => $this->generateUUID(),
                'Sex'  => 2,
                'Name' => 'Celana',
            ],
        ];

        $this->db->table('kategori')->insertBatch($data);
    }

    private function generateUUID()
    {
        return strtoupper(bin2hex(random_bytes(16))); 
    }
}
