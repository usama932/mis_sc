<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QBAttachement extends Model
{
    use HasFactory;
    protected $table = 'qb_attachments';
    protected $guarded = [];
}
