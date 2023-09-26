<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Testimoni extends Migration
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
            'nama_pelanggan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'project' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ucapan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('testimoni');
    }

    public function down()
    {
        $this->forge->dropTable('testimoni');
    }
}
