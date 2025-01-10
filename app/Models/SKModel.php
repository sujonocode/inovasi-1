<?php

namespace App\Models;

use CodeIgniter\Model;

class SKModel extends Model
{
    protected $table = 'sk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor', 'tanggal', 'perihal', 'catatan'];
}
