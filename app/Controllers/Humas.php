<?php

namespace App\Controllers;

class Humas extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
