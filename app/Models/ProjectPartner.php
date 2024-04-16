<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPartner extends Model
{
    use HasFactory;
    protected $table = 'project_partner';
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function partner_name()
    {
        return $this->belongsTo(Partner::class,'partner_id','id');
    }
    public function scitheme_name()
    {
        return $this->belongsTo(SCITheme::class,'themes','id');
    }
    public function scisubtheme_name()
    {
        return $this->belongsTo(SciSubTheme::class,'themes','id');
    }
    public function theme_name()
    {
        return $this->belongsTo(Theme::class,'themes','id');
    }
    public function provincedistrict(){
        return $this->hasMany(UserProvinceDistricts::class,'partner_id','id');
    }
    public function partnertheme(){
        return $this->hasMany(UserTheme::class,'partner_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

}
