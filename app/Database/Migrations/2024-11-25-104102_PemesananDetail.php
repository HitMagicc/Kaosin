<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PemesananDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'pemesanan_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'barang_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'null' => true,
            ],
            'price' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('barang_id', 'barang', 'id', 'CASCADE', 'CASCADE'); // Assumes a `barang` table exists
        $this->forge->addForeignKey('pemesanan_id', 'pemesanan', 'id', 'CASCADE', 'CASCADE'); // Assumes a `barang` table exists
        $this->forge->createTable('pemesanandetail');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanandetail');
    }
}
