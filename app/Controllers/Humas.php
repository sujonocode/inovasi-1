<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\JadwalKontenModel;
use App\Models\KontakModel;
use DateTime;
use DateTimeZone;

class Humas extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(string $page = 'Reminder | Konten Humas')
    {
        $model = new JadwalKontenModel();

        $data['title'] = ucfirst($page);
        $data['jadwalKontens'] = $model->findAll();

        return view('templates/header', $data)
            . view('humas/index', $data)
            . view('templates/footer');
    }

    public function manage(string $page = 'Konten Humas | Manage')
    {
        $model = new JadwalKontenModel();

        $data['title'] = ucfirst($page);
        $data['jadwalKontens'] = $model->findAll();

        $contactModel = new KontakModel();
        $contactList = $contactModel->findAll();

        $contacts = [];
        foreach ($contactList as $contact) {
            $contacts[(string) $contact['nomor']] = $contact['nama'];
        }

        $data['contacts'] = $contacts;

        return view('templates/header', $data)
            . view('humas/manage', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'Humas | Create')
    {
        $data['title'] = ucfirst($page);

        $kontakModel = new KontakModel();

        $data['contacts'] = $kontakModel->getContacts();

        return view('templates/header', $data)
            . view('humas/create', $data)
            . view('templates/footer');
    }

    public function store()
    {
        $model = new JadwalKontenModel();

        $username = session()->get('username');

        $pengingat = $this->request->getPost('pengingat[]');

        if (!$pengingat) {
            $pengingat = [];
        }

        $pengingatJson = json_encode($pengingat);

        $kontak = $this->request->getPost('kontak[]');
        $kontakString = implode(',', $kontak);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            // 'kategori' => $this->request->getPost('kategori'),
            'kontak' => $kontakString,
            'pengingat' => $pengingatJson,
            'catatan' => $this->request->getPost('catatan'),
            'created_by' => $username,
        ];

        if ($model->save($data)) {
            // Send to Fonnte
            $this->sendNotification();
            return redirect()->to(base_url('/humas/manage'))->with('success', 'Reminder berhasil dibuat');
        }

        // Handle failure case
        return redirect()->back()->withInput()->with('error', 'Gagal membuat pengingat');
    }

    // Convert Unix timestamp to human-readable date (GMT +7)
    function unixToHuman($unixTimestamp)
    {
        $timezone = new DateTimeZone('Asia/Jakarta'); // GMT+7
        $date = new DateTime('@' . $unixTimestamp); // Create DateTime from timestamp
        $date->setTimezone($timezone); // Set to GMT+7 timezone
        return $date->format('Y-m-d H:i:s'); // Format the date as needed
    }

    // Convert human-readable date to Unix timestamp (GMT +7)
    function humanToUnix($humanDate)
    {
        $timezone = new DateTimeZone('Asia/Jakarta'); // GMT+7
        $date = new DateTime($humanDate, $timezone); // Create DateTime from human date
        return $date->getTimestamp(); // Get Unix timestamp
    }

    private function sendNotification()
    {
        // Retrieve the "Pengingat" checkboxes as an array
        $pengingat = $this->request->getPost('pengingat[]');

        // If no "Pengingat" is selected, set it as an empty array
        if (!$pengingat) {
            $pengingat = [];
        }

        // Convert the array to a JSON string for storage
        $pengingatJson = json_encode($pengingat);

        // Validate and save the data
        $data = [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            // 'kategori' => $this->request->getPost('kategori'),
            'kontak' => $this->request->getPost('kontak'),
            'pengingat' => $pengingatJson,
            'catatan' => $this->request->getPost('catatan'),
        ];

        $dateHuman = $data['tanggal'] . ' ' . $data['waktu'];
        $dateUnix = $this->humanToUnix($dateHuman);

        // Fonnte starts
        // $curl = curl_init();

        // curl_setopt_array($curl, [
        //     CURLOPT_URL => 'https://api.fonnte.com/send',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => [
        //         'target' => '082228769126',
        //         'message' =>
        //         'A new schedule has been added!' . '
        //             ' . 'Nama   : ' . $data['title'] . '
        //             ' . 'Tanggal: ' . $dateHuman . '
        //             ' . 'Tanggal: ' . $dateUnix . '
        //             ' . 'Ket    : ' . $data['description'],
        //         'schedule' => $dateUnix,
        //         'countryCode' => '62',
        //     ],
        //     CURLOPT_HTTPHEADER => [
        //         'Authorization: CczZN35pLJ6yvpDA9GFH',
        //     ],
        // ]);

        // $response = curl_exec($curl);
        // $error = curl_error($curl);

        // curl_close($curl);
        // Fonnte ends

        // Log response or handle errors
        // if ($response === false) {
        //     log_message('error', "Notification failed: $error");
        // } else {
        //     log_message('info', "Notification sent: $response");
        // }
    }

    public function edit($id, string $page = 'Konten Humas | Edit')
    {
        $kontakModel = new KontakModel();

        $data['contacts'] = $kontakModel->getContacts();

        $model = new JadwalKontenModel();

        $jadwalKonten = $model->find($id);
        $data = ['jadwalKonten' => $jadwalKonten];
        $data['title'] = ucfirst($page);

        if (!$jadwalKonten) {
            session()->setFlashdata('error', 'Data reminder tidak ditemukan.');
            return redirect()->to(base_url('humas/manage'));
        }

        // Get the current logged-in user's username
        $currentUsername = session()->get('username');

        if (session()->get('role') === 'admin') {
            // Add title to the data array
            $data['title'] = ucfirst($page);

            // Return the view with all the data
            return view('templates/header', $data)
                . view('humas/edit', $data)
                . view('templates/footer');
        } else {
            if ($jadwalKonten['created_by'] !== $currentUsername) {
                return redirect()->back()->with('limited', 'Reminder hanya bisa diubah oleh orang yang membuatnya.');
            }
        }

        // Add title to the data array
        $data['title'] = ucfirst($page);

        // Return the view with all the data
        return view('templates/header', $data)
            . view('humas/edit', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        $model = new JadwalKontenModel();

        // Retrieve the "Pengingat" checkboxes as an array
        $pengingat = $this->request->getPost('pengingat[]');

        // If no "Pengingat" is selected, set it as an empty array
        if (!$pengingat) {
            $pengingat = [];
        }

        // Convert the array to a JSON string for storage
        $pengingatJson = json_encode($pengingat);

        $updateSuccessful = $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            // 'kategori' => $this->request->getPost('kategori'),
            'kontak' => $this->request->getPost('kontak'),
            'pengingat' => $pengingatJson,
            'catatan' => $this->request->getPost('catatan'),
        ]);

        if ($updateSuccessful) {
            return redirect()->to(base_url('humas/manage'))->with('success', 'Data reminder berhasil diupdate');
        } else {
            return redirect()->to(base_url('humaskeluar/manage'))->with('error', 'Gagal mengupdate data reminder');
        }
    }

    public function delete($id)
    {
        $model = new JadwalKontenModel();

        // Fetch the schedule data by ID
        $jadwalKonten = $model->find($id);

        // If the record doesn't exist, redirect with an error message
        if (!$jadwalKonten) {
            return redirect()->to(base_url('humas/manage'))->with('error', 'Jadwal tidak ditemukan');
        }

        if (session()->get('role') === 'admin') {
            // Call the delete logic directly here
            $model->delete($id);

            return redirect()->to(base_url('humas/manage'))->with('success', 'Data reminder berhasil dihapus');
        } else {
            if (session()->get('username') !== $jadwalKonten['created_by']) {
                return redirect()->back()->with('limited', 'Data reminder hanya bisa dihapus oleh orang yang membuatnya atau admin');
            }
        }

        // Call the delete logic directly here
        $model->delete($id);

        return redirect()->to(base_url('humas/manage'))->with('success', 'Data reminder berhasil dihapus');
    }

    public function exportExcel()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM jadwal_konten");
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
        header('Content-Disposition: attachment;filename="jadwal_konten.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function getEvents()
    {
        $model = new JadwalKontenModel();

        $jadwalKontens = $model->findAll();

        return view('templates/header')
            . view('humas/index', ['jadwalKontens' => $jadwalKontens])
            . view('templates/footer');
    }

    public function maintenance(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }
}
