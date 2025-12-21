<?php

namespace App\Models;

use CodeIgniter\Model;

class FP26Model extends Model
{
    protected $table = 'fp_26';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_penomoran', 'nomor', 'kode_arsip', 'tanggal', 'ringkasan', 'catatan', 'nomor_urut', 'nomor_sisip', 'created_by'];
}
