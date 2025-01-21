<?php

namespace App\Controllers;

use App\Models\TrackingModel;
use DateTime;
use DateTimeZone;

class Tracking extends BaseController
{
    public function index(string $page = 'Tracking')
    {
        $model = new TrackingModel();

        $data['title'] = ucfirst($page);
        $data['trackings'] = $model->findAll();

        return view('templates/header', $data)
            . view('tracking/index', $data)
            . view('templates/footer');
    }

    public function manage(string $page = 'Tracking | Create')
    {
        $model = new TrackingModel();

        $data['title'] = ucfirst($page);
        $data['trackings'] = $model->findAll();

        return view('templates/header', $data)
            . view('tracking/manage', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'Tracking | Create')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('tracking/create')
            . view('templates/footer');
    }

    public function store()
    {
        $model = new TrackingModel();

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('tracking/manage'))->with('success', 'Nomor tracking telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor tracking');
    }

    public function edit($id)
    {
        $model = new TrackingModel();

        $data['tracking'] = $model->find($id);
        $data['title'] = ucfirst('Tracking | Edit');

        if (!$data['tracking']) {
            return view('templates/header')
                . view('tracking/edit', ['error' => 'Tracking dengan nomor tersebut tidak ditemukan'])
                . view('templates/footer');
        }

        return view('templates/header', $data)
            . view('tracking/edit', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        $model = new TrackingModel();
        $model->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'pert_dahulu' => $this->request->getPost('pert_dahulu'),
            'pert_berikut' => $this->request->getPost('pert_berikut'),
            'catatan' => $this->request->getPost('catatan'),
        ]);

        return redirect()->to(base_url('tracking/manage'));
    }

    public function delete($id)
    {
        $model = new TrackingModel();

        $tracking_nomor = $model->find($id);

        if (!$tracking_nomor) {
            return redirect()->to(base_url('tracking/manage'))->with('error', 'Tracking dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to(base_url('tracking/manage'))->with('success', 'Nomor tracking berhasil dihapus');
    }

    public function getTrackings()
    {
        $model = new TrackingModel();
        $trackings = $model->findAll();

        return view('templates/header')
            . view('tracking/index', ['trackings' => $trackings])
            . view('templates/footer');
    }

    public function maintenance(string $page = 'Tracking | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }
}
