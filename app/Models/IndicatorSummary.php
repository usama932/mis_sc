<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorSummary extends Model
{
    use HasFactory;
    protected $table = 'indicator_summary'; // specify the view name
    public $timestamps = false;
}
