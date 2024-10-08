<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionAcheive extends Model
{
    use HasFactory;
    protected $table = 'action_acheives';
    protected $guarded = [];
    public function action_point()
    {
        return $this->belongsTo(ActionPoint::class,'action_point_id','monitor_visits_id');
    }
}
