<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class StaffEmail extends Model
{
    use HasFactory;
    protected $table = 'staff_emails';
    protected $guarded = [];
}
