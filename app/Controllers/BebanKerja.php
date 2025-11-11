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
        $data['kegiatan'] = $this->kegiatanModel->findAll();
        return view('pantau/upload', $data);
    }

    public function save()
    {
        $id_kegiatan = $this->request->getPost('id_kegiatan');
        $file = $this->request->getFile('file_excel');

        if ($file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            foreach (array_slice($sheet, 1) as $row) {
                $pegawai = $this->bebanModel->getPegawaiByNama($row[0]); // custom function
                if ($pegawai) {
                    $this->bebanModel->insert([
                        'id_kegiatan' => $id_kegiatan,
                        'id_pegawai' => $pegawai['id'],
                        'peran' => $row[1],
                        'target' => $row[2],
                        'satuan' => $row[3],
                        'realisasi' => 0,
                        'progress_persen' => 0
                    ]);
                }
            }
        }

        return redirect()->to('/pantau/beban-kerja')->with('success', 'Data beban kerja berhasil diunggah!');
    }
}
