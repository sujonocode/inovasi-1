<?php

namespace App\Models;

use CodeIgniter\Model;

class UploadModel extends Model
{
    protected $table = 'upload';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_penomoran', 'nomor', 'kode_arsip', 'tanggal', 'perihal', 'catatan', 'url', 'nomor_urut', 'nomor_sisip', 'created_by'];
}
