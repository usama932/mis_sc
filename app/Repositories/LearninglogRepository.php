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
            $thumbnail = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/learninglog/thumbnail',$thumbnail);
           
        }
        if($data['attachment']){
         
            $path = storage_path("app/public/learninglog/attachment" .$data['attachment']);
            
            if(File::exists($path)){
                
                File::delete(storage_path('app/public/learninglog/attachment'.$data['attachment']));
    
            }
            
            $file = $data['attachment'];
            $attachment = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/learninglog/attachment/',$attachment);
           
        }

        if(!empty($data['cli']) && $data['cli'] == 'on'){
            $cli = 1;
            
        }else{
            $cli = 0;
        }
        
        return LearningLog::create([
            'title'                 => $data['title'],
            'project'               => $data['project'] ?? null,
            'project_type'          => $data['project_type'] ?? null,
            'research_type'         => $data['research_type'] ?? null,
            'province'              => json_encode($data['province'] ?? null) ,
            'district'              => json_encode($data['district']  ?? null),
            'status'                => $data['status'] ?? null,
            'description'           => $data['description'] ?? null,
            'theme'                 => json_encode($data['theme']  ?? null),
            'thumbnail'             => $thumbnail ?? '',
            'attachment'            => $attachment ?? '',
            'cli'                   => $cli,
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
        if(!empty($data['thumbnail'])){
            
            $path = storage_path("app/public/learninglog/thumbnail" .$data['thumbnail']);
            
            if(File::exists($path)){
                
                File::delete(storage_path('app/public/learninglog/thumbnail'.$data['thumbnail']));

            }
            
            $file = $data['thumbnail'];
            $thumbnail = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/learninglog/thumbnail',$thumbnail);
        
        }
        if(!empty($data['attachment'])){
        
            $path = storage_path("app/public/learninglog/attachment" .$data['attachment']);
            
            if(File::exists($path)){
                
                File::delete(storage_path('app/public/learninglog/attachment'.$data['attachment']));

            }
            
            $file = $data['attachment'];
            $attachment = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/learninglog/attachment/',$attachment);
        
        }
        return LearningLog::where('id',$id)->update([
            'title'                 => $data['title'],
            'project'               => $data['project'] ?? '',
            'project_type'          => $data['project_type'],
            'research_type'         => $data['research_type'],
            'theme'                 => json_encode($data['theme']),
            'province'              => json_encode($data['province']),
            'district'              => json_encode($data['district']),
            'status'                => $data['status'],
            'description'           => $data['description'],
            'thumbnail'             => $thumbnail ?? $log->thumbnail,
            'attachment'            => $attachment ?? $log->attachment,
            'updated_by'            => auth()->user()->id,
        ]);
    }

}
