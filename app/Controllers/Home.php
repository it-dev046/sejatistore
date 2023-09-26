<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Seri Tutorial CodeIgniter 4: Login dan Register @ qadrlabs.com'
        ];

        return view('home', $data);
    }

}
