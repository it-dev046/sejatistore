<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ongkir extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ongkir' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_wilayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'biaya' => [
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
        $this->forge->addKey('id_ongkir', true);
        $this->forge->createTable('ongkir');
    }

    public function down()
    {
        $this->forge->dropTable('ongkir');
    }
}
