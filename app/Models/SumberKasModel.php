<?php

namespace App\Models;

use CodeIgniter\Model;

class SumberKasModel extends Model
{
    protected $table = 'sumber_kas';
    protected $primaryKey = 'id_sumber';
    protected $allowedFields = ['kode', 'keterangan', 'saldo', 'cash'];

    public function totalsaldo()
    {
        $query = $this->db->table('sumber_kas')
            ->selectSum('saldo')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->saldo;
        } else {
            return 0;
        }
    }
}
