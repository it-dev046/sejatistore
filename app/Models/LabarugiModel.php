<?php

namespace App\Models;

use CodeIgniter\Model;

class LabarugiModel extends Model
{
    protected $table = 'labarugi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis', 'id_katekas', 'keterangan', 'subtotal'];

    public function jumlahmasuk()
    {
        $query = $this->db->table('labarugi')
            ->where('jenis', 1)
            ->selectSum('subtotal')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->subtotal;
        } else {
            return 0;
        }
    }

    public function jumlahkeluar()
    {
        $query = $this->db->table('labarugi')
            ->where('jenis', 2)
            ->selectSum('subtotal')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->subtotal;
        } else {
            return 0;
        }
    }
}
