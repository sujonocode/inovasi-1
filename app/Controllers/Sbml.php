<?php

namespace App\Controllers;

class Sbml extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
