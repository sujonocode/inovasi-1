<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $allowedFields = ['title', 'start_date', 'end_date', 'type'];
}
