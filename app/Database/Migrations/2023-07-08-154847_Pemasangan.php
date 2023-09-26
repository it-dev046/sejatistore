<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemasangan extends Migration
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
            'invoice' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'biaya' => [
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
        $this->forge->addKey('id_pasang', true);
        $this->forge->createTable('pemasangan');
    }

    public function down()
    {
        $this->forge->dropTable('pemasangan');
    }
}
