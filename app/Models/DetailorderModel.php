<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailorderModel extends Model
{
    protected $table            = 'detail_order';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_order', 'nama', 'spek', 'jumlah'];
}
