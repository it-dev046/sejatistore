<?php

namespace App\Models;

use CodeIgniter\Model;

class HutangModel extends Model
{
    protected $table            = 'hutang';
    protected $primaryKey       = 'id_hutang';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'id_rekening', 'alamat', 'total', 'keterangan'];
}
