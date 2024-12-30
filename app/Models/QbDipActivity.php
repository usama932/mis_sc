<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbDipActivity extends Model
{
    use HasFactory;
    protected $table = 'qb_dip_activities';
    protected $guarded = [];

    public function qb()
    {
        return $this->belongsTo(QualityBench::class,'qb_id','id');
    }
    public function activity()
    {
        return $this->belongsTo(DipActivity::class,'dip_activity_id','id');
    }
}
