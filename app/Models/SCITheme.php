<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SCITheme extends Model
{
    use HasFactory;
    protected $table = 'tbl_sci_themes';
    protected $guarded = [];
    public function subtheme()
    {
        return $this->hasMany(SciSubTheme::class,'sci_theme_id','id');
    }
    
}
