<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivitySummary extends Model
{
    protected $table = 'project_activity_summary';

    // Disable timestamps for the view model
    public $timestamps = false;
}
