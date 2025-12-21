<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\FP26Model;
use App\Models\KodeArsipFPModel;

class FP26 extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(string $page = 'Manajemen Dokumen | FP')
    {
        $model = new FP26Model();

        $data['title'] = ucfirst($page);
        $data['fps'] = $model->findAll();

        return view('templates/header', $data)
            . view('fp26/index', $data)
            . view('templates/footer');
    }

    public function manage(string $page = 'FP | Manage')
    {
        $model = new FP26Model();

        $data['title'] = ucfirst($page);
        $data['fps'] = $model->findAll();

        return view('templates/header', $data)
            . view('fp26/manage', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'FP | Tambah')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        // Set up the data array
        $data = [
            'title' => ucfirst($page),
        ];

        // Fetch distinct 'jenis' options from the 'kode_arsip' table
        $db = \Config\Database::connect();
        $data['kodeKlasifikasiOptions'] = $db->table('kode_arsip_fp')
            ->select('kode_klasifikasi')
            ->distinct()
            ->get()
            ->getResultArray();

        return view('templates/header', $data)
            . view('fp26/create', $data)
            . view('templates/footer');
    }

    public function getKodeArsip()
    {
        // Get the selected 'kode_klasifikasi' from the request
        $kodeKlasifikasi = $this->request->getPost('kode_klasifikasi');

        // Assuming you have a model for the table, e.g., KodeArsipModel
        $kodeArsipFPModel = new KodeArsipFPModel();

        // Retrieve the 'kode_arsip' based on the selected 'kode_klasifikasi'
        $result = $kodeArsipFPModel->where('kode_klasifikasi', $kodeKlasifikasi)->first();
        $this->response->setHeader('X-CSRF-Token', csrf_hash());
        // Return the result as JSON
        if ($result) {
            return $this->response->setJSON(['kode' => $result['kode']]);
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

        $model = new FP26Model();

        $username = session()->get('username');

        $tanggal = $this->request->getPost('tanggal');
        list($year, $month, $day) = explode('-', $tanggal);

        if ($this->request->getPost('jenis_penomoran') == 'urut') {
            $nomor_urut_akhir = $model->selectMax('nomor_urut')->get()->getRowArray()['nomor_urut'];
            $nomor_urut = $nomor_urut_akhir + 1;
            $nomor_urut_text = $this->numberToText3($nomor_urut);
            $nomor_sisip = 0;

            if ($this->request->getPost('kode_arsip') == "") {
                $nomor = 'B-' . $nomor_urut_text . '/' . $year;
            } else {
                $nomor = 'B-' . $nomor_urut_text . '/' . $this->request->getPost('kode_arsip') . '/' . $year;
            }
        } elseif ($this->request->getPost('jenis_penomoran') == 'sisip') {
            $tanggal = $this->request->getPost('tanggal');

            $builder = $this->db->table('fp_26');

            $query = $builder->select('id, nomor_urut, nomor_sisip')
                ->where('tanggal', $tanggal)
                ->orderBy('nomor_urut', 'DESC')
                ->orderBy('nomor_sisip', 'DESC')
                ->limit(1)
                ->get();

            $result = $query->getRow();

            if ($result) {
                $nomor_urut = $result->nomor_urut;

                $query2 = $builder->select('id, nomor_urut, nomor_sisip')
                    ->where('nomor_urut', $nomor_urut)
                    ->orderBy('nomor_sisip', 'DESC')
                    ->limit(1)
                    ->get();

                $result2 = $query2->getRow();
            }

            if (!$result) {
                $builder = $this->db->table('fp_26');
                $query = $builder
                    ->select('id, nomor_urut, nomor_sisip')
                    ->where('tanggal <', $tanggal)
                    ->orderBy('tanggal', 'DESC')
                    ->orderBy('nomor_urut', 'DESC')
                    ->orderBy('nomor_sisip', 'DESC')
                    ->limit(1)
                    ->get();

                $result = $query->getRow();

                if ($result) {
                    $nomor_urut = $result->nomor_urut;

                    $query2 = $builder->select('id, nomor_urut, nomor_sisip')
                        ->where('nomor_urut', $nomor_urut)
                        ->orderBy('nomor_sisip', 'DESC')
                        ->limit(1)
                        ->get();

                    $result2 = $query2->getRow();
                }
            }

            $nomor_urut = $result2->nomor_urut;
            $nomor_sisip = $result2->nomor_sisip + 1;

            $nomor_urut_text = $this->numberToText3($nomor_urut);
            $nomor_sisip_text = $this->numberToText2($nomor_sisip);

            if ($this->request->getPost('kode_arsip') == "") {
                $nomor = 'B-' . $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $year;
            } else {
                $nomor = 'B-' . $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $this->request->getPost('kode_arsip') . '/' . $year;
            }
        }

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'jenis_penomoran' => $this->request->getPost('jenis_penomoran'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'catatan' => $this->request->getPost('catatan'),
            // 'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
            'nomor_urut' => $nomor_urut,
            'nomor_sisip' => $nomor_sisip,
            'created_by' => $username,
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('fp26/manage'))->with('success', 'Data FP berhasil disimpan.' . '<br>' . 'Nomor FP: ' . $nomor);
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data FP');
    }

    public function edit($id, string $page = 'FP | Edit')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new FP26Model();

        // Fetch the fp data by id
        $fp = $model->find($id);
        $data = ['fp' => $fp];
        $data['title'] = ucfirst($page);

        // If fp data is not found, show error and redirect
        if (!$fp) {
            session()->setFlashdata('error', 'Data fp tidak ditemukan.');
            return redirect()->to(base_url('/fp26/manage'));
        }

        // Get the current logged-in user's username
        $currentUsername = session()->get('username');

        if (session()->get('role') === 'admin') {
            // Fetch distinct 'jenis' options from the 'kode_arsip' table
            $db = \Config\Database::connect();
            $data['kodeKlasifikasiOptions'] = $db->table('kode_arsip_fp')
                ->select('kode_klasifikasi')
                ->distinct()
                ->get()
                ->getResultArray();

            // Return the view with all the data
            return view('templates/header', $data)
                . view('fp26/edit', $data)
                . view('templates/footer');
        } else {
            if ($fp['created_by'] !== $currentUsername) {
                return redirect()->back()->with('limited', 'FP hanya bisa diubah oleh orang yang membuatnya.');
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
            . view('fp26/edit', $data)
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

        $model = new FP26Model();

        $builder = $this->db->table('fp_26');
        $query = $builder->select('id, tanggal, jenis_penomoran, nomor_urut, nomor_sisip')
            ->where('id', $id)
            ->orderBy('nomor_urut', 'DESC')
            ->orderBy('nomor_sisip', 'DESC')
            ->limit(1)
            ->get();

        $result = $query->getRow();
        if (!$result) {
            return redirect()->to(base_url('fp26/manage'))->with('error', 'FP tidak ditemukan');
        }

        $tanggal = $result->tanggal;
        list($year, $month, $day) = explode('-', $tanggal);

        $nomor = '';
        if ($result->jenis_penomoran == 'urut') {
            $nomor_urut_text = $this->numberToText3($result->nomor_urut);

            if ($this->request->getPost('kode_arsip') == "") {
                $nomor = 'B-' . $nomor_urut_text . '/' . $year;
            } else {
                $nomor = 'B-' . $nomor_urut_text . '/' . $this->request->getPost('kode_arsip') . '/' . $year;
            }
        } elseif ($result->jenis_penomoran == 'sisip') {
            $nomor_urut_text = $this->numberToText3($result->nomor_urut);
            $nomor_sisip_text = $this->numberToText2($result->nomor_sisip);
            if ($this->request->getPost('kode_arsip') == "") {
                $nomor = 'B-' . $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $year;
            } else {
                $nomor = 'B-' . $nomor_urut_text . '.' . $nomor_sisip_text . '/' . $this->request->getPost('kode_arsip') . '/' . $year;
            }
        }

        $updateSuccessful = $model->update($id, [
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'catatan' => $this->request->getPost('catatan'),
            // 'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
        ]);

        // Check if update was successful and pass the appropriate message
        if ($updateSuccessful) {
            return redirect()->to(base_url('fp26/manage'))->with('success', 'Data FP berhasil diupdate.' . '<br>' . 'Nomor FP: ' . $nomor);
        } else {
            return redirect()->to(base_url('fp26/manage'))->with('error', 'Gagal mengupdate data FP');
        }
    }

    public function delete($id)
    {
        $model = new FP26Model();

        $fp = $model->find($id);

        if (!$fp) {
            return redirect()->back()->with('error', 'Data surat dengan nomor tersebut tidak ditemukan');
        }

        if (session()->get('role') === 'admin') {

            $nomor = $fp['nomor'];

            // Call the delete logic directly here
            $model->delete($id);

            return redirect()->to(base_url('fp26/manage'))->with('success', 'Data FP berhasil dihapus.' . '<br>' . 'Nomor FP yang terhapus: ' . $nomor);
        } else {
            if (session()->get('username') !== $fp['created_by']) {
                return redirect()->back()->with('limited', 'Data FP hanya bisa dihapus oleh orang yang membuatnya atau admin');
            }
        }

        $nomor = $fp['nomor'];

        // Call the delete logic directly here
        $model->delete($id);

        return redirect()->to(base_url('fp26/manage'))->with('success', 'Data FP berhasil dihapus.' . '<br>' . 'Nomor FP yang terhapus: ' . $nomor);
    }

    public function exportExcel()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM fp_26");
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

    public function getFPs()
    {
        $model = new FP26Model();
        $fps = $model->findAll();

        return view('templates/header')
            . view('fp26/index', ['fps' => $fps])
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
