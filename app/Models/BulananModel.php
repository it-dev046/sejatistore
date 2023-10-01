<?php

namespace App\Models;

use CodeIgniter\Model;

class BulananModel extends Model
{
    protected $table            = 'bulanan';
    protected $primaryKey       = 'id_bulanan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_rekening', 'nomor', 'tempo', 'keterangan'];
}
