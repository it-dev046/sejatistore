<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subkategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_subkate' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_subkate' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug_subkate' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_input' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tanggal_ubah' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_subkate', true);
        $this->forge->createTable('subkategori');
    }

    public function down()
    {
        $this->forge->dropTable('subkategori');
    }
}
