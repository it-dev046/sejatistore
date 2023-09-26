<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimoniModal extends Model
{
    protected $table            = 'testimoni';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_pelanggan', 'project', 'ucapan'];
}
