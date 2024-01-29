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
    public function partners()
    {
        return $this->hasMany(ProjectPartner::class,'project_id','id');
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
}
