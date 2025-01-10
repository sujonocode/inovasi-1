<?php

namespace App\Controllers;

use App\Models\SuratModel;

class Surat extends BaseController
{
    public function index(string $page = 'Manajemen Surat')
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

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/surat/manage')->with('success', 'Nomor surat telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor surat');
    }

    public function edit($id)
    {
        $model = new SuratModel();

        $data['surat'] = $model->find($id);

        if (!$data['surat']) {
            return view('surat/edit', ['error' => 'Surat dengan nomor tersebut tidak ditemukan']);
        }

        return view('/surat/edit', $data);
    }

    public function update($id)
    {
        $model = new SuratModel();
        $model->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'catatan' => $this->request->getPost('catatan'),
        ]);

        return redirect()->to('/surat/manage');
    }

    public function delete($id)
    {
        $model = new SuratModel();

        $surat_nomor = $model->find($id);

        if (!$surat_nomor) {
            return redirect()->to('/surat/manage')->with('error', 'Surat dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to('/surat/manage')->with('success', 'Nomor surat berhasil dihapus');
    }

    public function getSurats()
    {
        $model = new SuratModel();
        $surats = $model->findAll();

        return view('surat/index', ['surats' => $surats]);
    }
}
