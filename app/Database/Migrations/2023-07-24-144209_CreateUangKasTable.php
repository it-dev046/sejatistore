<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUangKasTable extends Migration
{
    public function up()
    {
        // Definisi struktur tabel 'uang_kas'
        $this->forge->addField([
            'id_uang' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nilai' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'subtotal' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
        ]);

        // Membuat primary key
        $this->forge->addPrimaryKey('id_uang');

        // Membuat tabel 'uang_kas'
        $this->forge->createTable('uang_kas', true);
    }

    public function down()
    {
        // Menghapus tabel 'uang_kas'
        $this->forge->dropTable('uang_kas');
    }
}
