<?php
namespace App\Repositories;

use App\Repositories\Interfaces\LearningLogRepositoryInterface;
use App\Models\LearningLog;
use Illuminate\Support\Facades\File;

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

    public function updateLearningLog($data, $id)
    {
        // Retrieve the learning log by ID
        $log = LearningLog::findOrFail($id);  // Using findOrFail for better error handling
    
        // Handle thumbnail file upload if present
        if (!empty($data['thumbnail'])) {
            // Delete the existing thumbnail if it exists
            $thumbnailPath = storage_path("app/public/learninglog/thumbnail/" . $log->thumbnail);
            if (File::exists($thumbnailPath)) {
                File::delete($thumbnailPath);
            }
    
            // Store the new thumbnail file
            $file = $data['thumbnail'];
            $thumbnail = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/learninglog/thumbnail', $thumbnail);
        } else {
            // If no new thumbnail is provided, keep the existing one
            $thumbnail = $log->thumbnail;
        }
    
        // Handle attachment file upload if present
        if (!empty($data['attachment'])) {
            // Delete the existing attachment if it exists
            $attachmentPath = storage_path("app/public/learninglog/attachment/" . $log->attachment);
            if (File::exists($attachmentPath)) {
                File::delete($attachmentPath);
            }
    
            // Store the new attachment file
            $file = $data['attachment'];
            $attachment = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/learninglog/attachment', $attachment);
        } else {
            // If no new attachment is provided, keep the existing one
            $attachment = $log->attachment;
        }
    
        // Update the learning log record with the provided data
        $log->update([
            'title'                 => $data['title'],
            'project'               => $data['project'] ?? $log->project,
            'project_type'          => $data['project_type'] ?? $log->project_type,
            'research_type'         => $data['research_type'] ?? $log->research_type,
            'theme'                 => isset($data['theme']) ? json_encode($data['theme']) : $log->theme,
            'province'              => isset($data['province']) ? json_encode($data['province']) : $log->province,
            'district'              => isset($data['district']) ? json_encode($data['district']) : $log->district,
            'status'                => $data['status'] ?? $log->status,
            'description'           => $data['description'] ?? $log->description,
            'thumbnail'             => $thumbnail,
            'attachment'            => $attachment,
            'updated_by'            => auth()->user()->id,
        ]);
    
        return $log;  // Return the updated log
    }
    

}
