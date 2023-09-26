<?php

namespace App\Models;

use CodeIgniter\Model;

class KatekasModel extends Model
{
    protected $table = 'katekas';
    protected $primaryKey = 'id_katekas';
    protected $allowedFields = [
        'kode',
        'keterangan',
    ];

    protected $useTimestamps = false;
}
