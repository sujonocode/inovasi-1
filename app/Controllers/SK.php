<?php

namespace App\Controllers;

use App\Models\SKModel;

class SK extends BaseController
{
    public function index(string $page = 'Manajemen SK')
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
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/sk/manage')->with('success', 'Nomor SK telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor SK');
    }

    public function edit($id)
    {
        $model = new SKModel();

        $data['sk'] = $model->find($id);

        if (!$data['sk']) {
            return view('sk/edit', ['error' => 'SK dengan nomor tersebut tidak ditemukan']);
        }

        return view('/sk/edit', $data);
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

        return redirect()->to('/sk/manage');
    }

    public function delete($id)
    {
        $model = new SKModel();

        $sk_nomor = $model->find($id);

        if (!$sk_nomor) {
            return redirect()->to('/sk/manage')->with('error', 'SK dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to('/sk/manage')->with('success', 'Nomor SK berhasil dihapus');
    }

    public function getSKs()
    {
        $model = new SKModel();
        $sks = $model->findAll();

        return view('sk/index', ['sks' => $sks]);
    }
}
