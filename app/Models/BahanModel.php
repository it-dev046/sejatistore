<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanModel extends Model
{
    protected $table            = 'bahan_pasang';
    protected $primaryKey       = 'id_pasang';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_pasang', 'alamat', 'tanggal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';
}
