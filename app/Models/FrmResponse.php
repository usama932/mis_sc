<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmResponse extends Model
{
    use HasFactory;
    protected $table = 'response_history';
    protected $guarded = [];
    public function responses()
    {
        return $this->belongsTo(Frm::class,'fbreg_id','id');
    }
}
