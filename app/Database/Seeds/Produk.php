<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Produk extends Seeder
{
    public function run()
    {
        $produk_data = [
			[
				'slug_produk' => 'SJ-2001',
				'kategori_slug'  => 'plafon-pvc',
				'subkategori_slug'  => 'laminating',
				'nama_produk'  => 'SJ 2001',
				'deskripsi'  => 'Motif Putih Polos',
				'satuan'  => 'Dus',
				'stok'  => '50',
				'harga'  => '990000',
				'gambar_produk'  => 'SJ2001.png'
			],
			[
				'slug_produk' => 'SJ-2002',
				'kategori_slug'  => 'plafon-pvc',
				'subkategori_slug'  => 'laminating',
				'nama_produk'  => 'SJ 2002',
				'deskripsi'  => 'Motif Putih Garis',
				'satuan'  => 'Dus',
				'stok'  => '50',
				'harga'  => '990000',
				'gambar_produk'  => 'SJ2002.png'
			],
			[
				'slug_produk' => 'SJ-2003',
				'kategori_slug'  => 'plafon-pvc',
				'subkategori_slug'  => 'laminating',
				'nama_produk'  => 'SJ 2003',
				'deskripsi'  => 'Motif Putih Polos',
				'satuan'  => 'Dus',
				'stok'  => '50',
				'harga'  => '990000',
				'gambar_produk'  => 'SJ2003.png'
			]
		];

		foreach($produk_data as $data){
			// insert semua data ke tabel
			$this->db->table('produk')->insert($data);
		}
    }
}
