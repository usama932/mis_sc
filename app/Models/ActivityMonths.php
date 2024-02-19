<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityMonths extends Model
{
    use HasFactory;
    protected $table = 'dip_activity_months';
    protected $guarded = [];

    public function activity()
    {
        return $this->belongsTo(DipActivity::class,'activity_id','id');
    }
    public function tenure()
    {
        return $this->belongsTo(ProjectQuarter::class,'month','id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function slug()
    {
        return $this->belongsTo(SCIQuarter::class,'quarter','id');
    }
}
