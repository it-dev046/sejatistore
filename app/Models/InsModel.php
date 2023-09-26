<?php

namespace App\Models;

use CodeIgniter\Model;

class InsModel extends Model
{
    protected $table            = 'insentif';
    protected $primaryKey       = 'id_ins';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'op', 'um', 'potongan', 'total', 'rek', 'bank', 'keterangan'];
}
