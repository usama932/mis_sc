<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorVisit extends Model
{
    use HasFactory;
    protected $table = 'monitor_visits';
    protected $guarded = [];
    public function qb()
    {
        return $this->belongsTo(QualityBench::class,'quality_bench_id','id');
    }
    public function action_point()
    {
        return $this->hasMany(ActionPoint::class,'monitor_visits_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
}
