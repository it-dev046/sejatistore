<?php

namespace App\Models;

use CodeIgniter\Model;

class KasbonModel extends Model
{
    protected $table            = 'kasbon';
    protected $primaryKey       = 'id_kasbon';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'id_rekening', 'jumlah', 'sisa', 'keterangan'];

    public function isInvoiceExists($id_rekening)
    {
        return $this->where('id_rekening', $id_rekening)->countAllResults() > 0;
    }
}
