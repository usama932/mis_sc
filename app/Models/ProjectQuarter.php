<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectQuarter extends Model
{
    use HasFactory;
    protected $table = 'project_tenures';
    protected $guarded = [];
    
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function quarter()
    {
        return $this->hasOne(ActivityMonths::class,'month','id');
    }
}
