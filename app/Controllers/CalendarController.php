<?php

namespace App\Controllers;

use App\Models\EventModel;

class CalendarController extends BaseController
{
    public function index()
    {
        return view('calendar');
    }

    public function fetchEvents()
    {
        $model = new EventModel();
        $events = $model->findAll();
        return $this->response->setJSON($events);
    }
}
