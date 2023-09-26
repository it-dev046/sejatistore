<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailModel extends Model
{
    protected $table            = 'detail_transaksi';
    protected $primaryKey       = 'id_detail';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_trans', 'id_produk', 'jumlah_produk', 'subtotal'];

    public function jumlahbayar($id)
    {
        $query = $this->db->table('detail_transaksi')
            ->selectSum('subtotal')
            ->where('id_trans', $id)
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->subtotal;
        } else {
            return 0;
        }
    }
}
