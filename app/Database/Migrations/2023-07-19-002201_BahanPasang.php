<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BahanPasang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pasang' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pasang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'alamat' => [
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
        $this->forge->addKey('id_pasang', true);
        $this->forge->createTable('bahan_pasang');
    }

    public function down()
    {
        $this->forge->dropTable('bahan_pasang');
    }
}
