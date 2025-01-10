<?php

namespace App\Controllers;

class Dokumen extends BaseController
{
    public function index(string $page = 'Manajemen Dokumen')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header')
            . view('dokumen/index', $data)
            . view('templates/footer');
    }
}
