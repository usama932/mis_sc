<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class StaffEmail extends Authenticatable
{
    use HasFactory;
    protected $table = 'staff_emails';
    protected $guarded = [];
}
