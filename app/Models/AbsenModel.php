<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table            = 'absen';
    protected $primaryKey       = 'id_absen';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'status', 'potongan'];
}
