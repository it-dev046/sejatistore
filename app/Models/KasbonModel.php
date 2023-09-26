<?php

namespace App\Models;

use CodeIgniter\Model;

class KasbonModel extends Model
{
    protected $table            = 'kasbon';
    protected $primaryKey       = 'id_kasbon';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'jumlah', 'tempo', 'potongan', 'sisa', 'keterangan'];
}
