<?php
namespace App\Repositories;

use App\Repositories\Interfaces\DipActivityInterface;
use App\Models\DipActivity;
use App\Models\ActivityMonths;


class DipActivityRepository implements DipActivityInterface
{
    public function storedipactivity($data)
    { 
      
        $activity =  DipActivity::create([
            'activity_number'      => $data['activity'],
            'lop_target'           => $data['lop_target'],
            'project_id'           => $data['project_id'],
            'created_by'           => auth()->user()->id,
        ]);
      
        foreach($data['quarter']  as $key => $q){
           
            foreach($data['target_quarter']  as $k => $t){
                
                if($k == $key){
                    if($t != null && $q != null){
                        
                        ActivityMonths::create([
                            'project_id'     => $data['project_id'],
                            'activity_id'    =>$activity->id,
                            'month'          =>$q,
                            'target'         =>$t,
                            'created_by'     => auth()->user()->id,
                        ]);
                    }
                }
            }
        }
        return $activity;
    }

    public function updatedipactivity($data, $id)
    {
        $q = ActivityMonths::where('activity_id',$id)->delete();
     
        foreach($data['quarter']  as $key => $q){
            foreach($data['target_quarter']  as $k => $t){
                if($k == $key){
                    if($t != null && $q != null){
                      
                        $activity = ActivityMonths::create([
                            'project_id'     => $data['project_id'],
                            'activity_id'    => $data['activity_id'],
                            'month'          => $q,
                            'target'         => $t,
                            'created_by'     => auth()->user()->id,
                        ]);
                    }
                }
            }
        }
        return $activity;
    }

}
