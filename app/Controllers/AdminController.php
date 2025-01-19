<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }
}
