<?php

namespace App\Models;

use CodeIgniter\Model;

date_default_timezone_set("Asia/Manila");

class DetailBulananModel extends Model
{
    protected $table            = 'detail_bulanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'id_bulanan', 'bayar', 'keterangan'];
    protected $useTimestamps = false;
}
