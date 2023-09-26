<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table            = 'page';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['home_titel', 'home_judul', 'home_text', 'home_gambar', 'about_titel', 'about_judul', 'about_text', 'about_list', 'about_gambar', 'about_nomor', 'about_text3', 'project_titel', 'project_judul', 'projects_gambar', 'partner_titel', 'partner_judul', 'testimoni_titel', 'testimoni_judul', 'contact_titel', 'contact_judul', 'google_map', 'email', 'telpon', 'alamat', 'logo', 'nama_usaha', 'slogan', 'link_fb', 'link_ig', 'link_yt', 'link_wa'];
}
