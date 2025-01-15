<?php

namespace App\Controllers;

use App\Models\KontrakModel;

class Kontrak extends BaseController
{
    protected $db;

    public function __construct()
    {
        // Load the database connection
        $this->db = \Config\Database::connect();
    }

    public function index(string $page = 'Manajemen Dokumen | Kontrak')
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

    // Convert text to number
    function textToNumber3($text)
    {
        return (int)$text; // Cast the text to an integer
    }

    // Convert number to text with zero-padding to 3 digits
    function numberToText3($number)
    {
        return str_pad($number, 3, '0', STR_PAD_LEFT); // Pad with zeros to 3 characters
    }

    // Convert text to number
    function textToNumber2($text)
    {
        return (int)$text; // Cast the text to an integer
    }

    // Convert number to text with zero-padding to 3 digits
    function numberToText2($number)
    {
        return str_pad($number, 2, '0', STR_PAD_LEFT); // Pad with zeros to 3 characters
    }

    public function store()
    {
        $model = new KontrakModel();

        $nomor_surat = "";
        $nomor_urut = 0;
        $nomor_sisip = 0;

        $tanggal = $this->request->getPost('tanggal');
        list($year, $month, $day) = explode('-', $tanggal);

        if ($this->request->getPost('jenis_penomoran') == 'urut') {
            $nomor_urut_akhir = $model->selectMax('nomor_urut')->get()->getRowArray()['nomor_urut'];
            $nomor_urut = $nomor_urut_akhir + 1;
            $nomor_urut_text = $this->numberToText3($nomor_urut);
            $nomor_sisip = 0;

            $nomor_surat = $nomor_urut_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
        } elseif ($this->request->getPost('jenis_penomoran') == 'sisip') {
            $tanggal = $this->request->getPost('tanggal');
            // Query to get the desired value
            $builder = $this->db->table('kontrak');
            $query = $builder->select('id', 'nomor_urut', 'nomor_sisip')
                ->where('tanggal', $tanggal)
                ->orderBy('nomor_urut', 'DESC')
                ->orderBy('nomor_sisip', 'DESC')
                ->limit(1)
                ->get();

            $result = $query->getRow(); // Get the first row as an object

            $nomor_urut = $result->nomor_urut;
            $nomor_sisip = $result->nomor_sisip + 1;

            $nomor_urut_text = $this->numberToText3($nomor_urut);
            $nomor_sisip_text = $this->numberToText2($nomor_sisip);

            $nomor_surat = $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
        }

        $data = [
            'jenis_penomoran' => $this->request->getPost('jenis_penomoran'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'ket' => $this->request->getPost('ket'),
            'uraian' => $this->request->getPost('uraian'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $nomor_surat,
            'nomor_urut' => $nomor_urut,
            'nomor_sisip' => $nomor_sisip,
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('kontrak/manage'))->with('success', 'Nomor kontrak telah dibuat');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal membuat nomor kontrak');
    }

    public function edit($id)
    {
        $model = new KontrakModel();

        $data['kontrak'] = $model->find($id);

        if (!$data['kontrak']) {
            return view('templates/header')
                . view('kontrak/edit', ['error' => 'Kontrak dengan nomor tersebut tidak ditemukan'])
                . view('templates/footer');
        }

        return view('templates/header')
            . view('kontrak/edit', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        $builder = $this->db->table('kontrak');
        $query = $builder->select('id', 'tanggal', 'jenis_penomoran', 'nomor_urut', 'nomor_sisip')
            ->where('id', $id)
            ->limit(1)
            ->get();

        $result = $query->getRow();

        $tanggal = $result->tanggal;
        list($year, $month, $day) = explode('-', $tanggal);

        if ($result->jenis_penomoran == 'urut') {
            $nomor_urut_text = $this->numberToText3($result->nomor_urut);

            $nomor_surat = $nomor_urut_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
        } elseif ($result->jenis_penomoran == 'sisip') {
            $nomor_urut_text = $this->numberToText3($result->nomor_urut);
            $nomor_sisip_text = $this->numberToText2($result->nomor_sisip);

            $nomor_surat = $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
        }

        $model = new KontrakModel();
        $model->update($id, [
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'ket' => $this->request->getPost('ket'),
            'uraian' => $this->request->getPost('uraian'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $nomor_surat,
        ]);

        return redirect()->to(base_url('kontrak/manage'));
    }

    public function delete($id)
    {
        $model = new KontrakModel();

        $kontrak_nomor = $model->find($id);

        if (!$kontrak_nomor) {
            return redirect()->to(base_url('kontrak/manage'))->with('error', 'Kontrak dengan nomor tersebut tidak ditemukan');
        }

        $model->delete($id);

        return redirect()->to(base_url('kontrak/manage'))->with('success', 'Nomor kontrak berhasil dihapus');
    }

    public function getKontraks()
    {
        $model = new KontrakModel();
        $kontraks = $model->findAll();

        return view('templates/header')
            . view('kontrak/index', ['kontraks' => $kontraks])
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
