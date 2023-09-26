<?php

namespace App\Models;

date_default_timezone_set("Asia/Manila");

use CodeIgniter\Model;

class BayarhbkModel extends Model
{
    protected $table            = 'bayarhbk';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_hbk', 'id_pasang', 'kwitansi', 'tanggal', 'bayar', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

    public function jumlahbayar($id)
    {
        $query = $this->db->table('bayarhbk')
            ->selectSum('bayar')
            ->where('id_hbk', $id)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->bayar;
        } else {
            return 0;
        }
    }

    public function countSalesToday()
    {
        $year = date('Y');

        $query = $this->db->table('bayarhbk')
            ->where('YEAR(tanggal)', $year)
            ->countAllResults();

        return $query;
    }

    public function calculateTodayRevenue()
    {
        $today = date('Y-m-d');

        $query = $this->db->table('bayarhbk')
            ->selectSum('bayar')
            ->where('DATE(tanggal_input)', $today)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->bayar;
        } else {
            return 0;
        }
    }

    public function calculateCurrentMonthRevenue()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        $query = $this->db->table('bayarhbk')
            ->selectSum('bayar')
            ->where('DATE(tanggal_input) >=', $startDate)
            ->where('DATE(tanggal_input) <=', $endDate)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->bayar;
        } else {
            return 0;
        }
    }

    public function isInvoiceExists($kwitansi)
    {
        return $this->where('kwitansi', $kwitansi)->countAllResults() > 0;
    }
}
