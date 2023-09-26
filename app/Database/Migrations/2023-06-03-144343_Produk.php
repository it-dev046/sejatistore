<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
  public function up() {
    $this->forge->addField([
      'id_produk' => [
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => true,
        'auto_increment' => true,
      ],
      'slug_produk' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
      ],
      'kategori_slug' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
      ],
      'subkategori_slug' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
      ],
      'nama_produk' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
      ],
      'deskripsi' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
      ],
      'satuan' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
      ],
      'stok' => [
        'type' => 'int',
        'constraint' => '11',
      ],
      'harga' => [
        'type' => 'int',
        'constraint' => '11',
      ],
      'gambar_produk' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
      ],
      'tanggal_input' => [
        'type' => 'DATETIME',
        'null' => true,
      ],
      'tanggal_ubah' => [
        'type' => 'DATETIME',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id_produk', true);
    $this->forge->createTable('produk');
  }

  public function down() {
    $this->forge->dropTable('produk');
  }
}