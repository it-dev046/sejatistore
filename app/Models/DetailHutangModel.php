<?php

namespace App\Models;

use CodeIgniter\Model;

date_default_timezone_set("Asia/Manila");

class DetailHutangModel extends Model
{
    protected $table            = 'detail_hutang';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'id_hutang', 'sumber', 'tujuan', 'bayar', 'keterangan'];
    protected $useTimestamps = false;

    public function totalbayar($id)
    {
        $startDate = $this->selectMin('tanggal')->first();
        $endDate = $this->selectMax('tanggal')->first();
        $query = $this->db->table('detail_hutang')
            ->where('id_hutang', $id)
            ->where('DATE(tanggal) >=', $startDate)
            ->where('DATE(tanggal) <=', $endDate)
            ->selectSum('bayar')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->bayar;
        } else {
            return 0;
        }
    }
}
