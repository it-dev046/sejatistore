<?php

namespace App\Models;

use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table            = 'harga';
    protected $primaryKey       = 'id_harga';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'nominal', 'keterangan'];
}
