<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index(string $page = 'Kontrak | Edit')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('admin/dashboard', $data)
            . view('templates/footer');
    }
}
