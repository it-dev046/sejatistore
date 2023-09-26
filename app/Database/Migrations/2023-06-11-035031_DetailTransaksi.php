<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detail' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_trans' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'id_produk' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'jumlah_produk' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'subtotal' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
        ]);
        $this->forge->addKey('id_detail', true);
        $this->forge->createTable('detail_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('detail_transaksi');
    }
}
