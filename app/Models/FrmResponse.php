<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmResponse extends Model
{
    use HasFactory;
    protected $table = 'response_history';
    protected $guarded = [];
}
