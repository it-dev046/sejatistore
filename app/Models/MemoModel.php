<?php

namespace App\Models;

use CodeIgniter\Model;

class MemoModel extends Model
{
    protected $table            = 'memo';
    protected $primaryKey       = 'id_memo';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'nomor', 'alamat', 'telpon', 'barang'];
}
