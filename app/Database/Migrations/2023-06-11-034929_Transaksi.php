<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_trans' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pel' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'pengiriman' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'penerima' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ongkir' => [
                'type'       => 'int',
                'constraint' => '9',
            ],
            'total' => [
                'type'       => 'int',
                'constraint' => '9',
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
        $this->forge->addKey('id_trans', true);
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
