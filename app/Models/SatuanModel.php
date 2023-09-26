<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanModel extends Model
{
    protected $table            = 'satuan_produk';
    protected $primaryKey       = 'id_satuan';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_satuan','singkatan','slug_satuan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';
    
}
