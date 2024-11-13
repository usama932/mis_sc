<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorActivities extends Model
{
    use HasFactory;
    
    protected $table = 'indicator_activities';
    protected $guarded = [];

    public function indicator()
    {
        return $this->belongsTo(Indicator::class,'indicator_id','id');
    }
    public function activity()
    {
        return $this->belongsTo(DipActivity::class,'activity_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
}
