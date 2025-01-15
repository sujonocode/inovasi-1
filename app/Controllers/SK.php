<?php

namespace App\Controllers;

use App\Models\SKModel;

class SK extends BaseController
{
    protected $db;

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

    function textToNumber3($text)
    {
        return (int)$text;
    }

    function numberToText3($number)
    {
        return str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    function textToNumber2($text)
    {
        return (int)$text;
    }

    function numberToText2($number)
    {
        return str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    public function store()
    {
        $model = new SKModel();

        $tanggal = $this->request->getPost('tanggal');
        list($year, $month, $day) = explode('-', $tanggal);

        if ($this->request->getPost('jenis_penomoran') == 'urut') {
            $nomor_urut_akhir = $model->selectMax('nomor_urut')->get()->getRowArray()['nomor_urut'];
            $nomor_urut = $nomor_urut_akhir + 1;
            $nomor_urut_text = $this->numberToText3($nomor_urut);
            $nomor_sisip = 0;

            $nomor = $nomor_urut_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
        } elseif ($this->request->getPost('jenis_penomoran') == 'sisip') {
            $tanggal = $this->request->getPost('tanggal');
            // Query to get the desired value
            $builder = $this->db->table('kontrak');
            $query = $builder->select('id, nomor_urut, nomor_sisip')
                ->where('tanggal', $tanggal)
                ->orderBy('nomor_urut', 'DESC')
                ->orderBy('nomor_sisip', 'DESC')
                ->limit(1)
                ->get();

            $result = $query->getRow();

            $nomor_urut = $result->nomor_urut;
            $nomor_sisip = $result->nomor_sisip + 1;

            $nomor_urut_text = $this->numberToText3($nomor_urut);
            $nomor_sisip_text = $this->numberToText2($nomor_sisip);

            $nomor = $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
        }

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nomor' => $this->request->getPost('nomor'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
            'nomor_urut' => $nomor_urut,
            'nomor_sisip' => $nomor_sisip,
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('sk/manage'))->with('success', 'Data SK berhasil disimpan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data SK');
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

        $builder = $this->db->table('kontrak');
        $query = $builder->select('id, tanggal, jenis_penomoran, nomor_urut, nomor_sisip')
            ->where('id', $id)
            ->orderBy('nomor_urut', 'DESC')
            ->orderBy('nomor_sisip', 'DESC')
            ->limit(1)
            ->get();

        $result = $query->getRow();
        $tanggal = $result->tanggal;
        list($year, $month, $day) = explode('-', $tanggal);

        if ($result->jenis_penomoran == 'urut') {
            $nomor_urut_text = $this->numberToText3($result->nomor_urut);

            $nomor = $nomor_urut_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
        } elseif ($result->jenis_penomoran == 'sisip') {
            $nomor_urut_text = $this->numberToText3($result->nomor_urut);
            $nomor_sisip_text = $this->numberToText2($result->nomor_sisip);

            $nomor = $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
        }

        $model->update($id, [
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $this->request->$nomor,
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
