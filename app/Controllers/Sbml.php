<?php

namespace App\Controllers;

class Sbml extends BaseController
{
    public function index(string $page = 'SBML')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('sbml/index')
            . view('templates/footer');
    }
}
