<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review_ActionPoint extends Model
{
    use HasFactory;
    protected $table = 'project_review_actionpoints';
    protected $guarded = [];

    public function review()
    {
        return $this->hasMany(ProjectReview::class,'review_id','id');
    }
}
