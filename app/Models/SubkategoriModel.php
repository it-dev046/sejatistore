<?php

namespace App\Models;

use CodeIgniter\Model;

class SubkategoriModel extends Model
{
    protected $table            = 'subkategori';
    protected $primaryKey       = 'id_subkate';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_subkate', 'slug_subkate', 'id_kategori'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

    public function AllData()
    {
        return $this->db->table('subkategori')
            ->join('kategori_produk', 'kategori_produk.id_kategori=subkategori.id_kategori', 'left')
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
}
