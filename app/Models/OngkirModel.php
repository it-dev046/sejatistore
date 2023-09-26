<?php

namespace App\Models;

use CodeIgniter\Model;

class OngkirModel extends Model
{
    protected $table            = 'ongkir';
    protected $primaryKey       = 'id_ongkir';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_wilayah', 'biaya'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';
}
