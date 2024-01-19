<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    protected $table = 'themes';
    protected $guarded = [];
    public function frm()
    {
        return $this->hasMany(Frm::class,'theme','id');
    }
    public function project()
    {
        return $this->hasOne(ProjectTheme::class,'theme_id','id');
    }

}
