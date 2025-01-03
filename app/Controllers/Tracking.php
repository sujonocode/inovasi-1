<?php

namespace App\Controllers;

class Tracking extends BaseController
{
    public function index(string $page = 'Tracking')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('tracking/index')
            . view('templates/footer');
    }
}
