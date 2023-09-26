<?php

namespace App\Models;

use CodeIgniter\Model;

class UangKasModel extends Model
{
    protected $table = 'uang_kas';
    protected $primaryKey = 'id_uang';
    protected $allowedFields = [
        'nilai',
        'jumlah',
        'subtotal',
        'id_sumber',
        'jenis',
    ];

    protected $useTimestamps = false;

    public function jumlahbayar($id_sumber)
    {
        $query = $this->db->table('uang_kas')
            ->where('id_sumber', $id_sumber)
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
