<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\LantasModel;
use App\Models\KodeArsipLantasModel;

class Lantas extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(string $page = 'Lantas | kendala')
    {
        $model = new LantasModel();

        $data['title'] = ucfirst($page);
        $data['sks'] = $model->findAll();

        return view('templates/header', $data)
            . view('lantas/index', $data)
            . view('templates/footer');
    }

    public function manage(string $page = 'Kendala | Manage')
    {
        $model = new LantasModel();

        $data['title'] = ucfirst($page);
        $data['sks'] = $model->findAll();

        return view('templates/header', $data)
            . view('lantas/manage', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'Kendala | Tambah')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        // Set up the data array
        $data = [
            'title' => ucfirst($page),
        ];

        // Fetch distinct 'jenis' options from the 'kode_arsip' table
        $db = \Config\Database::connect();
        $data['kodeKlasifikasiOptions'] = $db->table('kode_arsip_sk')
            ->select('kode_klasifikasi')
            ->distinct()
            ->get()
            ->getResultArray();

        return view('templates/header', $data)
            . view('lantas/create', $data)
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

        $model = new LantasModel();

        $username = session()->get('username');

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'jenis_penomoran' => $this->request->getPost('jenis_penomoran'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('lantas/manage'))->with('success', 'Data kendala berhasil disimpan.' . '<br>' . 'Nomor kendala: ');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data kendala');
    }

    public function edit($id, string $page = 'Kendala | Edit')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new LantasModel();

        // Fetch the sk data by id
        $sk = $model->find($id);
        $data = ['sk' => $sk];
        $data['title'] = ucfirst($page);

        // If sk data is not found, show error and redirect
        if (!$sk) {
            session()->setFlashdata('error', 'Data sk tidak ditemukan.');
            return redirect()->to(base_url('/lantas/manage'));
        }

        // Get the current logged-in user's username
        $currentUsername = session()->get('username');

        if (session()->get('role') === 'admin') {
            // Fetch distinct 'jenis' options from the 'kode_arsip' table
            $db = \Config\Database::connect();
            $data['kodeKlasifikasiOptions'] = $db->table('kode_arsip_sk')
                ->select('kode_klasifikasi')
                ->distinct()
                ->get()
                ->getResultArray();

            // Return the view with all the data
            return view('templates/header', $data)
                . view('lantas/edit', $data)
                . view('templates/footer');
        } else {
            if ($sk['created_by'] !== $currentUsername) {
                return redirect()->back()->with('limited', 'Kendala hanya bisa diubah oleh orang yang membuatnya.');
            }
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
        return view('templates/header', $data)
            . view('lantas/edit', $data)
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

        $model = new LantasModel();

        $builder = $this->db->table('sk');
        $query = $builder->select('id, tanggal, jenis_penomoran, nomor_urut, nomor_sisip')
            ->where('id', $id)
            ->orderBy('nomor_urut', 'DESC')
            ->orderBy('nomor_sisip', 'DESC')
            ->limit(1)
            ->get();

        $result = $query->getRow();
        if (!$result) {
            return redirect()->to(base_url('lantas/manage'))->with('error', 'Kendala tidak ditemukan');
        }

        $updateSuccessful = $model->update($id, [
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'perihal' => $this->request->getPost('perihal'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
        ]);

        // Check if update was successful and pass the appropriate message
        if ($updateSuccessful) {
            return redirect()->to(base_url('lantas/manage'))->with('success', 'Data kendala berhasil diupdate.' . '<br>' . 'Nomor kendala: ');
        } else {
            return redirect()->to(base_url('lantas/manage'))->with('error', 'Gagal mengupdate data kendala');
        }
    }

    public function delete($id)
    {
        $model = new LantasModel();

        $sk = $model->find($id);

        if (!$sk) {
            return redirect()->back()->with('error', ' Data kendala dengan nomor tersebut tidak ditemukan');
        }

        if (session()->get('role') === 'admin') {
            $nomor = $sk['nomor'];

            // Call the delete logic directly here
            $model->delete($id);

            return redirect()->to(base_url('lantas/manage'))->with('success', 'Data kendala berhasil dihapus.' . '<br>' . 'Nomor kendala yang terhapus: ' . $nomor);
        } else {
            if (session()->get('username') !== $sk['created_by']) {
                return redirect()->back()->with('limited', 'Data kendala hanya bisa dihapus oleh orang yang membuatnya atau admin');
            }
        }

        $nomor = $sk['nomor'];

        // Call the delete logic directly here
        $model->delete($id);

        return redirect()->to(base_url('lantas/manage'))->with('success', 'Data kendala berhasil dihapus.' . '<br>' . 'Nomor kendala yang terhapus: ' . $nomor);
    }

    public function exportExcel()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM sk");
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
        header('Content-Disposition: attachment;filename="surat_keputusan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function getLantases()
    {
        $model = new LantasModel();
        $sks = $model->findAll();

        return view('templates/header')
            . view('lantas/index', ['sks' => $sks])
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
