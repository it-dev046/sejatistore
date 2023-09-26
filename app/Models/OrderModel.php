<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'order';
    protected $primaryKey       = 'id_order';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'pemesan', 'penerima', 'kerja', 'toko', 'keterangan', 'tanggal_acc', 'nota', 'bukti', 'status'];
}
