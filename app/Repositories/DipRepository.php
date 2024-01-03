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
            'partner'               => json_encode($data['partner']),
            'project'               => $data['project'],
            'province'              => json_encode($data['province']),
            'district'              => json_encode($data['district']),
            'theme'                 => json_encode($data['theme']) ,
            'attachment'            => $attachment ?? '',
            'created_by'            => auth()->user()->id,
        ]);
    }

    public function updatedip($data, $id)
    {
      
    }
   

}
