<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityBench extends Model
{
    use HasFactory;
    protected $table = 'quality_benchs';
    protected $guarded = [];
}
