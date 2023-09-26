<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSumberKasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sumber' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addPrimaryKey('id_sumber');
        $this->forge->createTable('sumber_kas');
    }

    public function down()
    {
        $this->forge->dropTable('sumber_kas');
    }
}
