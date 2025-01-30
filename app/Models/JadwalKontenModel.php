<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKontenModel extends Model
{
    protected $table = 'jadwal_konten';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'tanggal', 'waktu', 'kategori', 'kontak', 'pengingat', 'catatan', 'created_by'];
}
