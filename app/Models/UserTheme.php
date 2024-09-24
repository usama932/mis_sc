<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTheme extends Model
{
    use HasFactory;
    protected $table = 'user_theme';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function subtheme()
    {
        return $this->belongsTo(SciSubTheme::class,'theem_id','id');
    }
    public function projectPartner()
    {
        return $this->belongsTo(ProjectPartner::class,'partner_id','id');
    }
    
    
}
