<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmTag extends Model
{
    use HasFactory;
    protected $table = 'frm_tags';
    protected $guarded = [];

    public function frm()
    {
        return $this->belongsTo(FRM::class,'frm_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'tagged_by','id');
    }
}
