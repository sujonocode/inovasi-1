<?php

namespace App\Controllers;

use App\Models\SKModel;

class SK extends BaseController
{
    public function index(string $page = 'Manajemen Dokumen | SK')
    {
        $model = new SKModel();

        $data['title'] = ucfirst($page);
        $data['sks'] = $model->findAll();

        return view('templates/header')
            . view('sk/index', $data)
            . view('templates/footer');
    }

    public function manage()
    {
        $model = new SKModel();

        $data['sks'] = $model->findAll();

        return view('templates/header')
            . view('sk/manage', $data)
            . view('templates/footer');
    }

    public function create()
    {
        return view('templates/header')
            . view('sk/create')
            . view('templates/footer');
    }

    public function store()
    {
        $model = new SKModel();

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nomor' => $this->request->getPost('nomor'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('sk/manage'))->with('success', 'Nomor SK telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor SK');
    }

    public function edit($id)
    {
        $model = new SKModel();

        $data['sk'] = $model->find($id);

        if (!$data['sk']) {
            return view('templates/header')
                . view('sk/edit', ['error' => 'SK dengan nomor tersebut tidak ditemukan'])
                . view('templates/footer');
        }

        return view('templates/header')
            . view('/sk/edit', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        $model = new SKModel();
        $model->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'nomor' => $this->request->getPost('nomor'),
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
        ]);

        return redirect()->to(base_url('sk/manage'));
    }

    public function delete($id)
    {
        $model = new SKModel();

        $sk_nomor = $model->find($id);

        if (!$sk_nomor) {
            return redirect()->to(base_url('sk/manage'))->with('error', 'SK dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to(base_url('sk/manage'))->with('success', 'Nomor SK berhasil dihapus');
    }

    public function getSKs()
    {
        $model = new SKModel();
        $sks = $model->findAll();

        return view('templates/header')
            . view('sk/index', ['sks' => $sks])
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
