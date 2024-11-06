<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenficiaryAssessment extends Model
{
    use HasFactory;
    protected $table = 'benficiaryassessment';
    protected $guarded = [];
    
    public function project()
    {
        return $this->belongsTo(Project::class,'project','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }

    public function provinces()
    {
        return $this->belongsTo(Province::class,'province','province_id');
    }
    public function districts()
    {
        return $this->belongsTo(District::class,'district','district_id');
    }
    public function tehsils()
    {
        return $this->belongsTo(Tehsil::class,'tehsil','id');
    }
    public function ucs()
    {
        return $this->belongsTo(UnionCounsil::class,'uc','union_id');
    }
}
