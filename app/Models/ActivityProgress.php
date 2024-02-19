<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityProgress extends Model
{
    use HasFactory;
    protected $table = 'dip_activity_progress';
    protected $guarded = [];
    public function activity()
    {
        return $this->belongsTo(ActivityMonths::class,'activity_id','id');
    }
}
