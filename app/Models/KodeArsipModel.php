<?php

namespace App\Models;

use CodeIgniter\Model;

class KodeArsipModel extends Model
{
    protected $table = 'kode_arsip';

    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis', 'kode_1', 'kode_klasifikasi', 'kode'];

    public function getDistinctJenis()
    {
        return $this->distinct()->select('jenis')->findAll();
    }

    public function getKode1ByJenis($jenis)
    {
        return $this->distinct()->select('kode_1')->where('jenis', $jenis)->findAll();
    }

    public function getKodeKlasifikasiByKode1($kode1)
    {
        return $this->distinct()->select('kode_klasifikasi')->where('kode_1', $kode1)->findAll();
    }
}
