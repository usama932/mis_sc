<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivityCategory extends Model
{
    use HasFactory;
    protected $table = 'project_activity_category';
    protected $guarded = [];

    public function activity_type()
    {
        return $this->belongsTo(ProjectActivityType::class,'project_activity_type_id','id');
    }
    public function activity()
    {
        return $this->belongsTo(DipActivity::class,'activity_type_id','id');
    }
}
