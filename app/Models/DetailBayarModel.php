<?php

namespace App\Models;

use CodeIgniter\Model;

date_default_timezone_set("Asia/Manila");

class DetailBayarModel extends Model
{
    protected $table = 'detail_pembayaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_bayar', 'total', 'sisa', 'tanggal', 'status', 'keterangan',];

    public function jumlahbayar($id)
    {
        $query = $this->db->table('detail_pembayaran')
            ->selectSum('total')
            ->where('id_bayar', $id)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->total;
        } else {
            return 0;
        }
    }

    public function sisabayar($id)
    {
        $query = $this->db->table('detail_pembayaran')
            ->selectSum('sisa')
            ->where('id_bayar', $id)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->sisa;
        } else {
            return 0;
        }
    }

    public function jumlahpembayaran($id)
    {
        $query = $this->db->table('detail_pembayaran')
            ->where('id_bayar', $id)
            ->countAllResults();
        return $query;
    }

    public function totalall()
    {
        $query = $this->db->table('detail_pembayaran')
            ->selectSum('total')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->total;
        } else {
            return 0;
        }
    }

    public function totalpembayaran()
    {
        $today = date('Y-m-d');
        $query = $this->db->table('detail_pembayaran')
            ->join('pembayaran', 'pembayaran.id_bayar = detail_pembayaran.id_bayar', 'right')
            ->join('transaksi', 'transaksi.id_trans = pembayaran.id_trans', 'right')
            ->where('DATE(tanggal)', $today)
            ->selectSum('pembayaran.total')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->total;
        } else {
            return 0;
        }
    }

    public function totalbayarbulan()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $query = $this->db->table('detail_pembayaran')
            ->where('DATE(tanggal) >=', $startDate)
            ->where('DATE(tanggal) <=', $endDate)
            ->selectSum('total')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->total;
        } else {
            return 0;
        }
    }
}
