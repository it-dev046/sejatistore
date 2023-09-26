<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Projects extends Migration
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
            'nama_project' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pelanggan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pengerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('project');
    }

    public function down()
    {
        $this->forge->dropTable('project');
    }
}
