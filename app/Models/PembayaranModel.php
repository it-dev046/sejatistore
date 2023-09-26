<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_bayar';
    protected $allowedFields = ['id_trans', 'total', 'sisa'];


    public function jumlahbayar($id)
    {
        $query = $this->db->table('pembayaran')
            ->selectSum('total')
            ->where('id_trans', $id)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->total;
        } else {
            return 0;
        }
    }


    public function totalsisa()
    {
        $query = $this->db->table('pembayaran')
            ->selectSum('sisa')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->sisa;
        } else {
            return 0;
        }
    }

    public function totalall()
    {
        $query = $this->db->table('pembayaran')
            ->selectSum('total')
            ->where('sisa', 0)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->total;
        } else {
            return 0;
        }
    }


    public function jumlahpembayaran($id)
    {
        $query = $this->db->table('pembayaran')
            ->where('id_trans', $id)
            ->countAllResults();
        return $query;
    }
}
