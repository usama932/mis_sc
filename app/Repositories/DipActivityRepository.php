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
            'activity_number'     => $data['activity'],
            'activity_title'        => $data['activity'],
            'lop_target'            => $data['lop_target'],
            'project_id'            => $data['project_id'],
            'created_by'            => auth()->user()->id,
        'subtheme_id'               =>  $data['sub_theme']
        ]);
     
        foreach($data['activities']  as $key => $q){
            $parts = explode("-", $q['quarter']);
            $quarter = $parts[0]; // Q1
            $year = $parts[1]; 
           
            $q = SCIQuarter::where('slug', $quarter)->first();
            ActivityMonths::create([
                'project_id'         => $data['project_id'],
                'activity_id'        => $activity->id,
                'quarter'            => $q->id,
                'beneficiary_target' => $q['target_benefit'],
                'year'               => $year,
                'target'             => $q['target_quarter'],
                'status'             => "To be Reviewed",
                'created_by'         => auth()->user()->id,
            ]);
        }
        // return $activity;
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
