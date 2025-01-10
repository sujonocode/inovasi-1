<?php

namespace App\Controllers;

use App\Models\SuratModel;

class GenerateSurat extends BaseController
{
    public function index(string $page = 'Surat')
    {
        $model = new SuratModel();
        $data['title'] = ucfirst($page);
        $data['surats'] = $model->findAll();

        return view('templates/header')
            . view('surat/index', $data)
            . view('templates/footer');
    }

    public function manage()
    {
        $model = new SuratModel();
        $data['surats'] = $model->findAll();

        return view('templates/header')
            . view('surat/manage', $data)
            . view('templates/footer');
    }

    public function create()
    {
        return view('templates/header')
            . view('surat/create')
            . view('templates/footer');
    }

    public function store()
    {
        $model = new SuratModel();

        // Validate and save the data
        $data = [
            'nomor' => $this->request->getPost('nomor'),
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ];

        if ($model->save($data)) {
            // Schedule added successfully. Now send the notification.
            // $this->sendNotification();

            // Redirect with success message
            return redirect()->to('/surat/manage')->with('success', 'Surat telah dibuat');
        }

        // Handle failure case
        return redirect()->back()->withInput()->with('error', 'Failed to create the surat');
    }

    public function edit($id)
    {
        $model = new SuratModel();

        // Fetch the schedule data by ID
        $data['surat'] = $model->find($id);

        // If the record doesn't exist, show an error message on the edit page
        if (!$data['surat']) {
            // Pass an error message directly to the edit view
            return view('surat/edit', ['error' => 'Surat not found.']);
        }

        // If the record exists, load the edit form
        return view('surat/edit', $data);
    }

    public function update($id)
    {
        $model = new SuratModel();
        $model->update($id, [
            'nomor' => $this->request->getPost('nomor'),
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('surat/manage');
    }

    public function delete($id)
    {
        $model = new SuratModel();

        // Fetch the schedule data by ID
        $surat = $model->find($id);

        // If the record doesn't exist, redirect with an error message
        if (!$surat) {
            return redirect()->to('surat/manage')->with('error', 'Surat not found.');
        }

        // Proceed with deletion
        $model->delete($id);

        // Redirect with a success message after deletion
        return redirect()->to('surat/manage')->with('success', 'Surat deleted successfully.');
    }

    public function getSurats()
    {
        $model = new \App\Models\SuratModel();
        $surats = $model->findAll();

        return view('surat/index', ['surats' => $surats]);
    }
}
