<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pel' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug_pel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_katepel' => [
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
        $this->forge->addKey('id_pel', true);
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}
