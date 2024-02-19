<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SCIQuarter extends Model
{
    use HasFactory;
    protected $table = 'tbl_sci_quarters';
    protected $guarded = [];

    public function q()
    {
        return $this->hasOne(ActivityMonths::class,'quarter','id');
    }
}
