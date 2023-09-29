<?php

namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model
{
    protected $table            = 'toko';
    protected $primaryKey       = 'id_toko';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'rek1', 'rek2', 'rek3', 'keterangan'];
}
