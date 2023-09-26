<?php

namespace App\Models;

use CodeIgniter\Model;

class UkuranModel extends Model
{
    protected $table            = 'ukuran';
    protected $primaryKey       = 'id_ukuran';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'keterangan'];
}
