<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
  protected $table = 'produk';
  protected $primaryKey = 'id_produk';
  protected $allowedFields = ['id_produk', 'slug_produk', 'id_kategori', 'id_subkate', 'nama_produk', 'deskripsi', 'id_satuan', 'harga', 'stok', 'gambar_produk'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat = 'datetime';
  protected $createdField = 'tanggal_input';
  protected $updatedField = 'tanggal_ubah';

  public function AllData()
  {
    return $this->db->table('produk')->orderBy('nama_produk', 'ASC')
      ->join('kategori_produk', 'kategori_produk.id_kategori=produk.id_kategori', 'left')
      ->join('subkategori', 'subkategori.id_subkate=produk.id_subkate', 'left')
      ->join('satuan_produk', 'satuan_produk.id_satuan=produk.id_satuan', 'left')
      ->select('produk.id_produk, produk.nama_produk, kategori_produk.nama_kategori, subkategori.nama_subkate, satuan_produk.nama_satuan, satuan_produk.singkatan, produk.harga, produk.stok, produk.gambar_produk, produk.deskripsi')
      ->Get()->getResultArray();
  }

  public function AllKategori()
  {
    return $this->db->table('kategori_produk')->Get()->getResultArray();
  }
  public function AllSubkate($id_kategori)
  {
    return $this->db->table('subkategori')->where('id_kategori', $id_kategori)->Get()->getResultArray();
  }
  public function AllStok($id)
  {
    return $this->db->table('produk')->where('id_produk', $id)->Get()->getResultArray();
  }

  public function kurangiStok($id_produk, $jumlah_belanja)
  {
    $builder = $this->db->table('produk');
    $builder->select('stok');
    $builder->where('id_produk', $id_produk);
    $query = $builder->get();
    $row = $query->getRow();
    $stok_sekarang = $row->stok;

    $stok_baru = $stok_sekarang - $jumlah_belanja;

    // Memperbarui stok di database
    $data = [
      'stok' => $stok_baru
    ];
    $builder->update($data, ['id_produk' => $id_produk]);
  }


  public function getProductByName()
  {
    $productName = $this->db->table('produk')
      ->select('nama')
      ->distinct()
      ->findAll();

    return $this->db->table('produk')
      ->where('nama', $productName)
      ->get()
      ->getRow();
  }
}
