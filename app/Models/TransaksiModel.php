<?php

namespace App\Models;

date_default_timezone_set("Asia/Manila");

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_trans', 'id_pel', 'id_katepel', 'penerima', 'telepon', 'alamat', 'id_ongkir', 'potongan', 'total', 'bayar', 'kembalian', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

    public function AllData()
    {
        return $this->db->table('transaksi')
            ->join('katepel', 'katepel.id_katepel=transaksi.id_katepel', 'left')
            ->Get()->getResultArray();
    }

    public function calculateTodayRevenue()
    {
        $today = date('Y-m-d');

        $query = $this->db->table('transaksi')
            ->selectSum('total')
            ->where('DATE(tanggal_input)', $today)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->total;
        } else {
            return 0;
        }
    }

    public function calculateCurrentMonthRevenue()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        $query = $this->db->table('transaksi')
            ->selectSum('total')
            ->where('DATE(tanggal_input) >=', $startDate)
            ->where('DATE(tanggal_input) <=', $endDate)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->total;
        } else {
            return 0;
        }
    }

    public function countCurrentMonthSales()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        $query = $this->db->table('transaksi')
            ->where('DATE(tanggal_input) >=', $startDate)
            ->where('DATE(tanggal_input) <=', $endDate)
            ->countAllResults();
        return $query;
    }

    public function countSalesToday()
    {
        $today = date('Y-m-d');

        $query = $this->db->table('transaksi')
            ->where('DATE(tanggal_input)', $today)
            ->countAllResults();

        return $query;
    }

    public function countSalesMonth()
    {
        $month = date('m');
        $year = date('Y');

        $query = $this->db->table('transaksi')
            ->where('MONTH(tanggal_input)', $month)
            ->where('YEAR(tanggal_input)', $year)
            ->countAllResults();

        return $query;
    }

    public function isInvoiceExists($id_trans)
    {
        return $this->where('id_trans', $id_trans)->countAllResults() > 0;
    }
}
