<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frm extends Model
{
    use HasFactory;
    protected $table = 'tbl_fbreg';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function provinces()
    {
        return $this->belongsTo(Province::class,'province','province_id');
    }
    public function districts()
    {
        return $this->belongsTo(District::class,'district','district_id');
    }
    public function tehsils()
    {
        return $this->belongsTo(Tehsil::class,'tehsil','id');
    }
    public function uc()
    {
        return $this->belongsTo(UnionCounsil::class,'union_counsil','union_id');
    }
    public function category()
    {
        return $this->belongsTo(FeedbackCategory::class,'feedback_category','id');
    }
    public function channel()
    {
        return $this->belongsTo(FeedbackChannel::class,'feedback_channel','id');
    }
    public function theme_name()
    {
        return $this->belongsTo(Theme::class,'theme','id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_name','id');
    }
    public function responses()
    {
        return $this->hasMany(FrmResponse::class,'fbreg_id','id');
    }

}

