<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailbahanModel extends Model
{
    protected $table            = 'detail_bahan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_pasang', 'id_produk', 'keterangan', 'jumlah', 'tanggal'];
}
