<?php

namespace App\Models;

use CodeIgniter\Model;

class KatepelModel extends Model
{
    protected $table            = 'katepel';
    protected $primaryKey       = 'id_katepel';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_katepel', 'diskon_khusus', 'slug_katepel', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';
}
