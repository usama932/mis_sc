<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionPoint extends Model
{
    use HasFactory;
    protected $table = 'monitor_action_points';
    protected $guarded = [];
    public function qb()
    {
        return $this->belongsTo(QualityBench::class,'quality_bench_id','id');
    }
}
