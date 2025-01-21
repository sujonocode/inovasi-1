<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index(string $page = 'beranda')
    {
        $data['title'] = ucfirst($page);

        if (! is_file(APPPATH . 'Views/index.php')) {
            throw new PageNotFoundException($page);
        }

        return
            view('templates/header', $data)
            . view('index')
            . view('templates/footer');
    }
}
