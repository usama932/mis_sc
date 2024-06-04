<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivityType extends Model
{
    use HasFactory;
    protected $table = 'project_activity_type';
    protected $guarded = [];

    public function cateogries()
    {
        return $this->hasMany(ProjectActivityCategory::class,'project_activity_type_id','id');
    }
}
