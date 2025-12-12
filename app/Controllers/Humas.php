<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\JadwalKontenModel;
use App\Models\KontakModel;
use DateTime;
use DateTimeZone;
use IntlDateFormatter;


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

        $contactModel = new KontakModel();
        $contactList = $contactModel->findAll();

        $contacts = [];
        foreach ($contactList as $contact) {
            $contacts[(string) $contact['nomor']] = $contact['nama'];
        }

        $data['contacts'] = $contacts;

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

        $data['contacts'] = $kontakModel->getContactsHumas();

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
        $pengingat = $this->request->getPost('pengingat[]');

        if (!$pengingat) {
            $pengingat = [];
        }

        $pengingatJson = json_encode($pengingat);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'kontak' => $this->request->getPost('kontak'),
            'pengingat' => $pengingatJson,
            'catatan' => $this->request->getPost('catatan'),
        ];

        $kontakString = implode(',', $data['kontak']);

        $dateHuman = $data['tanggal'] . ' ' . $data['waktu'];
        $hariH0 = $this->humanToUnix($dateHuman);
        $hariHm3 = strtotime('-3 days', $hariH0);
        $hariHm7 = strtotime('-7 days', $hariH0);

        // Set the locale to Indonesian (make sure the extension `intl` is enabled)
        $formatter = new IntlDateFormatter(
            'id_ID',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'Asia/Jakarta',
            IntlDateFormatter::GREGORIAN,
            'EEEE, dd MMMM yyyy' // Format: Senin, 10 Februari 2025
        );

        // Format the date
        $dayIndo = $formatter->format(new DateTime($data['tanggal']));

        // Convert time to 12-hour format with pagi/siang/sore/malam
        $time = date('H:i', strtotime($data['waktu']));
        $hour = (int) date('H', strtotime($data['waktu']));

        if ($hour < 10) {
            $period = 'pagi';   // 00:00 - 09:59
        } elseif ($hour < 15) {
            $period = 'siang';  // 12:00 - 14:59
        } elseif ($hour < 18) {
            $period = 'sore';   // 15:00 - 17:59
        } else {
            $period = 'malam';  // 18:00 - 23:59
        }

        if ($pengingatJson == '["Hari H"]') {
            // echo "<script>console.log(" . json_encode($data['kontak']) . ");</script>";
            // die();  // Stop execution
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariH0,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
        } else if ($pengingatJson == '["H-3"]') {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariHm3,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
        } else if ($pengingatJson == '["H-7"]') {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariHm7,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
        } else if ($pengingatJson == '["Hari H","H-3"]') {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariH0,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariHm3,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
        } else if ($pengingatJson == '["Hari H","H-7"]') {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariH0,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariHm7,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
        } else if ($pengingatJson == '["H-3","H-7"]') {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariHm3,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariHm7,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
        } else if ($pengingatJson == '["Hari H","H-3","H-7"]') {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariH0,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariHm3,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'target' => $kontakString,
                    'message' =>
                    "📢 Jangan Lupa!\n" .
                        "```" .
                        "--------------------------\n" .
                        "📌 Kegiatan: {$data['nama']}\n" .
                        "📅 Tanggal : {$dayIndo}\n" .
                        "🕒 Waktu   : {$time} ({$period})\n" .
                        "📝 Catatan : {$data['catatan']}\n" .
                        "--------------------------" .
                        "```",
                    'schedule' => $hariHm7,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => [
                    'Authorization: VT2WkzUQRkBAREK385TA',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
        }

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
        //         'target' => $data['kontak'],
        //         'message' =>
        //         "📢 Jangan Lupa!\n" .
        //             "```" .
        //             "--------------------------\n" .
        //             "📌 Kegiatan  : {$data['nama']}\n" .
        //             "📅 Tanggal   : {$dayIndo}\n" .
        //             "🕒 Waktu     : {$time} ({$period})\n" .
        //             "📝 Catatan   : {$data['catatan']}\n" .
        //             "--------------------------" .
        //             "```",
        //         'schedule' => $hariH0,
        //         'countryCode' => '62',
        //     ],
        //     CURLOPT_HTTPHEADER => [
        //         'Authorization: VT2WkzUQRkBAREK385TA',
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

    private function sendEditNotification($oldData)
    {
        $pengingat = $this->request->getPost('pengingat[]') ?? [];
        $pengingatJson = json_encode($pengingat);

        $newData = [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'kontak' => $this->request->getPost('kontak'),
            'pengingat' => $pengingatJson,
            'catatan' => ltrim($this->request->getPost('catatan')),
        ];

        $oldData['catatan'] = ltrim($oldData['catatan']);

        $kontakString = is_array($newData['kontak']) ? implode(',', $newData['kontak']) : $newData['kontak'];
        $kontakNumbers = explode(',', $kontakString);
        $newData['kontak'] = $kontakString;

        // echo "<script>
        //     console.log('kontak get post (new): ', " . json_encode($newData['kontak']) . ");
        //     console.log('catatan get post (new): ', " . json_encode($newData['catatan']) . ");
        //     console.log('kontak old (database): ', " . json_encode($oldData['kontak']) . ");
        //     console.log('catatan old (database): ', " . json_encode($oldData['catatan']) . ");
        // </script>";

        // die();

        $dateHuman = date('Y-m-d H:i:s', strtotime('+1 minute'));
        $dateUnix = strtotime($dateHuman);

        $changedFields = [];
        foreach ($newData as $key => $value) {
            if ($oldData[$key] !== $value) {
                $changedFields[] = ucfirst($key);
            }
        }
        $ket = !empty($changedFields) ? implode(', ', $changedFields) : 'Tidak ada perubahan';

        $kontakNames = [];
        foreach ($kontakNumbers as $nomor) {
            $kontakNames[] = $this->getNamaByNomor($nomor);
        }
        $kontakDisplay = implode(', ', $kontakNames);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'target' => '085334813264',
                'message' =>
                "⚠️ Notifikasi EDIT reminder\n" .
                    "```" .
                    "--------------------------\n" .
                    "📌 Kegiatan : {$newData['nama']}\n" .
                    "📌 Tanggal  : {$newData['tanggal']}\n" .
                    "📌 Waktu    : {$newData['waktu']}\n" .
                    "📌 Kontak   : {$kontakDisplay}\n" .
                    "📌 Pengingat: {$newData['pengingat']}\n" .
                    "📌 Catatan  : {$newData['catatan']}\n" .
                    "📌 Ket.     : {$ket}\n" .
                    "--------------------------" .
                    "```",
                'schedule' => $dateUnix,
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => ['Authorization: VT2WkzUQRkBAREK385TA'],
        ]);

        curl_exec($curl);
        curl_close($curl);
    }

    private function sendDeleteNotification($oldData)
    {
        $pengingat = $oldData['pengingat'] ?? [];
        $pengingatJson = json_encode($pengingat);

        $newData = [
            'nama' => $oldData['nama'],
            'tanggal' => $oldData['tanggal'],
            'waktu' => $oldData['waktu'],
            'kontak' => $oldData['kontak'],
            'pengingat' => $pengingatJson,
            'catatan' => $oldData['catatan'],
        ];

        $dateHuman = date('Y-m-d H:i:s', strtotime('+1 minute'));
        $dateUnix = strtotime($dateHuman);

        $kontakString = is_array($newData['kontak']) ? implode(',', $newData['kontak']) : $newData['kontak'];
        $kontakNumbers = explode(',', $kontakString);
        $kontakNames = [];
        foreach ($kontakNumbers as $nomor) {
            $kontakNames[] = $this->getNamaByNomor($nomor);
        }
        $kontakDisplay = implode(', ', $kontakNames);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'target' => '085334813264',
                'message' =>
                "⚠️ Notifikasi HAPUS reminder\n" .
                    "```" .
                    "--------------------------\n" .
                    "📌 Kegiatan : {$newData['nama']}\n" .
                    "📌 Tanggal  : {$newData['tanggal']}\n" .
                    "📌 Waktu    : {$newData['waktu']}\n" .
                    "📌 Kontak   : {$kontakDisplay}\n" .
                    "📌 Pengingat: {$newData['pengingat']}\n" .
                    "📌 Catatan  : {$newData['catatan']}\n" .
                    "--------------------------" .
                    "```",
                'schedule' => $dateUnix,
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => ['Authorization: VT2WkzUQRkBAREK385TA'],
        ]);

        curl_exec($curl);
        curl_close($curl);
    }

    public function update($id)
    {
        $model = new JadwalKontenModel();
        $oldData = $model->find($id);

        $pengingat = $this->request->getPost('pengingat[]') ?? [];
        $pengingatJson = json_encode($pengingat);

        $kontak = $this->request->getPost('kontak[]');
        $kontakString = implode(',', $kontak);

        $updateSuccessful = $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'kontak' => $kontakString,
            'pengingat' => $pengingatJson,
            'catatan' => $this->request->getPost('catatan'),
        ]);

        if ($updateSuccessful) {
            $this->sendEditNotification($oldData);
            return redirect()->to(base_url('humas/manage'))->with('success', 'Data reminder berhasil diupdate');
        } else {
            return redirect()->to(base_url('humas/manage'))->with('error', 'Gagal mengupdate data reminder');
        }
    }

    private function getNamaByNomor($nomor)
    {
        $db = \Config\Database::connect();
        $query = $db->table('kontak')->select('nama')->where('nomor', $nomor)->get();
        $result = $query->getRow();
        return $result ? $result->nama : $nomor;
    }

    public function edit($id, string $page = 'Konten Humas | Edit')
    {
        $model = new JadwalKontenModel();
        $jadwalKonten = $model->find($id);

        if (!$jadwalKonten) {
            session()->setFlashdata('error', 'Data reminder tidak ditemukan.');
            return redirect()->to(base_url('humas/manage'));
        }

        // Convert kontak string to array if not empty
        if (!empty($jadwalKonten['kontak'])) {
            $jadwalKonten['kontak'] = explode(',', $jadwalKonten['kontak']);
        } else {
            $jadwalKonten['kontak'] = [];
        }

        $data = [
            'jadwalKonten' => $jadwalKonten,
            'title' => ucfirst($page),
        ];

        $currentUsername = session()->get('username');

        if (session()->get('role') === 'admin') {
            $kontakModel = new KontakModel();
            $data['contacts'] = $kontakModel->getContactsHumas();

            return view('templates/header', $data)
                . view('humas/edit', $data)
                . view('templates/footer');
        } else {
            if ($jadwalKonten['created_by'] !== $currentUsername) {
                return redirect()->back()->with('limited', 'Reminder hanya bisa diubah oleh orang yang membuatnya.');
            }
        }

        $kontakModel = new KontakModel();
        $data['contacts'] = $kontakModel->getContactsHumas();

        return view('templates/header', $data)
            . view('humas/edit', $data)
            . view('templates/footer');
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

        $deleteSuccessful = $model->delete($id);

        if ($deleteSuccessful) {
            $this->sendDeleteNotification($jadwalKonten);
            return redirect()->to(base_url('humas/manage'))->with('success', 'Data reminder berhasil dihapus');
        } else {
            return redirect()->to(base_url('humas/manage'))->with('error', 'Gagal menghapus data reminder');
        }
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

    public function maintenance1(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance2(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance3(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance4(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance5(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance6(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance7(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance8(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance9(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance10(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance11(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance12(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance13(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance14(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }

    public function maintenance15(string $page = 'Humas | Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }
}
