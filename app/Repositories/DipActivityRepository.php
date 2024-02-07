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
       
        $activity =  DipActivity::create([
            'activity_number'      => $data['activity'],
            'lop_target'           => $data['lop_target'],
            'project_id'           => $data['project_id'],
            'created_by'           => auth()->user()->id,
        ]);
      
        foreach($data['quarter']  as $key => $q){
           
            foreach($data['target_quarter']  as $k => $t){
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
