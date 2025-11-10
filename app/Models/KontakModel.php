<?php

namespace App\Models;

use CodeIgniter\Model;

class KontakModel extends Model
{
    protected $table = 'kontak';
    protected $primaryKey = 'id';

    public function getContacts()
    {
        return $this->findAll();
    }

    public function getContactsHumas()
    {
        return $this->where('humas_flag', '1')->findAll();
    }
}
