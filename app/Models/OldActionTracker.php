<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldActionTracker extends Model
{
    use HasFactory;
    protected $table = 'old_action_tracker';
    protected $guarded = [];
    public function qb()
    {
        return $this->belongsTo(OldQB::class,'qb_id','id');
    }
}
