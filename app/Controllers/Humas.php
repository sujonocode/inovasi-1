<?php

namespace App\Controllers;

class Humas extends BaseController
{
    public function index(string $page = 'humas')
    {
        $data['title'] = ucfirst($page);

        // return view('humas/index');
        return view('templates/header', $data)
        . view('humas/index')
        . view('templates/footer');
    }
}
