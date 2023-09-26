<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailPemasanganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_bayar' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'total' => [
                'constraint' => 10,
                'type' => 'INT',
            ],
            'sisa' => [
                'constraint' => 10,
                'type' => 'INT',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('detail_pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('detail_pembayaran');
    }
}
