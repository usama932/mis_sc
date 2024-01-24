<?php
namespace App\Repositories;

use App\Repositories\Interfaces\DipActivityInterface;
use App\Models\DipActivity;
use App\Models\ActivityMonths;
use File;

class DipActivityRepository implements DipActivityInterface
{
    public function storedipactivity($data)
    { 
       
        $activity_number = rand(0,999);
        
        $activity =  DipActivity::create([
            'activity_number'      => $activity_number,
            'activity_detail'      => $data['activity'],
            'project_id'           => $data['project_id'],
            'created_by'           => auth()->user()->id,
        ]);
        if(!empty($data['month']) && !empty($activity)){
           
            foreach($data['month'] as $key_month => $month){
              
                foreach($data['target_month'] as $key => $target){
                    if($key_month == $key ){
                        $activity_months =  ActivityMonths::where('activity_id',$activity->id)
                        ->where('project_id',$data['project_id'])->get();
                        if(!empty($activity_months)) {
                        ActivityMonths::where('activity_id',$activity->id)
                                        ->where('project_id',$data['project_id'])->delete();
                        }
                        $activity_month =  ActivityMonths::create([
                        'month'         =>  $month,
                        'target'        =>  $target,
                        'project_id'    =>  $data['project_id'],
                        'activity_id'   =>  $activity->id,
                        'created_by'    => auth()->user()->id,
                        ]);
                    }
                  
                }
            }  
        }else{
            $activity->delete();
        }
        return $activity;
    }

    public function updatedipactivity($data, $id)
    {
        return DipActivity::create([
            'activity_number'      => $data['activity_number'],
            'start_date'           => $data['start_date'],
            'end_date'             => $data['end_date'],
            'detail'               => $data['detail'],
            'status'               => $data['status'],
            'updated_by'           => auth()->user()->id,
        ]);
    }

}
