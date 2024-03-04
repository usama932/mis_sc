<?php
namespace App\Repositories;

use App\Repositories\Interfaces\DipActivityInterface;
use App\Models\DipActivity;
use App\Models\ActivityMonths;
use App\Models\SCIQuarter;


class DipActivityRepository implements DipActivityInterface
{
    public function storedipactivity($data)
    { 
       
        $activity =  DipActivity::create([
            'activity_number'      => $data['activity'],
            'activity_title'      => $data['activity'],
            'lop_target'           => $data['lop_target'],
            'project_id'           => $data['project_id'],
            'created_by'           => auth()->user()->id,
            'subtheme_id'         =>  $data['sub_theme']
        ]);
        
        foreach($data['quarter']  as $key => $q){
            foreach($data['target_quarter']  as $k => $t){
                foreach($data['target_benefit']  as $tb => $b){
                    if($k == $key  && $key == $tb ){
                       
                        if($t != null && $q != null){
                            $parts = explode("-", $q);
                            $quarter = $parts[0]; // Q1
                            $year = $parts[1]; 
                            $q = SCIQuarter::where('slug',$parts[0])->first();
                            ActivityMonths::create([
                                'project_id'         => $data['project_id'],
                                'activity_id'        => $activity->id,
                                'quarter'            => $q->id,
                                'beneficiary_target' => $b,
                                'year'               => $year,
                                'target'             => $t,
                                'status'             => "To be Reviewed",
                                'created_by'         => auth()->user()->id,
                            ]);
                        }
                    }
                }
            }
        }
        return $activity;
    }

    public function updatedipactivity($data, $id)
    {
        $activity =  DipActivity::where('id',$id)->update([
            'activity_number'      => $data['activity'],
            'activity_title'      => $data['activity'],
            'lop_target'           => $data['lop_target'],
            'updated_by'           => auth()->user()->id,
        ]);
     
        return $activity;
    }

}
