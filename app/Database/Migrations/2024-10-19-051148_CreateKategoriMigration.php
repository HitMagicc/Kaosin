<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoriMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'Sex' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true,
            ],
            'Name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kategori');
    }

    public function down()
    {
        $this->forge->dropTable('kategori');
    }
}
