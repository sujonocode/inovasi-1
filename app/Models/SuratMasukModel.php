<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{
    protected $table = 'surat_masuk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'nomor', 'asal', 'perihal', 'kategori', 'catatan', 'url', 'created_by'];
}
