<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveiModel extends Model
{
    protected $table            = 'survei';
    protected $primaryKey       = 'id_survei';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_survei', 'tanggal', 'pelanggan', 'telepon', 'alamat', 'sketsa', 'pengukur', 'keterangan', 'volume', 'status', 'drafter', 'biaya', 'tukang', 'tanggal_update'];
}
