<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailSumberTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_sumber' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'constraint' => 50,
            ],
            'saldo' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('detail_sumber');
    }

    public function down()
    {
        $this->forge->dropTable('detail_sumber');
    }
}
