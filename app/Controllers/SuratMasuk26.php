<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\SuratMasuk26Model;

class SuratMasuk26 extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(string $page = 'Manajemen Dokumen | Surat Masuk')
    {
        $model = new SuratMasuk26Model();

        $data['title'] = ucfirst($page);
        $data['surats'] = $model->findAll();

        return view('templates/header', $data)
            . view('surat_masuk26/index', $data)
            . view('templates/footer');
    }

    public function manage(string $page = 'Surat Masuk | Manage')
    {
        $model = new SuratMasuk26Model();

        $data['title'] = ucfirst($page);
        $data['surats'] = $model->findAll();

        return view('templates/header', $data)
            . view('surat_masuk26/manage', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'Surat Masuk | Create')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        // Set up the data array
        $data = [
            'title' => ucfirst($page),
        ];

        return view('templates/header', $data)
            . view('surat_masuk26/create', $data)
            . view('templates/footer');
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

        $model = new SuratMasuk26Model();

        $username = session()->get('username');

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nomor' => $this->request->getPost('nomor'),
            'asal' => $this->request->getPost('asal'),
            'perihal' => $this->request->getPost('perihal'),
            'kategori' => $this->request->getPost('kategori'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'created_by' => $username,
        ];

        $nomor = $this->request->getPost('nomor');

        if ($model->save($data)) {
            return redirect()->to(base_url('surat_masuk26/manage'))->with('success', 'Data surat berhasil disimpan.' . '<br>' . 'Nomor surat: ' . $nomor);
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data surat');
    }

    public function edit($id, string $page = 'Surat Masuk | Edit')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new SuratMasuk26Model();

        // Fetch the kontrak data by id
        $surat = $model->find($id);
        $data = ['surat' => $surat];
        $data['title'] = ucfirst($page);

        // If kontrak data is not found, show error and redirect
        if (!$surat) {
            session()->setFlashdata('error', 'Data surat tidak ditemukan.');
            return redirect()->to(base_url('surat_masuk26/manage'));
        }

        // Get the current logged-in user's username
        $currentUsername = session()->get('username');

        if (session()->get('role') === 'admin') {
            // Return the view with all the data
            return view('templates/header', $data)
                . view('surat_masuk26/edit', $data)
                . view('templates/footer');
        } else {
            if ($surat['created_by'] !== $currentUsername) {
                return redirect()->back()->with('limited', 'Surat hanya bisa diubah oleh orang yang membuatnya.');
            }
        }

        // Return the view with all the data
        return view('templates/header', $data)
            . view('surat_masuk26/edit', $data)
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

        $model = new SuratMasuk26Model();

        $builder = $this->db->table('surat_masuk_26');
        $query = $builder->select('id, tanggal')
            ->where('id', $id)
            ->orderBy('tanggal', 'DESC')
            ->limit(1)
            ->get();

        $result = $query->getRow();

        if (!$result) {
            return redirect()->to(base_url('surat_masuk26/manage'))->with('error', 'Surat tidak ditemukan');
        }

        $updateSuccessful = $model->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'nomor' => $this->request->getPost('nomor'),
            'asal' => $this->request->getPost('asal'),
            'perihal' => $this->request->getPost('perihal'),
            'kategori' => $this->request->getPost('kategori'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
        ]);

        $nomor = $this->request->getPost('nomor');

        // Check if update was successful and pass the appropriate message
        if ($updateSuccessful) {
            return redirect()->to(base_url('surat_masuk26/manage'))->with('success', 'Data surat berhasil diupdate.' . '<br>' . 'Nomor surat: ' . $nomor);
        } else {
            return redirect()->to(base_url('surat_masuk26/manage'))->with('error', 'Gagal mengupdate data surat');
        }
    }

    public function delete($id)
    {
        $model = new SuratMasuk26Model();

        $surat = $model->find($id);

        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat dengan nomor tersebut tidak ditemukan');
        }

        if (session()->get('role') === 'admin') {

            $nomor = $surat['nomor'];

            // Call the delete logic directly here
            $model->delete($id);

            return redirect()->to(base_url('surat_masuk26/manage'))->with('success', 'Data surat berhasil dihapus.' . '<br>' . 'Nomor surat yang terhapus: ' . $nomor);
        } else {
            if (session()->get('username') !== $surat['created_by']) {
                return redirect()->back()->with('limited', 'Data surat hanya bisa dihapus oleh orang yang membuatnya atau admin');
            }
        }

        $nomor = $surat['nomor'];

        // Call the delete logic directly here
        $model->delete($id);

        return redirect()->to(base_url('surat_masuk26/manage'))->with('success', 'Data surat berhasil dihapus.' . '<br>' . 'Nomor surat yang terhapus: ' . $nomor);
    }

    public function exportExcel()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM surat_masuk_26");
        $data = $query->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add column headers
        $columns = array_keys($data[0]); // Get column names from the first row
        $colIndex = 'A';
        foreach ($columns as $column) {
            $sheet->setCellValue($colIndex . '1', $column);
            $colIndex++;
        }

        // Add rows
        $rowNumber = 2;
        foreach ($data as $row) {
            $colIndex = 'A';
            foreach ($row as $cell) {
                $sheet->setCellValue($colIndex . $rowNumber, $cell);
                $colIndex++;
            }
            $rowNumber++;
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="surat_masuk.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function getSurats()
    {
        $model = new SuratMasuk26Model();
        $surats = $model->findAll();

        return view('templates/header')
            . view('surat_masuk26/index', ['surats' => $surats])
            . view('templates/footer');
    }

    public function maintenance(string $page = 'Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }
}
