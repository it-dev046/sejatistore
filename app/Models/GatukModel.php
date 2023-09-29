<?php

namespace App\Models;

use CodeIgniter\Model;

class GatukModel extends Model
{
    protected $table            = 'gatuk';
    protected $primaryKey       = 'id_gatuk';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'invoice', 'nilai', 'id_rekening', 'potongan', 'sisa_hbk', 'keterangan'];
}
