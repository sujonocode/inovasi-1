<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalQualityGatesModel extends Model
{
    protected $table = 'jadwal_quality_gates';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'tanggal', 'waktu', 'kontak', 'pengingat', 'catatan', 'created_by'];
}
