<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hbk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hbk' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pasang' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'pekerja' => [
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
        $this->forge->addKey('id_hbk', true);
        $this->forge->createTable('hbk');
    }

    public function down()
    {
        $this->forge->dropTable('hbk');
    }
}
