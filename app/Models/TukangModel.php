<?php

namespace App\Models;

use CodeIgniter\Model;

class TukangModel extends Model
{
    protected $table            = 'tukang';
    protected $primaryKey       = 'id_tukang';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama'];
}
