<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\SuratKeluarModel;
use App\Models\KodeArsipModel;

class SuratKeluar extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(string $page = 'Manajemen Dokumen | Surat Keluar')
    {
        $model = new SuratKeluarModel();

        $data['title'] = ucfirst($page);
        $data['surats'] = $model->findAll();

        return view('templates/header', $data)
            . view('surat_keluar/index', $data)
            . view('templates/footer');
    }

    public function manage(string $page = 'Surat Keluar | Manage')
    {
        $model = new SuratKeluarModel();

        $data['title'] = ucfirst($page);
        $data['surats'] = $model->findAll();

        return view('templates/header', $data)
            . view('surat_keluar/manage', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'Surat Keluar | Create')
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

        return view('templates/header', $data)
            . view('surat_keluar/create', $data)
            . view('templates/footer');
    }

    public function getKode1()
    {
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
            log_message('debug', 'New CSRF Token (getKodeKlasifikasi): ' . csrf_hash());

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

        $model = new SuratKeluarModel();

        $username = session()->get('username');

        $tanggal = $this->request->getPost('tanggal');
        list($year, $month, $day) = explode('-', $tanggal);

        if ($this->request->getPost('jenis_penomoran') == 'urut') {
            $nomor_urut_akhir = $model->selectMax('nomor_urut')->get()->getRowArray()['nomor_urut'];
            $nomor_urut = $nomor_urut_akhir + 1;
            $nomor_urut_text = $this->numberToText3($nomor_urut);
            $nomor_sisip = 0;

            if ($this->request->getPost('kode_arsip') == "") {
                $nomor = 'B-' . $nomor_urut_text . '/' . '18020' . '/' . $year;
            } else {
                $nomor = 'B-' . $nomor_urut_text . '/' . '18020' . '/' . $this->request->getPost('kode_arsip') . '/' . $year;
            }
        } elseif ($this->request->getPost('jenis_penomoran') == 'sisip') {
            $tanggal = $this->request->getPost('tanggal');

            $builder = $this->db->table('surat_keluar');

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
                $builder = $this->db->table('surat_keluar');
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
                $nomor = 'B-' . $nomor_urut_text . '.' . $nomor_sisip_text . '/' . '18020' . '/' . $year;
            } else {
                $nomor = 'B-' . $nomor_urut_text . '.' . $nomor_sisip_text . '/' . '18020' . '/' . $this->request->getPost('kode_arsip') . '/' . $year;
            }
        }

        $data = [
            'jenis_penomoran' => $this->request->getPost('jenis_penomoran'),
            'tanggal' => $this->request->getPost('tanggal'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'kategori' => $this->request->getPost('kategori'),
            'catatan' => $this->request->getPost('catatan'),
            // 'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
            'nomor_urut' => $nomor_urut,
            'nomor_sisip' => $nomor_sisip,
            'created_by' => $username,
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('surat_keluar/manage'))->with('success', 'Data surat berhasil disimpan' . PHP_EOL . 'Nomor surat: ' . $nomor);
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data surat');
    }

    public function edit($id, string $page = 'Surat Keluar | Edit')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new SuratKeluarModel();

        $surat = $model->find($id);
        $data = ['surat' => $surat];
        $data['title'] = ucfirst($page);

        if (!$surat) {
            session()->setFlashdata('error', 'Data surat tidak ditemukan.');
            return redirect()->to(base_url('surat_keluar/manage'));
        }

        // Get the current logged-in user's username
        $currentUsername = session()->get('username');

        if (session()->get('role') === 'admin') {
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
                . view('surat_keluar/edit', $data)
                . view('templates/footer');
        } else {
            if ($surat['created_by'] !== $currentUsername) {
                return redirect()->back()->with('limited', 'Surat hanya bisa diubah oleh orang yang membuatnya.');
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
            . view('surat_keluar/edit', $data)
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

        $model = new SuratKeluarModel();

        $builder = $this->db->table('surat_keluar');
        $query = $builder->select('id, tanggal, jenis_penomoran, nomor_urut, nomor_sisip')
            ->where('id', $id)
            ->orderBy('nomor_urut', 'DESC')
            ->orderBy('nomor_sisip', 'DESC')
            ->limit(1)
            ->get();

        $result = $query->getRow();
        if (!$result) {
            return redirect()->to(base_url('surat_keluar/manage'))->with('error', 'Surat tidak ditemukan');
        }

        $tanggal = $result->tanggal;
        list($year, $month, $day) = explode('-', $tanggal);

        $nomor = '';
        if ($result->jenis_penomoran == 'urut') {
            $nomor_urut_text = $this->numberToText3($result->nomor_urut);

            if ($this->request->getPost('kode_arsip') == "") {
                $nomor = 'B-' . $nomor_urut_text . '/' . '18020' . '/' . $year;
            } else {
                $nomor = 'B-' . $nomor_urut_text . '/' . '18020' . '/' . $this->request->getPost('kode_arsip') . '/' . $year;
            }
        } elseif ($result->jenis_penomoran == 'sisip') {
            $nomor_urut_text = $this->numberToText3($result->nomor_urut);
            $nomor_sisip_text = $this->numberToText2($result->nomor_sisip);

            if ($this->request->getPost('kode_arsip') == "") {
                $nomor = 'B-' . $nomor_urut_text . '.' . $nomor_sisip_text . '/' . '18020' . '/' . $year;
            } else {
                $nomor = 'B-' . $nomor_urut_text . '.' . $nomor_sisip_text . '/' . '18020' . '/' . $this->request->getPost('kode_arsip') . '/' . $year;
            }
        }

        $updateSuccessful = $model->update($id, [
            'kode_arsip' => $this->request->getPost('kode_arsip'),
            'alamat' => $this->request->getPost('alamat'),
            'ringkasan' => $this->request->getPost('ringkasan'),
            'catatan' => $this->request->getPost('catatan'),
            'url' => $this->request->getPost('url'),
            'nomor' => $nomor,
        ]);

        // Check if update was successful and pass the appropriate message
        if ($updateSuccessful) {
            return redirect()->to(base_url('surat_keluar/manage'))->with('success', 'Data surat berhasil diupdate' . PHP_EOL . 'Nomor surat: ' . $nomor);
        } else {
            return redirect()->to(base_url('surat_keluar/manage'))->with('error', 'Gagal mengupdate data surat');
        }
    }

    public function delete($id)
    {
        $model = new SuratKeluarModel();

        $surat = $model->find($id);

        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat dengan nomor tersebut tidak ditemukan');
        }

        if (session()->get('role') === 'admin') {

            $nomor = $surat['nomor'];

            // Call the delete logic directly here
            $model->delete($id);

            return redirect()->to(base_url('surat_keluar/manage'))->with('success', 'Data surat berhasil dihapus' . PHP_EOL . 'Nomor surat yang terhapus: ' . $nomor);
        } else {
            if (session()->get('username') !== $surat['created_by']) {
                return redirect()->back()->with('limited', 'Data surat hanya bisa dihapus oleh orang yang membuatnya atau admin');
            }
        }

        $nomor = $surat['nomor'];

        // Call the delete logic directly here
        $model->delete($id);

        return redirect()->to(base_url('surat_keluar/manage'))->with('success', 'Data surat berhasil dihapus' . PHP_EOL . 'Nomor surat yang terhapus: ' . $nomor);
    }

    public function exportExcel()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM surat_keluar");
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
        header('Content-Disposition: attachment;filename="surat_keluar.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function getSurats()
    {
        $model = new SuratKeluarModel();
        $surats = $model->findAll();

        return view('templates/header')
            . view('surat_keluar/index', ['surats' => $surats])
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
