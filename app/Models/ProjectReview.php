<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReview extends Model
{
    use HasFactory;
    protected $table = 'project_reviews';
    protected $guarded = [];

    public function rp()
    {
        return $this->belongsTo(User::class,'responsible_person','id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function action_point()
    {
        return $this->hasMany(Review_ActionPoint::class,'review_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
