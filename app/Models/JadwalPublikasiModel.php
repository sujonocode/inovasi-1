<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPublikasiModel extends Model
{
    protected $table = 'jadwal_publikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'tanggal', 'waktu', 'kontak', 'pengingat', 'catatan', 'created_by'];
}
