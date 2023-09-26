<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BayarHbk extends Migration
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
            'id_hbk' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'tanggal' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'bayar' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'sisa' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'keterangan' => [
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('bayarHbk');
    }

    public function down()
    {
        $this->forge->dropTable('bayarHbk');
    }
}
