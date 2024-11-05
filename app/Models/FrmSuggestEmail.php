<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmSuggestEmail extends Model
{
    use HasFactory;
    protected $table = 'frm_suggest_email';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function frm()
    {
        return $this->belongsTo(FRM::class,'frm_id','id');
    }
}
