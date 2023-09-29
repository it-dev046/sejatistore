<?php

namespace App\Models;

use CodeIgniter\Model;

class PiutangModel extends Model
{
    protected $table            = 'piutang';
    protected $primaryKey       = 'id_piutang';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'id_rekening', 'alamat', 'saldo', 'keterangan'];
}
