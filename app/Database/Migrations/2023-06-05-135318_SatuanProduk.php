<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SatuanProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_satuan' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'singkatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug_satuan' => [
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
        $this->forge->addKey('id_satuan', true);
        $this->forge->createTable('satuan_produk');
    }

    public function down()
    {
        $this->forge->dropTable('satuan_produk');
    }
}