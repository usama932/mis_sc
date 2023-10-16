<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorVisit extends Model
{
    use HasFactory;
    protected $table = 'monitor_visits';
    protected $guarded = [];
}
