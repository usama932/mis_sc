<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class QBAttachement extends Model
{
    use HasFactory;
    protected $table = 'qb_attachments';
    protected $guarded = [];

    public function deleteDocument()
    {
        // Delete from the public folder
        $path = storage_path("app/public/qbattachment/".$this->attributes['document']);
          
        if(File::exists($path)){
           
            File::delete(storage_path('app/public/qbattachment/'.$this->attributes['document']));

        }
    }
    public function qb()
    {
        return $this->belongsTo(QualityBench::class,'quality_bench_id','id');
    }
}
