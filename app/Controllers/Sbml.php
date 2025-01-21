<?php

namespace App\Controllers;

use App\Models\SbmlModel;
use DateTime;
use DateTimeZone;

class Sbml extends BaseController
{
    public function index(string $page = 'Sbml')
    {
        $model = new SbmlModel();

        $data['title'] = ucfirst($page);
        $data['sbmls'] = $model->findAll();

        return view('templates/header', $data)
            . view('sbml/index', $data)
            . view('templates/footer');
    }

    public function manage(string $page = 'SBML | Manage')
    {
        $model = new SbmlModel();

        $data['title'] = ucfirst($page);
        $data['sbmls'] = $model->findAll();

        return view('templates/header', $data)
            . view('sbml/manage', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'SBML | Create')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('sbml/create')
            . view('templates/footer');
    }

    public function store()
    {
        $model = new SbmlModel();

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('sbml/manage'))->with('success', 'Nomor sbml telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor sbml');
    }

    public function edit($id)
    {
        $model = new SbmlModel();

        $data['sbml'] = $model->find($id);
        $data['title'] = ucfirst('SBML | Edit');

        if (!$data['sbml']) {
            return view('templates/header')
                . view('sbml/edit', ['error' => 'Sbml dengan nomor tersebut tidak ditemukan'])
                . view('templates/footer');
        }

        return view('templates/header', $data)
            . view('sbml/edit', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        $model = new SbmlModel();
        $model->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'catatan' => $this->request->getPost('catatan'),
        ]);

        return redirect()->to(base_url('sbml/manage'));
    }

    public function delete($id)
    {
        $model = new SbmlModel();

        $sbml_nomor = $model->find($id);

        if (!$sbml_nomor) {
            return redirect()->to(base_url('sbml/manage'))->with('error', 'Sbml dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to(base_url('sbml/manage'))->with('success', 'Nomor sbml berhasil dihapus');
    }

    public function getSbmls()
    {
        $model = new SbmlModel();
        $sbmls = $model->findAll();

        return view('templates/header')
            . view('sbml/index', ['sbmls' => $sbmls])
            . view('templates/footer');
    }

    public function maintenance(string $page = 'SBML | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }
}
