<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdukKembali extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kembali' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_trans' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_produk' => [
                'type'       => 'INT',
                'constraint' => '5',
            ],
            'jumlah_kembali' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'Keterangan' => [
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
        $this->forge->addKey('id_kembali', true);
        $this->forge->createTable('produk_kembali');
    }

    public function down()
    {
        $this->forge->dropTable('produk_kembali');
    }
}
