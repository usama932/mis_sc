<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SciSubTheme extends Model
{
    use HasFactory;
    protected $table = 'tbl_sci_sub_theme';
    protected $guarded = [];

    public function activity()
    {
        return $this->hasOne(DipActivity::class,'subtheme_id','id');
    }
    public function maintheme()
    {
        return $this->belongsTo(SciTheme::class,'sci_theme_id','id');
    }
}
