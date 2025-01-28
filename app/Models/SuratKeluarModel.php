<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{
    protected $table = 'surat_keluar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_penomoran', 'tanggal', 'alamat', 'ringkasan', 'nomor', 'kode_arsip', 'kategori', 'catatan', 'url', 'nomor_urut', 'nomor_sisip', 'created_by'];
}
