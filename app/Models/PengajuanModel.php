<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table            = 'pengajuan';
    protected $primaryKey       = 'id_pengajuan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'id_rekening', 'nilai', 'keterangan'];
}
