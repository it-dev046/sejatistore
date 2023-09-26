<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKasTable extends Migration
{
    public function up()
    {
        // Definisi struktur tabel 'kas'
        $this->forge->addField([
            'id_kas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'uraian' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'debet' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
            ],
            'kredit' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
            ],
            'saldo' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
            ],
        ]);

        // Membuat primary key
        $this->forge->addPrimaryKey('id_kas');

        // Membuat tabel 'kas'
        $this->forge->createTable('kas', true);
    }

    public function down()
    {
        // Menghapus tabel 'kas'
        $this->forge->dropTable('kas');
    }
}
