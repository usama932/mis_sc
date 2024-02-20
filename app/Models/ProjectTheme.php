<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTheme extends Model
{
    use HasFactory;
    protected $table = 'project_theme';
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function theme_name()
    {
        return $this->belongsTo(Theme::class,'theme_id','id');
    }
    public function scitheme_name()
    {
        return $this->belongsTo(SCITheme::class,'theme_id','id');
    }
    public function scisubtheme_name()
    {
        return $this->belongsTo(SciSubTheme::class,'sub_theme_id','id');
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
