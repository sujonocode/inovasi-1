<?php

namespace App\Controllers;

use App\Models\SKModel;
use App\Models\KodeArsipModel;

class SK extends BaseController
{
    protected $db;

    public function __construct()
    {
        // Load the database connection
        $this->db = \Config\Database::connect();
    }

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

    public function create(string $page = 'SK | Tambah')
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
            . view('sk/create', $data)
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

        $model = new SKModel();

        $username = session()->get('username');

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
            $builder = $this->db->table('sk');
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
            'jenis_penomoran' => $this->request->getPost('jenis_penomoran'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
            'nomor_urut' => $nomor_urut,
            'nomor_sisip' => $nomor_sisip,
            'created_by' => $username,
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('sk/manage'))->with('success', 'Data SK berhasil disimpan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data SK');
    }

    public function edit($id, string $page = 'SK | Edit')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new SKModel();

        // Fetch the sk data by id
        $sk = $model->find($id);
        $data = ['sk' => $sk];

        // If sk data is not found, show error and redirect
        if (!$sk) {
            session()->setFlashdata('error', 'Data sk tidak ditemukan.');
            return redirect()->to(base_url('/sk/manage'));
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
            . view('sk/edit', $data)
            . view('templates/footer');
    }

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

        $model = new SKModel();

        $builder = $this->db->table('sk');
        $query = $builder->select('id, tanggal, jenis_penomoran, nomor_urut, nomor_sisip')
            ->where('id', $id)
            ->orderBy('nomor_urut', 'DESC')
            ->orderBy('nomor_sisip', 'DESC')
            ->limit(1)
            ->get();

        $result = $query->getRow();
        if (!$result) {
            return redirect()->to(base_url('sk/manage'))->with('error', 'SK not found.');
        }

        $tanggal = $result->tanggal;
        list($year, $month, $day) = explode('-', $tanggal);

        $nomor = '';
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
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
        ]);

        // Check if update was successful and pass the appropriate message
        if ($updateSuccessful) {
            return redirect()->to(base_url('sk/manage'))->with('success', 'SK updated successfully!');
        } else {
            return redirect()->to(base_url('sk/manage'))->with('error', 'Failed to update SK.');
        }
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
