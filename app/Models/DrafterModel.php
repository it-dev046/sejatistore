<?php

namespace App\Models;

use CodeIgniter\Model;

class DrafterModel extends Model
{
    protected $table            = 'drafter';
    protected $primaryKey       = 'id_drafter';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama'];
}
