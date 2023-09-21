<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackCategory extends Model
{
    use HasFactory;
    protected $table = 'feedback_category';
    protected $guarded = [];
    public function frm()
    {
        return $this->hasMany(Frm::class,'feedback_category','id');
    }
}
