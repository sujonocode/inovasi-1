<?php

namespace App\Controllers;

use App\Models\ScheduleModel;

class Humas extends BaseController
{
    public function index(string $page = 'humas')
    {
        $model = new ScheduleModel();
        $data['title'] = ucfirst($page);
        $data['events'] = $model->findAll();

        // return view('humas/index');
        return view('templates/header', $data)
            . view('humas/index')
            . view('templates/footer');
    }
}
