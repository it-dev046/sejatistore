<?php

namespace App\Models;

use CodeIgniter\Model;

class SubkerjaModel extends Model
{
    protected $table            = 'subkerja';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_kerja', 'nama_sub', 'keterangan'];
}
