<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPartner extends Model
{
    use HasFactory;
    protected $table = 'project_partner';
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function partner_name()
    {
        return $this->belongsTo(Partner::class,'partner_id','id');
    }
    
}
