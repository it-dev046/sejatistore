<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
    protected $table            = 'rekening';
    protected $primaryKey       = 'id_rekening';
    protected $returnType       = 'object';
    protected $allowedFields    = ['usaha', 'AN', 'rek', 'bank'];
}
