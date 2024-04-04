<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingRecord extends Model
{
    use HasFactory;
    protected $table = 'tbl_fbreg';
    protected $guarded = [];

}
