<?php

namespace App\Models;

use CodeIgniter\Model;

class DepositModel extends Model
{
    protected $table            = 'deposit';
    protected $primaryKey       = 'id_deposit';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'nilai', 'keterangan'];
}
