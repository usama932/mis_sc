<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityMonths extends Model
{
    use HasFactory;
    protected $table = 'dip_activity_months';
    protected $guarded = [];

    public function activity()
    {
        return $this->belongsTo(DipActivity::class,'activity_id','id');
    }
}