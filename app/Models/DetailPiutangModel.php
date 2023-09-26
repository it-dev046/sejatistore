<?php

namespace App\Models;

use CodeIgniter\Model;

date_default_timezone_set("Asia/Manila");

class DetailPiutangModel extends Model
{
    protected $table            = 'detail_piutang';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'id_piutang', 'debet', 'kredit', 'keterangan'];
    protected $useTimestamps = false;

    public function jumlahdebet($id)
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $query = $this->db->table('detail_piutang')
            ->where('id_piutang', $id)
            ->where('DATE(tanggal) >=', $startDate)
            ->where('DATE(tanggal) <=', $endDate)
            ->selectSum('debet')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->debet;
        } else {
            return 0;
        }
    }

    public function jumlahkredit($id)
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $query = $this->db->table('detail_piutang')
            ->where('id_piutang', $id)
            ->where('DATE(tanggal) >=', $startDate)
            ->where('DATE(tanggal) <=', $endDate)
            ->selectSum('kredit')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->kredit;
        } else {
            return 0;
        }
    }

    public function debetpiutang($id)
    {
        $startDate = $this->selectMin('tanggal')->first();
        $endDate = $this->selectMax('tanggal')->first();
        $query = $this->db->table('detail_piutang')
            ->where('id_piutang', $id)
            ->where('DATE(tanggal) >=', $startDate)
            ->where('DATE(tanggal) <=', $endDate)
            ->selectSum('debet')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->debet;
        } else {
            return 0;
        }
    }

    public function kreditpiutang($id)
    {
        $startDate = $this->selectMin('tanggal')->first();
        $endDate = $this->selectMax('tanggal')->first();
        $query = $this->db->table('detail_piutang')
            ->where('id_piutang', $id)
            ->where('DATE(tanggal) >=', $startDate)
            ->where('DATE(tanggal) <=', $endDate)
            ->selectSum('kredit')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->kredit;
        } else {
            return 0;
        }
    }
}
