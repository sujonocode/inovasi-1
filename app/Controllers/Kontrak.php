<?php

namespace App\Controllers;

use App\Models\KontrakModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DataException;

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
    function textToNumber($text)
    {
        return (int)$text; // Cast the text to an integer
    }

    // Convert number to text with zero-padding to 3 digits
    function numberToText($number)
    {
        return str_pad($number, 3, '0', STR_PAD_LEFT); // Pad with zeros to 3 characters
    }

    public function store()
    {
        $model = new KontrakModel();

        $nu_akhir = $model->selectMax('nomor_urut')->get()->getRowArray()['nomor_urut'];
        $nomor_urut = $this->numberToText($nu_akhir + 1);
        $tanggal = '2025-01-15';

        try {
            // Query to get the desired value
            $builder = $this->db->table('your_table_name');
            $query = $builder->select('nomor_urut')
                ->where('tanggal', $tanggal)
                ->orderBy('nomor_urut', 'DESC')
                ->orderBy('nomor_sisip', 'DESC')
                ->limit(1)
                ->get();

            $result = $query->getRow(); // Get the first row as an object

            if ($result) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'nomor_urut' => $result->nomor_urut,
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "No data found for the given 'tanggal'.",
                ]);
            }
        } catch (DataException $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'uraian' => $this->request->getPost('uraian'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            // if sisip:
            'nomor' => $nomor_urut . '/' . $this->request->getPost('kode_arsip') . '/' . 'TAHUN 2025',
            'nomor_urut' => $nu_akhir + 1,
            'nomor_sisip' => $ns_akhir + 1,
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
        $model = new KontrakModel();
        $model->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'nomor' => $this->request->getPost('nomor'),
            'uraian' => $this->request->getPost('uraian'),
            'catatan' => $this->request->getPost('catatan'),
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
