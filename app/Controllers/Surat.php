<?php

namespace App\Controllers;

class Surat extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
