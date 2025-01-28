<?php

namespace App\Controllers;

use App\Models\SuratKeluarModel;
use App\Models\SuratMasukModel;
use App\Models\SKModel;
use App\Models\KontrakModel;

class Dokumen extends BaseController
{
    public function index(string $page = 'Manajemen Dokumen')
    {
        $modelSurat = new SuratKeluarModel();
        $modelSK = new SKModel();
        $modelKontrak = new KontrakModel();

        // Using a more concise approach to pass data to the view
        $data = [];

        // Assign all counts and groupings into the $data array
        $data['title'] = ucfirst($page);
        $data['totalSurat'] = $modelSurat->countAll();
        $data['totalSk'] = $modelSK->countAll();
        $data['totalKontrak'] = $modelKontrak->countAll();

        $data['totalSuratByKodeArsip'] = $modelSurat
            ->select('kode_arsip, COUNT(*) as count')
            ->groupBy('kode_arsip')
            ->findAll();

        $data['totalSkByKodeArsip'] = $modelSK
            ->select('kode_arsip, COUNT(*) as count')
            ->groupBy('kode_arsip')
            ->findAll();

        $data['totalKontrakByKodeArsip'] = $modelKontrak
            ->select('kode_arsip, COUNT(*) as count')
            ->groupBy('kode_arsip')
            ->findAll();

        $data['totalSuratByCreatedBy'] = $modelSurat
            ->select('created_by, COUNT(*) as count')
            ->groupBy('created_by')
            ->findAll();

        $data['totalSkByCreatedBy'] = $modelSK
            ->select('created_by, COUNT(*) as count')
            ->groupBy('created_by')
            ->findAll();

        $data['totalKontrakByCreatedBy'] = $modelKontrak
            ->select('created_by, COUNT(*) as count')
            ->groupBy('created_by')
            ->findAll();

        return view('templates/header', $data)
            . view('dokumen/index', $data)
            . view('templates/footer', $data);
    }
}
