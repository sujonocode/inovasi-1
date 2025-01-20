<?php

namespace App\Controllers;

use App\Models\KontrakModel;
use App\Models\KodeArsipModel;

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

    public function create(string $page = 'Kontrak | Tambah')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        // Set up the data array
        $data = [
            'title' => ucfirst($page),
        ];

        // Fetch distinct 'jenis' options from the 'kode_arsip' table
        $db = \Config\Database::connect();
        $data['jenisOptions'] = $db->table('kode_arsip')
            ->select('jenis')
            ->distinct()
            ->get()
            ->getResultArray();

        return view('templates/header')
            . view('kontrak/create', $data)
            . view('templates/footer');
    }

    public function getKode1()
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());
        if ($this->request->isAJAX()) {
            $jenis = $this->request->getPost('jenis');
            $db = \Config\Database::connect();
            $kode1Options = $db->table('kode_arsip')
                ->select('kode_1')
                ->distinct()
                ->where('jenis', $jenis)
                ->get()
                ->getResultArray();

            return $this->response
                ->setHeader('X-CSRF-TOKEN', csrf_hash()) // Send new token
                ->setJSON($kode1Options);
        }
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function getKodeKlasifikasi()
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());
        if ($this->request->isAJAX()) {
            $kode1 = $this->request->getPost('kode_1');
            $db = \Config\Database::connect();
            $kodeKlasifikasiOptions = $db->table('kode_arsip')
                ->select('kode_klasifikasi')
                ->distinct()
                ->where('kode_1', $kode1)
                ->get()
                ->getResultArray();

            // Debug CSRF token
            // log_message('debug', 'New CSRF Token (getKodeKlasifikasi): ' . csrf_hash());

            return $this->response
                ->setHeader('X-CSRF-TOKEN', csrf_hash()) // Send new token
                ->setJSON($kodeKlasifikasiOptions);
        }
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function getKodeArsip()
    {
        // Get the selected 'kode_klasifikasi' from the request
        $kodeKlasifikasi = $this->request->getPost('kode_klasifikasi');

        // Assuming you have a model for the table, e.g., KodeArsipModel
        $kodeArsipModel = new KodeArsipModel();

        // Retrieve the 'kode_arsip' based on the selected 'kode_klasifikasi'
        $result = $kodeArsipModel->where('kode_klasifikasi', $kodeKlasifikasi)->first();
        $this->response->setHeader('X-CSRF-Token', csrf_hash());
        // Return the result as JSON
        if ($result) {
            return $this->response->setJSON(['kode_arsip' => $result['kode']]);
        } else {
            return $this->response->setJSON(null);
        }
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
        if ($this->request->getMethod() === 'post' && !$this->validate([
            'csrf_token' => 'required|csrf_token'
        ])) {
            return redirect()->back()->with('error', 'Invalid CSRF token!');
        }

        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new KontrakModel();

        $username = session()->get('username');

        // log_message('debug', 'CSRF Token from Form: ' . $this->request->getPost('csrf_token_name'));
        // log_message('debug', 'CSRF Token from Session: ' . session()->get('csrf_token_name'));

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
            'jenis_penomoran' => $this->request->getPost('jenis_penomoran'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'ket' => $this->request->getPost('ket'),
            'uraian' => $this->request->getPost('uraian'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
            'nomor_urut' => $nomor_urut,
            'nomor_sisip' => $nomor_sisip,
            'created_by' => $username,
        ];

        // log_message('debug', 'CSRF Token from POST: ' . $this->request->getPost('_csrf'));

        if ($model->save($data)) {
            return redirect()->to(base_url('kontrak/manage'))->with('success', 'Data kontrak berhasil disimpan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data kontrak');
    }

    public function edit($id, string $page = 'Kontrak | Edit')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new KontrakModel();

        // Fetch the kontrak data by id
        $kontrak = $model->find($id);
        $data = ['kontrak' => $kontrak];

        // If kontrak data is not found, show error and redirect
        if (!$kontrak) {
            session()->setFlashdata('error', 'Data kontrak tidak ditemukan.');
            return redirect()->to(base_url('/kontrak/manage'));
        }

        // Fetch distinct 'jenis' options from the 'kode_arsip' table
        $db = \Config\Database::connect();
        $data['jenisOptions'] = $db->table('kode_arsip')
            ->select('jenis')
            ->distinct()
            ->get()
            ->getResultArray();

        // Add title to the data array
        $data['title'] = ucfirst($page);

        // Return the view with all the data
        return view('templates/header')
            . view('kontrak/edit', $data)
            . view('templates/footer');
    }


    // public function update($id)
    // {
    //     if ($this->request->getMethod() === 'post' && !$this->validate([
    //         'csrf_token' => 'required|csrf_token'
    //     ])) {
    //         return redirect()->back()->with('error', 'Invalid CSRF token!');
    //     }

    //     $response = $this->response;
    //     $response->setHeader('X-CSRF-TOKEN', csrf_hash());

    //     $model = new KontrakModel();

    //     $builder = $this->db->table('kontrak');
    //     $query = $builder->select('id, tanggal, jenis_penomoran, nomor_urut, nomor_sisip')
    //         ->where('id', $id)
    //         ->orderBy('nomor_urut', 'DESC')
    //         ->orderBy('nomor_sisip', 'DESC')
    //         ->limit(1)
    //         ->get();

    //     $result = $query->getRow();
    //     $tanggal = $result->tanggal;
    //     list($year, $month, $day) = explode('-', $tanggal);

    //     if ($result->jenis_penomoran == 'urut') {
    //         $nomor_urut_text = $this->numberToText3($result->nomor_urut);

    //         $nomor = $nomor_urut_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
    //     } elseif ($result->jenis_penomoran == 'sisip') {
    //         $nomor_urut_text = $this->numberToText3($result->nomor_urut);
    //         $nomor_sisip_text = $this->numberToText2($result->nomor_sisip);

    //         $nomor = $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $this->request->getPost('ket') . '/' . $this->request->getPost('kode_arsip') . '/' . $month . '/' . $year;
    //     }

    //     $model->update($id, [
    //         'kode_arsip' => $this->request->getPost('kode_arsip'),
    //         'ket' => $this->request->getPost('ket'),
    //         'uraian' => $this->request->getPost('uraian'),
    //         'catatan' => $this->request->getPost('catatan'),
    //         'url' => $this->request->getPost('url'),
    //         'nomor' => $nomor,
    //     ]);

    //     return redirect()->to(base_url('kontrak/manage'))->with('error', 'Contract not found.');;
    // }

    public function update($id)
    {
        // CSRF validation
        if ($this->request->getMethod() === 'post' && !$this->validate([
            'csrf_token' => 'required|csrf_token'
        ])) {
            return redirect()->back()->with('error', 'Invalid CSRF token!');
        }

        // Set CSRF header
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        // Initialize model and get the data to be updated
        $model = new KontrakModel();

        $builder = $this->db->table('kontrak');
        $query = $builder->select('id, tanggal, jenis_penomoran, nomor_urut, nomor_sisip')
            ->where('id', $id)
            ->orderBy('nomor_urut', 'DESC')
            ->orderBy('nomor_sisip', 'DESC')
            ->limit(1)
            ->get();

        $result = $query->getRow();
        if (!$result) {
            return redirect()->to(base_url('kontrak/manage'))->with('error', 'Contract not found.');
        }

        // Prepare the contract number based on the type of numbering (urut or sisip)
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

        // Perform the update
        $updateSuccessful = $model->update($id, [
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'ket' => $this->request->getPost('ket'),
            'uraian' => $this->request->getPost('uraian'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
        ]);

        // Check if update was successful and pass the appropriate message
        if ($updateSuccessful) {
            return redirect()->to(base_url('kontrak/manage'))->with('success', 'Contract updated successfully!');
        } else {
            return redirect()->to(base_url('kontrak/manage'))->with('error', 'Failed to update contract.');
        }
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
