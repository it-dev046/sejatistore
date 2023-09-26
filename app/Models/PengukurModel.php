<?php

namespace App\Models;

use CodeIgniter\Model;

class PengukurModel extends Model
{
    protected $table            = 'pengukur';
    protected $primaryKey       = 'id_pengukur';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama'];
}
