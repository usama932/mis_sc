<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityBench extends Model
{
    use HasFactory;
    protected $table = 'quality_benchs';
    protected $guarded = [];

    public function provinces()
    {
        return $this->belongsTo(Province::class,'province','province_id');
    }
    public function districts()
    {
        return $this->belongsTo(District::class,'district','district_id');
    }
    public function tehsils()
    {
        return $this->belongsTo(Tehsil::class,'tehsil','id');
    }
    public function uc()
    {
        return $this->belongsTo(UnionCounsil::class,'union_counsil','union_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_name','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function monitor_visit()
    {
        return $this->hasMany(MonitorVisit::class,'quality_bench_id','id');
    }
    public function action_point()
    {
        return $this->hasMany(ActionPoint::class,'quality_bench_id','id');
    }
    public function qbattachement()
    {
        return $this->hasOne(QBAttachement::class,'quality_bench_id','id');
    }
    
    public function theme_name()
    {
        return $this->belongsTo(Theme::class,'theme','id');
    }

    public function partners()
    {
        return $this->belongsTo(Partner::class,'partner','id');
    }

    public function dipactivity()
    {
        return $this->hasMany(QbDipActivity::class,'qb_id','id');
    }
   
}
