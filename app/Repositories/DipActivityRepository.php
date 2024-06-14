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
            'activity_number'       => $data['activity_number'],
            'activity_title'        => $data['activity'],
            'lop_target'            => $data['lop_target'],
            'project_id'            => $data['project_id'],
            'activity_type_id'      => $data['activity_category'],
            'created_by'            => auth()->user()->id,
            'subtheme_id'           =>  $data['sub_theme']
        ]);
     
        foreach($data['activities']  as $key => $q){
            $parts = explode("-", $q['quarter']);
            $month = $parts[0]; // Q1
            $year = $parts[1]; 
            $target_benefit = $q['target_benefit'];
            $target_quarter = $q['target_quarter'];
            $completion_date = $q['complete_date'];
        
            ActivityMonths::create([
                'project_id'         => $data['project_id'],
                'activity_id'        => $activity->id,
                'quarter'            => $month,
                'beneficiary_target' => $target_benefit,
                'completion_date'    => $completion_date,
                'year'               => $year,
                'target'             => $target_quarter,
                'status'             => Null,
                'created_by'         => auth()->user()->id,
            ]);
        }
        
    }

    public function updatedipactivity($data, $id)
    {
   
        $activity =  DipActivity::where('id',$id)->update([
            'activity_number'       => $data['activity_number'],
            'activity_title'        => $data['activity'],
            'lop_target'            => $data['lop_target'],
            'activity_type_id'      => $data['activity_category'],
            'updated_by'            => auth()->user()->id,
        ]);
        foreach($data['activities']  as $key => $q){
        
            $target_benefit     = $q['target_benefit'];
            $target_quarter     = $q['target_quarter'];
            $completion_date    = $q['complete_date'];
            if(empty($q['id'])){
                
                $parts = explode("-", $q['quarter']);
                $month = $parts[0]; // Q1
                $year = $parts[1]; 
               
                ActivityMonths::create([
                    'project_id'         => $data['project_id'],
                    'activity_id'        => $id,
                    'quarter'            => $month,
                    'beneficiary_target' => $target_benefit,
                    'completion_date'    => $completion_date,
                    'year'               => $year,
                    'target'             => $target_quarter,
                    'status'             => "To be Reviewed",
                    'created_by'         => auth()->user()->id,
                ]);
            }else{
                $q_id = $q['id'];
                ActivityMonths::where('id',$q_id)->update([
                    'beneficiary_target' => $target_benefit,
                    'target'             => $target_quarter,
                    'updated_by'         => auth()->user()->id,
                ]);
            }
            
        }
        return $activity;
    }

}
