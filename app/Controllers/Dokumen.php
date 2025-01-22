<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SuratModel;
use App\Models\SKModel;
use App\Models\KontrakModel;

class Dokumen extends BaseController
{
    public function index(string $page = 'Manajemen Dokumen')
    {
        $modelUser = new UserModel();
        $modelSurat = new SuratModel();
        $modelSK = new SKModel();
        $modelKontrak = new KontrakModel();

        $data = [
            'title' => ucfirst($page),

            'totalUser' => $modelUser->countAll(),
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

            'totalSuratByCreatedBy' => $modelSurat
                ->select('created_by, COUNT(*) as count')
                ->groupBy('created_by')
                ->findAll(),
            'totalSKByCreatedBy' => $modelSK
                ->select('created_by, COUNT(*) as count')
                ->groupBy('created_by')
                ->findAll(),
            'totalKontrakByCreatedBy' => $modelKontrak
                ->select('created_by, COUNT(*) as count')
                ->groupBy('created_by')
                ->findAll(),
        ];

        return view('templates/header', $data)
            . view('dokumen/index', $data)
            . view('templates/footer');
    }
}
