<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchNumber extends Model
{
    use HasFactory;
    protected $table = 'batch_number';
    protected $guarded = [];

    public function beneficiaryassessments()
    {
        return $this->hasMany(BenficiaryAssessment::class,'batch_id','id');
    }
}
