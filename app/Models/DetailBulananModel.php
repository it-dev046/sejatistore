<?php

namespace App\Models;

use CodeIgniter\Model;

date_default_timezone_set("Asia/Manila");

class DetailBulananModel extends Model
{
    protected $table            = 'detail_bulanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'id_bulanan', 'bayar', 'keterangan'];
    protected $useTimestamps = false;

    public function cek($tanggal)
    {
        return $this->where('tanggal =', $tanggal)->countAllResults() > 0;
    }

    public function jumlahnilai($tanggal)
    {
        $query = $this->db->table('detail_bulanan')
            ->selectSum('bayar')
            ->where('DATE(tanggal) =', $tanggal)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->bayar;
        } else {
            return 0;
        }
    }
}
