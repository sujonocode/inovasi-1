<?php

namespace App\Models;

use CodeIgniter\Model;

class KodeArsipFPModel extends Model
{
    protected $table = 'kode_arsip_fp';

    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_klasifikasi', 'kode'];
}
