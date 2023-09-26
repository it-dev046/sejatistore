<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerModel extends Model
{
    protected $table            = 'partner';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'logo'];
}
