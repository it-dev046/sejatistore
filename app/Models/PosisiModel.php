<?php

namespace App\Models;

use CodeIgniter\Model;

class PosisiModel extends Model
{
    protected $table            = 'posisi';
    protected $primaryKey       = 'id_posisi';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama'];
}
