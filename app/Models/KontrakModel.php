<?php

namespace App\Models;

use CodeIgniter\Model;

class KontrakModel extends Model
{
    protected $table = 'kontrak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'nomor', 'kode_arsip', 'uraian', 'catatan', 'url', 'nomor_urut', 'nomor_sisip'];
}
