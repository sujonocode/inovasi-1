<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table = 'schedule';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'date', 'description'];
}
