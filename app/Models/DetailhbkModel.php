<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailhbkModel extends Model
{
    protected $table            = 'detail_hbk';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_hbk', 'uraian', 'ukuran', 'volume', 'harga', 'biaya'];

    public function jumlahbiaya($id)
    {
        $query = $this->db->table('detail_hbk')
            ->selectSum('biaya')
            ->where('id_hbk', $id)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->biaya;
        } else {
            return 0;
        }
    }
}
