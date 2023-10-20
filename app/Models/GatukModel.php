<?php

namespace App\Models;

use CodeIgniter\Model;

class GatukModel extends Model
{
    protected $table            = 'gatuk';
    protected $primaryKey       = 'id_gatuk';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'invoice', 'nilai', 'id_rekening', 'potongan', 'sisa_hbk', 'keterangan', 'tukang', 'nama', 'alamat'];

    public function cek($tanggal)
    {
        return $this->where('tanggal =', $tanggal)->countAllResults() > 0;
    }

    public function jumlahnilai($tanggal)
    {
        $query = $this->db->table('gatuk')
            ->selectSum('nilai')
            ->where('DATE(tanggal) =', $tanggal)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->nilai;
        } else {
            return 0;
        }
    }

    public function jumlahpotongan($tanggal)
    {
        $query = $this->db->table('gatuk')
            ->selectSum('potongan')
            ->where('DATE(tanggal) =', $tanggal)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->potongan;
        } else {
            return 0;
        }
    }

    public function totalnilai($tanggal, $tukang)
    {
        $query = $this->db->table('gatuk')
            ->selectSum('nilai')
            ->where('DATE(gatuk.tanggal) =', $tanggal)
            ->where('tukang =', $tukang)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->nilai;
        } else {
            return 0;
        }
    }

    public function totalpotongan($tanggal, $tukang)
    {
        $query = $this->db->table('gatuk')
            ->selectSum('potongan')
            ->where('DATE(gatuk.tanggal) =', $tanggal)
            ->where('tukang =', $tukang)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->potongan;
        } else {
            return 0;
        }
    }
}
