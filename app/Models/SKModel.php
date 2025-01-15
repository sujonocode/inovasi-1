<?php

namespace App\Models;

use CodeIgniter\Model;

class SKModel extends Model
{
    protected $table = 'sk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_penomoran', 'nomor', 'kode_arsip', 'tanggal', 'perihal', 'catatan', 'url', 'nomor_urut', 'nomor_sisip'];
}
