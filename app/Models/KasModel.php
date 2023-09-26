<?php

namespace App\Models;

use CodeIgniter\Model;


date_default_timezone_set("Asia/Manila");

class KasModel extends Model
{
    protected $table = 'kas';
    protected $primaryKey = 'id_kas';
    protected $allowedFields = [
        'tanggal',
        'id_katekas',
        'id_sumber',
        'nama',
        'uraian',
        'debet',
        'kredit',
    ];

    protected $useTimestamps = false;

    public function getLatestDataByCategory()
    {
        $query = $this->db->query('
        SELECT kas.*, katekas.* FROM kas RIGHT JOIN katekas ON kas.id_katekas = katekas.id_katekas WHERE CONCAT(kas.id_katekas, kas.tanggal) IN( SELECT CONCAT(kas.id_katekas, MAX(kas.tanggal)) FROM kas GROUP BY id_katekas )
        ');
        return $query->getResult();
    }

    public function totaldebet()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $query = $this->db->table('kas')
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

    public function totalkredit()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $query = $this->db->table('kas')
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

    public function jumlahdebet($id)
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $query = $this->db->table('kas')
            ->where('id_katekas', $id)
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

    public function jumlahkatedebet($id, $tgl_awal, $tgl_akhir)
    {
        $query = $this->db->table('kas')
            ->where('id_katekas', $id)
            ->where('DATE(tanggal) >=', $tgl_awal)
            ->where('DATE(tanggal) <=', $tgl_akhir)
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
        $query = $this->db->table('kas')
            ->where('id_katekas', $id)
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

    public function jumlahkatekredit($id, $tgl_awal, $tgl_akhir)
    {
        $query = $this->db->table('kas')
            ->where('id_katekas', $id)
            ->where('DATE(tanggal) >=', $tgl_awal)
            ->where('DATE(tanggal) <=', $tgl_akhir)
            ->selectSum('kredit')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->kredit;
        } else {
            return 0;
        }
    }

    public function jumlahdebetday($id)
    {

        $today = date('Y-m-d');
        $query = $this->db->table('kas')
            ->where('id_sumber', $id)
            ->where('DATE(tanggal)', $today)
            ->selectSum('debet')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->debet;
        } else {
            return 0;
        }
    }

    public function jumlahdebetkas($id)
    {
        $startDate = $this->selectMin('tanggal')->first();
        $endDate = $this->selectMax('tanggal')->first();
        $query = $this->db->table('kas')
            ->where('id_sumber', $id)
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

    public function jumlahkreditkas($id)
    {
        $startDate = $this->selectMin('tanggal')->first();
        $endDate = $this->selectMax('tanggal')->first();
        $query = $this->db->table('kas')
            ->where('id_sumber', $id)
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

    public function jumlahkreditday($id)
    {

        $today = date('Y-m-d');
        $query = $this->db->table('kas')
            ->where('id_sumber', $id)
            ->where('DATE(tanggal)', $today)
            ->selectSum('kredit')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->kredit;
        } else {
            return 0;
        }
    }

    public function jumlahbulan($id)
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        $query = $this->db->table('kas')
            ->where('id_sumber', $id)
            ->where('DATE(tanggal) >=', $startDate)
            ->where('DATE(tanggal) <=', $endDate)
            ->countAllResults();
        return $query;
    }

    public function jumlahday($id)
    {
        $endDate = date('Y-m-t');

        $query = $this->db->table('kas')
            ->where('id_sumber', $id)
            ->where('DATE(tanggal)', $endDate)
            ->countAllResults();
        return $query;
    }
}
