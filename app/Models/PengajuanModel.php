<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table            = 'pengajuan';
    protected $primaryKey       = 'id_pengajuan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'id_rekening', 'nilai', 'keterangan'];

    public function cek($tanggal)
    {
        return $this->where('tanggal =', $tanggal)->countAllResults() > 0;
    }

    public function jumlahnilai($tanggal)
    {
        $query = $this->db->table('pengajuan')
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
}
