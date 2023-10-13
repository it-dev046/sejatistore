<?php

namespace App\Models;

use CodeIgniter\Model;

class RPTModel extends Model
{
    protected $table            = 'rpt';
    protected $primaryKey       = 'id_rpt';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'invoice', 'nama', 'alamat', 'tukang', 'sisa_hbk', 'bayar', 'keterangan'];


    public function cek($tanggal)
    {
        return $this->where('tanggal =', $tanggal)->countAllResults() > 0;
    }
}
