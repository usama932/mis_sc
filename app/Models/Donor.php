<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;
    protected $table = 'donors';
    protected $guarded = [];
    public function project()
    {
        return $this->hasOne(Project::class,'donor','id');
    }
}
