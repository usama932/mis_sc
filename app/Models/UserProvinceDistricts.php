<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProvinceDistricts extends Model
{
    use HasFactory;
    protected $table = 'user_province_districts';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function projectPartner()
    {
        return $this->belongsTo(ProjectPartner::class,'partner_id','id');
    }
}
