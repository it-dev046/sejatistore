<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKatekasTable extends Migration
{
    public function up()
    {
        // Definisi struktur tabel 'katekas'
        $this->forge->addField([
            'id_katekas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        // Membuat primary key
        $this->forge->addPrimaryKey('id_katekas');

        // Membuat tabel 'katekas'
        $this->forge->createTable('katekas', true);
    }

    public function down()
    {
        // Menghapus tabel 'katekas'
        $this->forge->dropTable('katekas');
    }
}
