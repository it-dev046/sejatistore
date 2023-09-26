<?php

namespace App\Models;

use CodeIgniter\Model;

class KerjaModel extends Model
{
    protected $table            = 'kerja';
    protected $primaryKey       = 'id_kerja';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'keterangan'];
}
