<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'designation',
        'user_type',
        'district',
        'province',
        'status',
        'theme_id',
        'is_enable_dip',
        'is_enable_frm',
        'is_enable_qb',
        'permissions_level',
        'last_login_at',
        'last_login_ip',
        'profile_photo_path',
    ];

  
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        return $this->profile_photo_path;
    }
    public function frm()
    {
        return $this->hasMany(Frm::class,'created_by','id');
    }
    public function frmtag()
    {
        return $this->hasMany(Frm::class,'created_by','id');
    }
    public function project_theme()
    {
        return $this->hasMany(ProjectTheme::class,'created_by','id');
    }
    public function districtprovince()
    {
        return $this->hasMany(UserProvinceDistricts::class,'user_id','id');
    }
    public function desig()
    {
        return $this->belongsTo(Designation::class,'designation','id');
    }
    
    public function theme(){
        return $this->hasOne(UserTheme::class,'user_id','id');
    }

  
}
