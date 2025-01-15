<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_penomoran', 'tanggal', 'alamat', 'ringkasan', 'pert_dahulu', 'pert_berikut', 'kode_arsip', 'kategori', 'catatan', 'url', 'nomor_urut', 'nomor_sisip'];
}
