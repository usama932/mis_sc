<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
   
    use HasFactory;
    protected $table = 'tbl_partner';
    protected $guarded = [];

    public function project()
    {
        return $this->hasOne(ProjectPartner::class,'theme_id','id');
    }
    public function qb()
    {
        return $this->hasOne(QualityBench::class,'partner','id');
    }
}
