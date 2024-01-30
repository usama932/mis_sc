<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    use HasFactory;
    protected $table = 'project_details';
    protected $guarded = [];
    
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    
}
