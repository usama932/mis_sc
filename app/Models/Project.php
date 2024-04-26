<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $guarded = [];
    public function frm()
    {
        return $this->hasMany(Frm::class,'project_name','id');
    }
    public function themes()
    {
        return $this->hasMany(ProjectTheme::class,'project_id','id');
    }
  
    public function activities()
    {
        return $this->hasMany(DipActivity::class,'project_id','id');
    }
    public function activity_months()
    {
        return $this->hasMany(ActivityMonths::class,'project_id','id');
    }
    public function progress()
    {
        return $this->hasMany(ActivityProgress::class,'project_id','id');
    }
    public function partners()
    {
        return $this->hasMany(ProjectPartner::class,'project_id','id');
    }
    public function reviews()
    {
        return $this->hasMany(ProjectReview::class,'project_id','id');
    }
    public function profile()
    {
        return $this->hasMany(ProjectProfile::class,'project_id','id');
    }
    public function detail()
    {
        return $this->hasOne(ProjectDetail::class,'project_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function focalperson()
    {
        return $this->belongsTo(User::class,'focal_person','id');
    }
    public function budgetholder()
    {
        return $this->belongsTo(User::class,'budget_holder','id');
    }
    public function awardfp()
    {
        return $this->belongsTo(User::class,'award_person','id');
    }
    public function donors()
    {
        return $this->belongsTo(Donor::class,'donor','id');
    }
}
