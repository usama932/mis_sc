<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldQB extends Model
{
    use HasFactory;
    protected $table = 'old_qbs';
    protected $guarded = [];
    public function action_point()
    {
        return $this->hasMany(OldActionTracker::class,'qb_id','id');
    }

}
