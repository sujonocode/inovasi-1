<?php

namespace App\Models;

use CodeIgniter\Model;

class KodeArsipSKModel extends Model
{
    protected $table = 'kode_arsip_sk';

    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_klasifikasi', 'kode'];
}
