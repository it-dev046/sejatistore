<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table            = 'project';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_project', 'deskripsi', 'pelanggan', 'pengerjaan', 'tanggal', 'gambar'];
}
