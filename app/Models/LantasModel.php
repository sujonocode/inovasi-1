<?php

namespace App\Models;

use CodeIgniter\Model;

class LantasModel extends Model
{
    protected $table = 'kendala';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tim', 'nama', 'tahun', 'bulan', 'kendala', 'solusi', 'created_at', 'created_by'];
}
