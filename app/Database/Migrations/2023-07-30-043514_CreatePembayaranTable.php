<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bayar' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_trans' => [
                'type' => 'INT',
                'constraint' => 15,
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 2,
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

        $this->forge->addPrimaryKey('id_bayar');
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}
