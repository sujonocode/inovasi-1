<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasuk26Model extends Model
{
    protected $table = 'surat_masuk_26';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'nomor', 'asal', 'perihal', 'kategori', 'catatan', 'url', 'created_by'];
}
