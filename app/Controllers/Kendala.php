<?php

namespace App\Controllers;

use App\Models\KendalaModel;
use DateTime;
use DateTimeZone;

class Kendala extends BaseController
{
    public function index(string $page = 'Manajemen Dokumen | Kendala')
    {
        $model = new KendalaModel();

        $data['title'] = ucfirst($page);
        $data['kendalas'] = $model->findAll();

        return view('templates/header')
            . view('kendala/index', $data)
            . view('templates/footer');
    }

    public function manage()
    {
        $model = new KendalaModel();
        $data['kendalas'] = $model->findAll();

        return view('templates/header')
            . view('kendala/manage', $data)
            . view('templates/footer');
    }

    public function create()
    {
        return view('templates/header')
            . view('kendala/create')
            . view('templates/footer');
    }

    public function store()
    {
        $model = new KendalaModel();

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('kendala/manage'))->with('success', 'Nomor kendala telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor kendala');
    }

    public function edit($id)
    {
        $model = new KendalaModel();

        $data['kendala'] = $model->find($id);

        if (!$data['kendala']) {
            return view('templates/header')
                . view('kendala/edit', ['error' => 'Kendala dengan nomor tersebut tidak ditemukan'])
                . view('templates/footer');
        }

        return view('templates/header')
            . view('kendala/edit', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        $model = new KendalaModel();
        $model->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'catatan' => $this->request->getPost('catatan'),
        ]);

        return redirect()->to(base_url('kendala/manage'));
    }

    public function delete($id)
    {
        $model = new KendalaModel();

        $kendala_nomor = $model->find($id);

        if (!$kendala_nomor) {
            return redirect()->to(base_url('kendala/manage'))->with('error', 'Kendala dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to(base_url('kendala/manage'))->with('success', 'Nomor kendala berhasil dihapus');
    }

    public function getKendalas()
    {
        $model = new KendalaModel();
        $kendalas = $model->findAll();

        return view('templates/header')
            . view('kendala/index', ['kendalas' => $kendalas])
            . view('templates/footer');
    }

    public function maintenance(string $page = 'Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header')
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }
}
