<?php

namespace App\Controllers;

use App\Models\SuratNomorModel;

class SuratNomor extends BaseController
{
    public function index(string $page = 'Manajemen Surat')
    {
        $model = new SuratNomorModel();
        $data['title'] = ucfirst($page);
        $data['surat_nomors'] = $model->findAll();

        return view('templates/header')
            . view('surat/index_nomor', $data)
            . view('templates/footer');
    }

    public function manage()
    {
        $model = new SuratNomorModel();
        $data['surat_nomors'] = $model->findAll();

        return view('templates/header')
            . view('surat/manage_nomor', $data)
            . view('templates/footer');
    }

    public function create()
    {
        return view('templates/header')
            . view('surat/create_nomor')
            . view('templates/footer');
    }

    public function store()
    {
        $model = new SuratNomorModel();

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
            return redirect()->to('/surat/manage_nomor')->with('success', 'Surat telah dibuat');
        }

        // Handle failure case
        return redirect()->back()->withInput()->with('error', 'Failed to create the surat');
    }

    public function edit($id)
    {
        $model = new SuratNomorModel();

        // Fetch the schedule data by ID
        $data['surat_nomor'] = $model->find($id);

        // If the record doesn't exist, show an error message on the edit page
        if (!$data['surat_nomor']) {
            // Pass an error message directly to the edit view
            return view('surat/edit_nomor', ['error' => 'Surat not found.']);
        }

        // If the record exists, load the edit form
        return view('surat/edit_nomor', $data);
    }

    public function update($id)
    {
        $model = new SuratNomorModel();
        $model->update($id, [
            'nomor' => $this->request->getPost('nomor'),
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('surat/manage_nomor');
    }

    public function delete($id)
    {
        $model = new SuratNomorModel();

        // Fetch the schedule data by ID
        $surat_nomor = $model->find($id);

        // If the record doesn't exist, redirect with an error message
        if (!$surat_nomor) {
            return redirect()->to('surat/manage_nomor')->with('error', 'Surat not found.');
        }

        // Proceed with deletion
        $model->delete($id);

        // Redirect with a success message after deletion
        return redirect()->to('surat/manage_nomor')->with('success', 'Surat deleted successfully.');
    }

    public function getSuratNomors()
    {
        $model = new \App\Models\SuratNomorModel();
        $surat_nomors = $model->findAll();

        return view('surat/index_nomor', ['surats' => $surat_nomors]);
    }
}
