<?php

namespace App\Models;

use CodeIgniter\Model;

class Kontrak26Model extends Model
{
    protected $table = 'kontrak_26';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_penomoran', 'tanggal', 'nomor', 'kode_arsip', 'ket', 'uraian', 'catatan', 'url', 'nomor_urut', 'nomor_sisip', 'created_by'];
}
