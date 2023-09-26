<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLabarugiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'id_katekas' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('labarugi');
    }

    public function down()
    {
        $this->forge->dropTable('labarugi');
    }
}
