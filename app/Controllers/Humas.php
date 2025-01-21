<?php

namespace App\Controllers;

use App\Models\JadwalKontenModel;
use DateTime;
use DateTimeZone;

class Humas extends BaseController
{
    public function index(string $page = 'Humas | Reminder Konten')
    {
        $model = new JadwalKontenModel();

        $data['title'] = ucfirst($page);
        $data['jadwalKontens'] = $model->findAll();

        return view('templates/header', $data)
            . view('humas/index', $data)
            . view('templates/footer');
    }

    public function manage(string $page = 'Humas | Manage')
    {
        $model = new JadwalKontenModel();

        $data['title'] = ucfirst($page);
        $data['jadwalKontens'] = $model->findAll();

        return view('templates/header', $data)
            . view('humas/manage', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'Humas | Create')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('humas/create', $data)
            . view('templates/footer');
    }

    public function store()
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

        // Prepare the data to be saved
        $data = [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'kategori' => $this->request->getPost('kategori'),
            'kontak' => $this->request->getPost('kontak'),
            'pengingat' => $pengingatJson,  // Store as a JSON string
            'catatan' => $this->request->getPost('catatan'),
        ];

        if ($model->save($data)) {
            // Schedule added successfully. Now send the notification.
            $this->sendNotification();

            // Redirect with success message
            return redirect()->to(base_url('/humas/manage'))->with('success', 'Schedule created and notification sent.');
        }

        // Handle failure case
        return redirect()->back()->withInput()->with('error', 'Failed to create the schedule.');
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
            'kategori' => $this->request->getPost('kategori'),
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

    public function edit($id)
    {
        $model = new JadwalKontenModel();

        $data['jadwalKonten'] = $model->find($id);
        $data['title'] = ucfirst('Humas | Edit');

        // If the record doesn't exist, show an error message on the edit page
        if (!$data['jadwalKonten']) {
            // Pass an error message directly to the edit view
            return view('templates/header')
                . view('humas/edit', ['error' => 'Schedule not found.'])
                . view('templates/footer');
        }

        // If the record exists, load the edit form
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

        $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'kategori' => $this->request->getPost('kategori'),
            'kontak' => $this->request->getPost('kontak'),
            'pengingat' => $pengingatJson,
            'catatan' => $this->request->getPost('catatan'),
        ]);

        return redirect()->to(base_url('humas/manage'));
    }

    public function delete($id)
    {
        $model = new JadwalKontenModel();

        // Fetch the schedule data by ID
        $jadwalKonten = $model->find($id);

        // If the record doesn't exist, redirect with an error message
        if (!$jadwalKonten) {
            return redirect()->to(base_url('humas/manage'))->with('error', 'Schedule not found.');
        }

        // Proceed with deletion
        $model->delete($id);

        // Redirect with a success message after deletion
        return redirect()->to(base_url('humas/manage'))->with('success', 'Schedule deleted successfully.');
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
