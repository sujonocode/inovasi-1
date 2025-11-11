<?php

namespace App\Controllers;

use App\Models\BebanKerjaModel;
use App\Models\MasterKegiatanModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Upload extends BaseController
{
    protected $bebanModel;
    protected $kegiatanModel;

    public function __construct()
    {
        $this->bebanModel = new BebanKerjaModel();
        $this->kegiatanModel = new MasterKegiatanModel();
    }

    public function index()
    {
        $user = session()->get('user');
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanByRole($user);
        return view('pantau/upload', $data);
    }

    public function save()
    {
        $user = session()->get('user');
        $file = $this->request->getFile('file_excel');
        $id_kegiatan = $this->request->getPost('id_kegiatan');

        if (!$id_kegiatan) return redirect()->back()->with('error', 'Pilih kegiatan terlebih dahulu.');

        // cek apakah ketua_tim mengupload untuk kegiatan miliknya
        $keg = $this->kegiatanModel->find($id_kegiatan);
        if (!$keg) return redirect()->back()->with('error', 'Kegiatan tidak ditemukan.');
        if ($user['role'] === 'ketua_tim' && $keg['created_by'] != $user['id']) {
            return redirect()->back()->with('error', 'Tidak berhak upload untuk kegiatan ini.');
        }

        if ($file && $file->isValid()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            // asumsikan baris pertama header:
            foreach (array_slice($sheet, 1) as $row) {
                $namaPegawai = trim($row[0]);
                $peran = trim($row[1] ?? '');
                $target = (float)($row[2] ?? 0);
                $satuan = trim($row[3] ?? '');

                $pegawai = $this->bebanModel->getPegawaiByNama($namaPegawai);
                if (!$pegawai) {
                    // jika pegawai tidak ada, bisa skip atau buat log. Di sini kita skip.
                    continue;
                }

                // insert beban_kerja
                $this->bebanModel->insert([
                    'id_kegiatan' => $id_kegiatan,
                    'id_pegawai' => $pegawai['id'],
                    'peran' => $peran,
                    'target' => $target,
                    'satuan' => $satuan,
                    'realisasi' => 0,
                    'progress_persen' => 0
                ]);
            }

            return redirect()->to('/pantau')->with('success', 'Beban kerja berhasil diunggah.');
        } else {
            return redirect()->back()->with('error', 'File tidak valid.');
        }
    }
}
