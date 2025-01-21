<?php

namespace App\Controllers;

use App\Models\SuratModel;
use App\Models\SKModel;
use App\Models\KontrakModel;

class Dokumen extends BaseController
{
    public function index(string $page = 'Manajemen Dokumen')
    {
        $modelSurat = new SuratModel();
        $modelSK = new SKModel();
        $modelKontrak = new KontrakModel();

        $data = [
            'title' => ucfirst($page),
            'totalSurat' => $modelSurat->countAll(),
            'totalSK' => $modelSK->countAll(),
            'totalKontrak' => $modelKontrak->countAll(),
            'totalSuratByKodeArsip' => $modelSurat
                ->select('kode_arsip, COUNT(*) as count')
                ->groupBy('kode_arsip')
                ->findAll(),
            'totalSKByKodeArsip' => $modelSK
                ->select('kode_arsip, COUNT(*) as count')
                ->groupBy('kode_arsip')
                ->findAll(),
            'totalKontrakByKodeArsip' => $modelKontrak
                ->select('kode_arsip, COUNT(*) as count')
                ->groupBy('kode_arsip')
                ->findAll(),
        ];

        return view('templates/header', $data)
            . view('dokumen/index', $data)
            . view('templates/footer');
    }
}
