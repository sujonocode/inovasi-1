<?php

namespace App\Controllers;

use App\Models\ScheduleModel;
use CodeIgniter\Controller;

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

    public function manage()
    {
        $model = new ScheduleModel();
        $data['schedules'] = $model->findAll();

        return view('humas/manage', $data);
    }

    public function create()
    {
        return view('humas/create');
    }

    public function store()
    {
        $model = new ScheduleModel();
        $model->save([
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/humas/manage');
    }

    public function edit($id)
    {
        $model = new ScheduleModel();

        // Fetch the schedule data by ID
        $data['schedule'] = $model->find($id);

        // If the record doesn't exist, show an error message on the edit page
        if (!$data['schedule']) {
            // Pass an error message directly to the edit view
            return view('humas/edit', ['error' => 'Schedule not found.']);
        }

        // If the record exists, load the edit form
        return view('humas/edit', $data);
    }

    public function update($id)
    {
        $model = new ScheduleModel();
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('humas/manage');
    }

    public function delete($id)
    {
        // $model = new ScheduleModel();
        // $model->delete($id);

        // return redirect()->to('/schedule');
        $model = new ScheduleModel();

        // Fetch the schedule data by ID
        $schedule = $model->find($id);

        // If the record doesn't exist, redirect with an error message
        if (!$schedule) {
            return redirect()->to('humas/manage')->with('error', 'Schedule not found.');
        }

        // Proceed with deletion
        $model->delete($id);

        // Redirect with a success message after deletion
        return redirect()->to('humas/manage')->with('success', 'Schedule deleted successfully.');
    }

    public function getEvents()
    {
        $model = new \App\Models\ScheduleModel();
        $schedules = $model->findAll();

        return view('humas/index', ['schedules' => $schedules]);
    }
}
