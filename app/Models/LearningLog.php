<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningLog extends Model
{
    use HasFactory;
    protected $table = 'learning_logs';
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsTo(Project::class,'project','id');
    }
    public function theme_name()
    {
        return $this->belongsTo(Theme::class,'theme','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
  
    public function districts()
    {
        return $this->belongsTo(District::class,'district','district_id');
    }
}

