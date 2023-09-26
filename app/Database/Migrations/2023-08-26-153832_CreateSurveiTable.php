<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSurveiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_survei' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'pelanggan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
            'sketsa' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'pengukur' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 1000,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tanggal_update' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_survei');
        $this->forge->createTable('survei');
    }

    public function down()
    {
        $this->forge->dropTable('survei');
    }
}
