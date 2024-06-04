<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DipActivity extends Model
{
    use HasFactory;
    protected $table = 'dip_activity';
    protected $guarded = [];

    public function activity_type()
    {
        return $this->belongsTo(ProjectActivityCategory::class,'activity_type_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function months()
    {
        return $this->hasMany(ActivityMonths::class,'activity_id','id');
    }
    public function progress()
    {
        return $this->hasMany(ActivityProgress::class,'activity_id','id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function scisubtheme_name()
    {
        return $this->belongsTo(SciSubTheme::class,'subtheme_id','id');
    }
}
