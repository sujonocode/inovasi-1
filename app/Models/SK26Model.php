<?php

namespace App\Models;

use CodeIgniter\Model;

class SK26Model extends Model
{
    protected $table = 'sk_26';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_penomoran', 'nomor', 'kode_arsip', 'tanggal', 'perihal', 'catatan', 'url', 'nomor_urut', 'nomor_sisip', 'created_by'];
}
