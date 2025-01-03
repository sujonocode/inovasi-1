<?php

namespace App\Controllers;

class Surat extends BaseController
{
    public function index(string $page = 'Surat')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('sbml/index')
            . view('templates/footer');
    }
}
