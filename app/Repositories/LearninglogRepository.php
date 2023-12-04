<?php
namespace App\Repositories;

use App\Repositories\Interfaces\LearningLogRepositoryInterface;
use App\Models\LearningLog;
use File;

class LearninglogRepository implements LearningLogRepositoryInterface
{
    public function storelearninglog($data)
    {
        
        if(!empty($data['thumbnail'])){
         
            $path = storage_path("app/public/learninglog/thumbnail" .$data['thumbnail']);
            
            if(File::exists($path)){
                
                File::delete(storage_path('app/public/learninglog/thumbnail'.$data['thumbnail']));
    
            }
            
            $file = $data['thumbnail'];
            $thumbnail = $file->getClientOriginalName();
            $file->storeAs('public/learninglog/thumbnail',$thumbnail);
           
        }
        if($data['attachment']){
         
            $path = storage_path("app/public/learninglog/attachment" .$data['attachment']);
            
            if(File::exists($path)){
                
                File::delete(storage_path('app/public/learninglog/attachment'.$data['attachment']));
    
            }
            
            $file = $data['attachment'];
            $attachment = $file->getClientOriginalName();
            $file->storeAs('public/learninglog/attachment/',$attachment);
           
        }
       
        return LearningLog::create([
            'title'                 => $data['title'],
            'project'               => $data['project'],
            'project_type'          => $data['project_type'],
            'research_type'         => $data['research_type'],
            'province'              => $data['province'],
            'district'              => $data['district'],
            'status'                => $data['status'],
            'description'           => $data['description'],
            'theme'                 => $data['theme'],
            'thumbnail'             => $thumbnail ?? '',
            'attachment'            => $attachment ?? '',
            'created_by'            => auth()->user()->id,
        ]);
    }

    public function findlog($id)
    {
        return LearninLog::find($id);
    }

    public function updatelearninglog($data, $id)
    {
       $log = LearningLog::where('id',$id)->first();
        return LearningLog::where('id',$id)->update([
            'title'                 => $data['title'],
            'project'               => $data['project'],
            'project_type'          => $data['project_type'],
            'research_type'         => $data['research_type'],
            'theme'                 => $data['theme'],
            'province'              => $data['province'],
            'district'              => $data['district'],
            'status'                => $data['status'],
            'description'           => $data['description'],
            'thumbnail'             => $data['thumbnail'] ?? $log->thumbnail,
            'attachment'            => $data['attachment'] ?? $log->attachment,
            'updated_by'            => auth()->user()->id,
        ]);
    }

}
