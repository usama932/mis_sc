<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTheme extends Model
{
    use HasFactory;
    protected $table = 'user_theme';
    protected $guarded = [];
}
