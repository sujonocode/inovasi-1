<?php

namespace App\Controllers;

class Humas extends BaseController
{
    public function index(string $page = 'humas')
    {
        $data['title'] = ucfirst($page);

        return view('humas/index');
    }
}
