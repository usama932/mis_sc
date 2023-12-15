<?php
namespace App\Repositories;

use App\Repositories\Interfaces\DipRepositoryInterface;
use App\Models\Dip;
use File;

class DipRepository implements DipRepositoryInterface
{
    public function storedip($data)
    {
        
       
        if($data['attachment']){
         
            $path = storage_path("app/public/dip/attachment" .$data['attachment']);
            
            if(File::exists($path)){
                
                File::delete(storage_path('app/public/dip/attachment'.$data['attachment']));
    
            }
            
            $file = $data['attachment'];
            $attachment = $file->getClientOriginalName();
            $file->storeAs('public/dip/attachment/',$attachment);
           
        }
        
        return Dip::create([
            'partner'               => $data['partner'],
            'project'               => $data['project'],
            'theme'                 => $data['theme'],
            'project_start_date'    => $data['project_start_date'],
            'province'              => json_encode($data['province']),
            'district'              => json_encode($data['district']),
            'project_end_date'      => $data['project_end_date'],
            'project_start_date'    => $data['project_start_date'],
            'theme'                 => json_encode($data['theme']) ,
            'thumbnail'             => $thumbnail ?? '',
            'attachment'            => $attachment ?? '',
            'created_by'            => auth()->user()->id,
        ]);
    }

    public function updatedip($data, $id)
    {
       $log = LearningLog::where('id',$id)->first();
       if(!empty($data['thumbnail'])){
         
        $path = storage_path("app/public/learninglog/thumbnail" .$data['thumbnail']);
        
        if(File::exists($path)){
            
            File::delete(storage_path('app/public/learninglog/thumbnail'.$data['thumbnail']));

        }
        
        $file = $data['thumbnail'];
        $thumbnail = $file->getClientOriginalName();
        $file->storeAs('public/learninglog/thumbnail',$thumbnail);
       
    }
    if(!empty($data['attachment'])){
     
        $path = storage_path("app/public/learninglog/attachment" .$data['attachment']);
        
        if(File::exists($path)){
            
            File::delete(storage_path('app/public/learninglog/attachment'.$data['attachment']));

        }
        
        $file = $data['attachment'];
        $attachment = $file->getClientOriginalName();
        $file->storeAs('public/learninglog/attachment/',$attachment);
       
    }
        return LearningLog::where('id',$id)->update([
            'title'                 => $data['title'],
            'project'               => $data['project'],
            'project_type'          => $data['project_type'],
            'research_type'         => $data['research_type'],
            'theme'                 => json_encode($data['theme']),
            'province'              => json_encode($data['province']),
            'district'              => json_encode($data['district']),
            'status'                => $data['status'],
            'description'           => $data['description'],
            'thumbnail'             => $data['thumbnail'] ?? $log->thumbnail,
            'attachment'            => $data['attachment'] ?? $log->attachment,
            'updated_by'            => auth()->user()->id,
        ]);
    }

}
