<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalLainnyaModel extends Model
{
    protected $table = 'jadwal_lainnya';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'tanggal', 'waktu', 'kontak', 'pengingat', 'catatan', 'created_by'];
}
