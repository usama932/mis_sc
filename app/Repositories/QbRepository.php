<?php
namespace App\Repositories;

use App\Repositories\Interfaces\QbRepositoryInterface;
use App\Models\QualityBench;
use Illuminate\Support\Str;

class QbRepository implements QbRepositoryInterface
{
    public function storeQb($data)
    {
        $dip_activity_id = $data['dip_activity_id'] ?? Null;
        $qb_base_monitoring = 0;
        if(!empty($data['qb_base']) && $data['qb_base'] == 'on'){
            $qb_not_met =  $data['total_qbs'] - ($data['qbs_fully_met'] + $data['qb_not_applicable']) ;   
            $score = $data['qbs_fully_met'] /($data['total_qbs']- $data['qb_not_applicable']);
            
            $score_out = $score * 100;  
        
            if($score_out > 0 && $score_out < 50){
                $qb_status =  "Poor";
            }
            elseif($score_out >= 50 && $score_out <= 80){
                $qb_status =  "Average";
            }
            elseif($score_out > 80 && $score_out <= 95){
                $qb_status =  "Good";
            }else{
                $qb_status =  "Excellent";
            }
            $qb_base_monitoring = 1;
        }
    
        $assement_code = $data['district'].'-'.time();
        return QualityBench::create([
            'date_visit'            => $data['date_visit'],
            'assement_code'         => $assement_code,
            'qb_filledby'           => $data['qb_filledby'],
            'accompanied_by'        => $data['accompanied_by'],
            'type_of_visit'         => $data['type_of_visit'],   
            'province'              => $data['province'],
            'district'              => $data['district'],
            'tehsil'                => $data['tehsil'],
            'union_counsil'         => $data['union_counsil'],
            'village'               => $data['village'],
            'project_type'          => $data['project_type'],
            'project_name'          => $data['project_name'],
            'theme'                 => $data['theme'],
            'partner'               => $data['partner'],
            'staff_organization'    => $data['staff_organization'],
            'monitoring_type'       => $data['monitoring_type'],
            'total_qbs'             => $data['total_qbs'] ?? 0, 
            'qb_not_applicable'     => $data['qb_not_applicable'] ?? 0, 
            'qbs_fully_met'         => $data['qbs_fully_met'] ?? 0,
            'qbs_not_fully_met'     => $qb_not_met ?? 0,
            'score_out'             => $score_out ?? 0, 
            'qb_status'             => $qb_status ?? '',
            'created_by'            => auth()->user()->id,
            'qb_base_monitoring'    => $qb_base_monitoring,
            'activity_description'  => $data['activity_description'],   
            'dip_activity_id'      => $dip_activity_id
        ]);
    }
    
    public function updateQb($data,$id)
    {
        $qb = QualityBench::where('id',$id)->first();
        $dip_activity_id = $data['dip_activity_id'] ?? Null;
        if($qb->qb_base == 'on'){
            $qb_not_met =  $data['total_qbs'] - ($data['qbs_fully_met'] + $data['qb_not_applicable']) ;   
            $score = $data['qbs_fully_met'] /($data['total_qbs']- $data['qb_not_applicable']);
            
            $score_out = $score * 100;  
            //dd($score_out);
            if($score_out > 0 && $score_out < 50){
                $qb_status =  "Poor";
            }
            elseif($score_out >= 50 && $score_out <= 80){
                $qb_status =  "Average";
            }
            elseif($score_out > 80 && $score_out <= 95){
                $qb_status =  "Good";
            }else{
                $qb_status =  "Excellent";
            }
        }
    
        return QualityBench::where('id',$id)->update([
            'accompanied_by'        => $data['accompanied_by'],
            'date_visit'            => $data['date_visit'],
            'type_of_visit'         => $data['type_of_visit'],   
            'province'              => $data['province'],
            'district'              => $data['district'],
            'qb_filledby'           => $data['qb_filledby'],
            'tehsil'                => $data['tehsil'],
            'union_counsil'         => $data['union_counsil'],
            'village'               => $data['village'],
            'project_type'          => $data['project_type'],
            'project_name'          => $data['project_name'],
            'theme'                 => $data['theme'],
            'partner'               => $data['partner'],
            'staff_organization'    => $data['staff_organization'],
            'monitoring_type'       => $data['monitoring_type'],
            'total_qbs'             => $data['total_qbs'] ?? $qb->total_qbs, 
            'qb_not_applicable'     => $data['qb_not_applicable'] ?? $qb->qb_not_applicable, 
            'qbs_fully_met'         => $data['qbs_fully_met'] ?? $qb->qbs_fully_met,
            'qbs_not_fully_met'     => $qb_not_met ?? $qb->qbs_not_fully_met,
            'score_out'             => $score_out ?? $qb->score_out,
            'qb_status'             => $qb_status ?? $qb->qb_status,
            'activity_description'  => $data['activity_description'],  
            'dip_activity_id'       => $dip_activity_id,
            'updated_by'            => auth()->user()->id
        ]);
    }
    public function findQb($id)
    {
       
    }

    public function destroyQb($id)
    {
       
    }
}
