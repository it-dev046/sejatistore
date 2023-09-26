<?php

namespace App\Models;

use CodeIgniter\Model;

class KembaliModel extends Model
{
    protected $table            = 'produk_kembali';
    protected $primaryKey       = 'id_kembali';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_detail', 'jumlah_kembali', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';
}
