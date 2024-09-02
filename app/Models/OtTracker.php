<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtTracker extends Model
{
    use HasFactory;
    protected $table = 'activity_progress_view';
    protected $guarded = [];
}
