<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ActivityMonths extends Model
{
    use HasFactory;
    protected $table = 'dip_activity_months';
    protected $guarded = [];

    public function activity()
    {
        return $this->belongsTo(DipActivity::class,'activity_id','id');
    }
 
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function slug()
    {
        return $this->belongsTo(SCIQuarter::class,'quarter','id');
    }
    public function progress()
    {
        return $this->hasOne(ActivityProgress::class,'quarter_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public static function getWithSortedActivities($limit, $start)
    {
        return self::limit($limit)
            ->offset($start)
            ->with(['activity' => function ($query) {
                $query->orderByActivityNumber();
            }])
            ->get();
    }
}
