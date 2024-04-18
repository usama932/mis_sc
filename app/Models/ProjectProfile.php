<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProfile extends Model
{
    use HasFactory;
    protected $table = 'project_profile';
    protected $guarded = [];
    
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function theme()
    {
        return $this->belongsTo(SCITheme::class,'theme_id','id');
    }
}
