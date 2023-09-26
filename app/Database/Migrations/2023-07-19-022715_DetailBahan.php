<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailBahan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pasang' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'id_produk' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jumlah' => [
                'type'       => 'int',
                'constraint' => '5',
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('detail_bahan');
    }

    public function down()
    {
        $this->forge->dropTable('detail_bahan');
    }
}
