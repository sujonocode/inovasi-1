<?php

namespace App\Controllers;

use App\Models\SuratModel;

class Surat extends BaseController
{
    public function index(string $page = 'Manajemen Dokumen | Surat')
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

        // Query to get min, max, and count
        $data = $model->selectMin('nomor_urut')
            ->selectMax('nomor_urut')
            ->selectCount('nomor_urut')
            ->get()
            ->getRowArray();

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('surat/manage'))->with('success', 'Nomor surat telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor surat');

        // if ($model->save($data)) {
        //     // Pass additional data in the redirect
        //     return redirect()
        //         ->to(base_url('surat/manage'))
        //         ->with('success', 'Data has been added successfully.')
        //         ->with('newData', $data); // Add additional data here
        // }

        // return redirect()->back()->withInput()->with('error', 'Failed to add data.');

        //         <body>
        //     <h1>Manage Surat</h1>
        //     <p>Minimum Nomor Urut: <?= $data['nomor_urut'] ? ></p>
        //     <p>Maximum Nomor Urut: <?= $data['nomor_urut_max'] ? ></p>
        //     <p>Total Count: <?= $data['nomor_urut_count'] ? ></p>
        // </body>

        // $suratModel = new SuratModel();

        // // Get the minimum value
        // $min = $suratModel->selectMin('nomor_urut')->get()->getRowArray()['nomor_urut'];

        // // Get the maximum value
        // $max = $suratModel->selectMax('nomor_urut')->get()->getRowArray()['nomor_urut'];

        // // Get the count
        // $count = $suratModel->selectCount('nomor_urut')->get()->getRowArray()['nomor_urut'];

        // // Pass data to the view
        // return view('surat/manage', [
        //     'min' => $min,
        //     'max' => $max,
        //     'count' => $count,
        // ]);

        //         <body>
        //     <h1>Manage Surat</h1>
        //     <p>Minimum Nomor Urut: <?= $min ? ></p>
        //     <p>Maximum Nomor Urut: <?= $max ? ></p>
        //     <p>Total Count: <?= $count ? ></p>
        // </body>
    }

    public function edit($id)
    {
        $model = new SuratModel();

        $data['surat'] = $model->find($id);

        if (!$data['surat']) {
            return view('templates/header')
                . view('surat/edit', ['error' => 'Surat dengan nomor tersebut tidak ditemukan'])
                . view('templates/footer');
        }

        return view('templates/header')
            . view('surat/edit', $data)
            . view('templates/footer');
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

        return redirect()->to(base_url('surat/manage'));
    }

    public function delete($id)
    {
        $model = new SuratModel();

        $surat_nomor = $model->find($id);

        if (!$surat_nomor) {
            return redirect()->to(base_url('surat/manage'))->with('error', 'Surat dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to(base_url('surat/manage'))->with('success', 'Nomor surat berhasil dihapus');
    }

    public function getSurats()
    {
        $model = new SuratModel();
        $surats = $model->findAll();

        return view('templates/header')
            . view('surat/index', ['surats' => $surats])
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
