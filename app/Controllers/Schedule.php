<?php

namespace App\Controllers;

use App\Models\ScheduleModel;
use CodeIgniter\Controller;

class Schedule extends Controller
{
    public function index()
    {
        $model = new ScheduleModel();
        $data['schedules'] = $model->findAll();

        return view('schedule/index', $data);
    }

    public function create()
    {
        return view('schedule/create');
    }

    public function store()
    {
        $model = new ScheduleModel();
        $model->save([
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/schedule');
    }

    public function edit($id)
    {
        $model = new ScheduleModel();
        $data['schedule'] = $model->find($id);

        if (!$data['schedule']) {
            return redirect()->to('/schedule')->with('error', 'Schedule not found.');
        }

        return view('schedule/edit', $data);
    }

    public function update($id)
    {
        $model = new ScheduleModel();
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/schedule');
    }

    public function delete($id)
    {
        $model = new ScheduleModel();
        $model->delete($id);

        return redirect()->to('/schedule');
    }

    public function getEvents()
    {
        $model = new \App\Models\ScheduleModel();
        $schedules = $model->findAll();

        return view('humas/index', ['schedules' => $schedules]);
    }
}
