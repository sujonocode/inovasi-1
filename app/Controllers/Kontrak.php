<?php

namespace App\Controllers;

use App\Models\KontrakModel;

class Kontrak extends BaseController
{
    public function index(string $page = 'Manajemen Kontrak')
    {
        $model = new KontrakModel();
        $data['title'] = ucfirst($page);
        $data['kontraks'] = $model->findAll();

        return view('templates/header')
            . view('kontrak/index', $data)
            . view('templates/footer');
    }

    public function manage()
    {
        $model = new KontrakModel();
        $data['kontraks'] = $model->findAll();

        return view('templates/header')
            . view('kontrak/manage', $data)
            . view('templates/footer');
    }

    public function create()
    {
        return view('templates/header')
            . view('kontrak/create')
            . view('templates/footer');
    }

    public function store()
    {
        $model = new KontrakModel();

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nomor' => $this->request->getPost('nomor'),
            'uraian' => $this->request->getPost('uraian'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/kontrak/manage')->with('success', 'Nomor kontrak telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor kontrak');
    }

    public function edit($id)
    {
        $model = new KontrakModel();

        $data['kontrak'] = $model->find($id);

        if (!$data['kontrak']) {
            return view('kontrak/edit', ['error' => 'Kontrak dengan nomor tersebut tidak ditemukan']);
        }

        return view('/kontrak/edit', $data);
    }

    public function update($id)
    {
        $model = new KontrakModel();
        $model->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'nomor' => $this->request->getPost('nomor'),
            'uraian' => $this->request->getPost('uraian'),
            'catatan' => $this->request->getPost('catatan'),
        ]);

        return redirect()->to('/kontrak/manage');
    }

    public function delete($id)
    {
        $model = new KontrakModel();

        $kontrak_nomor = $model->find($id);

        if (!$kontrak_nomor) {
            return redirect()->to('/kontrak/manage')->with('error', 'Kontrak dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to('/kontrak/manage')->with('success', 'Nomor kontrak berhasil dihapus');
    }

    public function getKontraks()
    {
        $model = new KontrakModel();
        $kontraks = $model->findAll();

        return view('kontrak/index', ['kontraks' => $kontraks]);
    }
}
