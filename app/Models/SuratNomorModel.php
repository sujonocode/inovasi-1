<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratNomorModel extends Model
{
    protected $table = 'surat_nomor';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor', 'title', 'date', 'description'];
}
