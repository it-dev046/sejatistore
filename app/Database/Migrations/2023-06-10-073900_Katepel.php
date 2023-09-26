<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Katepel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_katepel' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_katepel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'potongan_harga' => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'diskon_khusus' => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'slug_katepel' => [
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
        $this->forge->addKey('id_katepel', true);
        $this->forge->createTable('katepel');
    }

    public function down()
    {
        $this->forge->dropTable('katepel');
    }
}
