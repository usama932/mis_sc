<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackChannel extends Model
{
    use HasFactory;
    protected $table = 'feedback_channel';
    protected $guarded = [];
    public function frm()
    {
        return $this->hasMany(Frm::class,'feedback_channel','id');
    }
}
