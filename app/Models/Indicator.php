<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;
    protected $table = 'indicators';
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');

    }
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
}
