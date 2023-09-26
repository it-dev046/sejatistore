<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';
    protected $primaryKey       = 'id_karyawan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'ktp', 'gapok', 'um', 'op', 'rekening', 'bank', 'posisi', 'alamat'];
}
