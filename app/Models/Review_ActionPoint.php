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
        return $this->belongsTo(ProjectReview::class,'review_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
}
