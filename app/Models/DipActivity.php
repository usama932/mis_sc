<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DipActivity extends Model
{
    use HasFactory;
    protected $table = 'dip_activity';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function dip()
    {
        return $this->belongsTo(Dip::class,'dip_id','id');
    }
   
}
