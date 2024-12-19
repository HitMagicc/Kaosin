<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'price' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            
            'desc' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'kategori_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'stock' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'image_path' => [ // New field for image path
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, // Allowing null values for optional image
            ],  
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        // Add primary key
        $this->forge->addKey('id', true);

        // Add foreign key
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'CASCADE');

        // Create table
        $this->forge->createTable('barang');
    }

    public function down()
    {
        // Drop table
        $this->forge->dropTable('barang', true); // true ensures it won't throw an error if the table doesn't exist
    }
}
