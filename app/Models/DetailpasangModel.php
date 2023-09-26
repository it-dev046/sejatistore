<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailpasangModel extends Model
{
    protected $table            = 'detail_pemasangan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_survei', 'uraian', 'biaya', 'id_sub', 'volume', 'ukuran', 'harga'];

    public function jumlahbiaya($id)
    {
        $query = $this->db->table('detail_pemasangan')
            ->selectSum('biaya')
            ->where('id_survei', $id)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->biaya;
        } else {
            return 0;
        }
    }
}
