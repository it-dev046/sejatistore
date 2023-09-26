<?php

namespace App\Controllers;

class BerandaController extends BaseController
{
    public function index()
    {
        $data = [
            'page' => $this->PageModel->findAll(),
            'daftar_project' => $this->ProjectModel->findAll(),
            'daftar_partner' => $this->PartnerModel->findAll(),
            'daftar_testimoni' => $this->TestimoniModal->findAll()
        ];

        return view('beranda/index', $data);
    }
}
