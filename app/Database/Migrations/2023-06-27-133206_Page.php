<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Page extends Migration
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
            'home_titel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'home_judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'home_text' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'home_gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'about_titel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'about_judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'about_text' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'about_list' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'about_gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'about_nomor' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'about_text3' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'project_titel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'project_judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'projects_gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'partner_titel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'partner_judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'testimoni_titel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'testimoni_judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'contact_titel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'contact_judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'google_map' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'telpon' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('page');
    }

    public function down()
    {
        $this->forge->dropTable('page');
    }
}
