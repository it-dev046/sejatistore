<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'id_pel';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_pel', 'slug_pel', 'telepon', 'alamat', 'kota', 'id_katepel'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

    public function AllData()
    {
        return $this->db->table('pelanggan')
            ->join('katepel', 'katepel.id_katepel=pelanggan.id_katepel', 'left')
            ->Get()->getResultArray();
    }

    public function AllKatepel()
    {
        return $this->db->table('katepel')->Get()->getResultArray();
    }
    public function AllPel($id_katepel)
    {
        return $this->db->table('pelanggan')->where('id_katepel', $id_katepel)->Get()->getResultArray();
    }
}
