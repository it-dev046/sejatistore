<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailSumberModel extends Model
{
    protected $table            = 'detail_sumber';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_sumber', 'kode', 'keterangan', 'saldo'];

    public function totalsaldo()
    {
        $query = $this->db->table('detail_sumber')
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
