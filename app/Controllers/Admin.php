<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index()
    {
        return view('templates/header')
            . view('admin/dashboard')
            . view('templates/footer');
    }
}
