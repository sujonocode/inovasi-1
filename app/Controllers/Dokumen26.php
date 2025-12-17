<?php

namespace App\Controllers;

use App\Models\SuratKeluar26Model;
use App\Models\SuratMasuk26Model;
use App\Models\SK26Model;
use App\Models\Kontrak26Model;

class Dokumen26 extends BaseController
{
    public function index(string $page = 'Manajemen Dokumen')
    {
        $modelSuratKeluar = new SuratKeluar26Model();
        $modelSuratMasuk = new SuratMasuk26Model();
        $modelSK = new SK26Model();
        $modelKontrak = new Kontrak26Model();

        // Using a more concise approach to pass data to the view
        $data = [];

        // Assign all counts and groupings into the $data array
        $data['title'] = ucfirst($page);
        $data['totalSuratKeluar'] = $modelSuratKeluar->countAll();
        $data['totalSuratMasuk'] = $modelSuratMasuk->countAll();
        $data['totalSk'] = $modelSK->countAll();
        $data['totalKontrak'] = $modelKontrak->countAll();

        $data['totalSuratKeluarByKodeArsip'] = $modelSuratKeluar
            ->select('kode_arsip, COUNT(*) as count')
            ->groupBy('kode_arsip')
            ->findAll();

        $data['totalSuratMasukByAsal'] = $modelSuratMasuk
            ->select('asal, COUNT(*) as count')
            ->groupBy('asal')
            ->findAll();

        $data['totalSkByKodeArsip'] = $modelSK
            ->select('kode_arsip, COUNT(*) as count')
            ->groupBy('kode_arsip')
            ->findAll();

        $data['totalKontrakByKodeArsip'] = $modelKontrak
            ->select('kode_arsip, COUNT(*) as count')
            ->groupBy('kode_arsip')
            ->findAll();

        $data['totalSuratKeluarByCreatedBy'] = $modelSuratKeluar
            ->select('created_by, COUNT(*) as count')
            ->groupBy('created_by')
            ->findAll();

        $data['totalSuratMasukByCreatedBy'] = $modelSuratMasuk
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
            . view('dokumen26/index', $data)
            . view('templates/footer', $data);
    }

    public function arsip2025(string $page = 'Dokumen | Arsip')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('dokumen26/arsip', $data)
            . view('templates/footer');
    }
}
