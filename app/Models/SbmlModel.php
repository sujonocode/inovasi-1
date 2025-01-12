<?php

namespace App\Models;

use CodeIgniter\Model;

class SbmlModel extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'alamat', 'ringkasan', 'pert_dahulu', 'pert_berikut', 'catatan'];
}
