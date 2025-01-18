<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FormController extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();
        $jenisOptions = $db->table('kode_arsip')->select('jenis')->distinct()->get()->getResultArray();

        return view('kontrak/form_view', ['jenisOptions' => $jenisOptions]);
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

    public function store()
    {
        $jenis = $this->request->getPost('jenis');
        $kode1 = $this->request->getPost('kode_1');
        $kodeKlasifikasi = $this->request->getPost('kode_klasifikasi');
        $db = \Config\Database::connect();
        $kode = $db->table('kode_arsip')
            ->select('kode')
            ->where('jenis', $jenis)
            ->where('kode_1', $kode1)
            ->where('kode_klasifikasi', $kodeKlasifikasi)
            ->get()
            ->getRow();

        return redirect()->back()->with('success', 'Selected Kode: ' . $kode->kode);
    }

    public function submitForm()
    {
        if ($this->request->getMethod() === 'post') {

            // Get form data
            $jenis = $this->request->getPost('jenis');
            $kode1 = $this->request->getPost('kode_1');
            $kodeKlasifikasi = $this->request->getPost('kode_klasifikasi');

            // Fetch the 'kode' from the database based on selected values
            $db = \Config\Database::connect();
            $builder = $db->table('kode_arsip');

            // Get the corresponding 'kode' based on the selected 'jenis', 'kode_1', and 'kode_klasifikasi'
            $query = $builder->select('kode')
                ->where('jenis', $jenis)
                ->where('kode_1', $kode1)
                ->where('kode_klasifikasi', $kodeKlasifikasi)
                ->get();

            // Check if we found the matching 'kode'
            $kode = $query->getRow();

            if ($kode) {
                // Save the 'kode' in the database (you can insert it into another table or use it as needed)
                $data = [
                    'kode' => $kode->kode, // Save the 'kode' value
                ];

                // Example: Insert the 'kode' value into another table, e.g., 'submitted_kodes'
                $db->table('submitted_kodes')->insert($data);

                // Redirect or return response after saving the data
                return redirect()->to('/form/success'); // Redirect to a success page or display a success message
            } else {
                // If no matching 'kode' found, show an error
                return redirect()->back()->with('error', 'Invalid combination of jenis, kode_1, and kode_klasifikasi.');
            }
        }

        // If not a POST request, redirect back with an error
        return redirect()->back()->with('error', 'Invalid request method.');
    }
}
