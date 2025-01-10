<?php

namespace App\Controllers;

use App\Models\ScheduleModel;
use DateTime;
use DateTimeZone;

class Kendala extends BaseController
{
    public function index(string $page = 'kendala')
    {
        $model = new ScheduleModel();
        $data['title'] = ucfirst($page);
        $data['events'] = $model->findAll();

        // return view('kendala/index');
        return view('templates/header', $data)
            . view('kendala/index')
            . view('templates/footer');
    }

    public function manage()
    {
        $model = new ScheduleModel();
        $data['schedules'] = $model->findAll();

        return view('kendala/manage', $data);
    }

    public function create()
    {
        return view('kendala/create');
    }

    public function store()
    {
        $model = new ScheduleModel();

        // Validate and save the data
        $data = [
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ];

        if ($model->save($data)) {
            // Schedule added successfully. Now send the notification.
            $this->sendNotification();

            // Redirect with success message
            return redirect()->to('/kendala/manage')->with('success', 'Schedule created and notification sent.');
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
        $model = new ScheduleModel();

        // Validate and save the data
        $data = [
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ];

        $dateHuman = $data['date'] . ' ' . '11:30:00';
        $dateUnix = $this->humanToUnix($dateHuman);

        // // Convert Unix to human-readable date
        // echo "Human Date: " . $this->unixToHuman($data['date']); // Output: Human Date: 2022-11-03 07:00:00

        // // Convert human-readable date to Unix
        // $humanDate = '2022-11-03 07:00:00';
        // echo "Unix Timestamp: " . $this->humanToUnix($humanDate); // Output: Unix Timestamp: 1667433600

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
                'target' => '082228769126',
                'message' =>
                'A new schedule has been added!' . '
                    ' . 'Nama   : ' . $data['title'] . '
                    ' . 'Tanggal: ' . $dateHuman . '
                    ' . 'Tanggal: ' . $dateUnix . '
                    ' . 'Ket    : ' . $data['description'],
                'schedule' => $dateUnix,
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: CczZN35pLJ6yvpDA9GFH', // Replace TOKEN with your actual token
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // Log response or handle errors
        if ($response === false) {
            log_message('error', "Notification failed: $error");
        } else {
            log_message('info', "Notification sent: $response");
        }
    }

    public function edit($id)
    {
        $model = new ScheduleModel();

        // Fetch the schedule data by ID
        $data['schedule'] = $model->find($id);

        // If the record doesn't exist, show an error message on the edit page
        if (!$data['schedule']) {
            // Pass an error message directly to the edit view
            return view('kendala/edit', ['error' => 'Schedule not found.']);
        }

        // If the record exists, load the edit form
        return view('kendala/edit', $data);
    }

    public function update($id)
    {
        $model = new ScheduleModel();
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'date' => $this->request->getPost('date'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('kendala/manage');
    }

    public function delete($id)
    {
        // $model = new ScheduleModel();
        // $model->delete($id);

        // return redirect()->to('/schedule');
        $model = new ScheduleModel();

        // Fetch the schedule data by ID
        $schedule = $model->find($id);

        // If the record doesn't exist, redirect with an error message
        if (!$schedule) {
            return redirect()->to('kendala/manage')->with('error', 'Schedule not found.');
        }

        // Proceed with deletion
        $model->delete($id);

        // Redirect with a success message after deletion
        return redirect()->to('kendala/manage')->with('success', 'Schedule deleted successfully.');
    }

    public function getEvents()
    {
        $model = new \App\Models\ScheduleModel();
        $schedules = $model->findAll();

        return view('kendala/index', ['schedules' => $schedules]);
    }
}
