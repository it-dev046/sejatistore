<?php namespace App\Controllers;

class PromoController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Promo Diskon'
        ];

        return view('admin/promo/index', $data);
    }

}
