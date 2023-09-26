<?php

namespace App\Models;

use CodeIgniter\Model;

class GajiModel extends Model
{
    protected $table            = 'gaji';
    protected $primaryKey       = 'id_gaji';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'gapok', 'bonus', 'potongan', 'total', 'rek', 'bank', 'keterangan'];
}
