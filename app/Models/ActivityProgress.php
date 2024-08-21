<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityProgress extends Model
{
    use HasFactory;
    protected $table = 'dip_activity_progress';
    protected $guarded = [];
    
    public function activitymonth()
    {
        return $this->belongsTo(ActivityMonths::class,'quarter_id','id');
    }
    public function activity()
    {
        return $this->belongsTo(DipActivity::class,'activity_id','id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
