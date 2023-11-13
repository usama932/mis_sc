<?php
namespace App\Repositories;

use App\Repositories\Interfaces\QbRepositoryInterface;
use App\Models\QualityBench;

class QbRepository implements QbRepositoryInterface
{
    public function storeQb($data)
    {
        $qb_not_met = $data['total_qbs'] - $data['qbs_fully_met'];   
        $score_out =( $data['total_qbs'] - $data['qb_not_applicable'])/$data['qbs_fully_met'];   
        return QualityBench::create([
            'visit_staff_name'      => $data['visit_staff_name'],
            'date_visit'            => $data['date_visit'],
            'qb_filledby'           => $data['qb_filledby'],
            'sub_theme'             => $data['sub_theme'],
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
            'total_qbs'             => $data['total_qbs'], 
            'qb_not_applicable'     => $data['qb_not_applicable'], 
            'qbs_fully_met'         => $data['qbs_fully_met'],
            'qbs_not_fully_met'     => $qb_not_met,
            'score_out'             => $score_out,
            'created_by'            => auth()->user()->id,
            'activity_description'  => $data['activity_description'],   
        ]);
    }
    public function updateQb($data,$id)
    {
        $qb_not_met =  ($data['total_qbs'] + $data['qb_not_applicable']) - $data['qbs_fully_met'] ;   
        $score_out =( $data['total_qbs'] - $data['qb_not_applicable'])/$data['qbs_fully_met'];
        return QualityBench::where('id',$id)->update([

            'accompanied_by'        => $data['accompanied_by'],
            'date_visit'            => $data['date_visit'],
            'type_of_visit'         => $data['type_of_visit'],   
            'province'              => $data['province'],
            'district'              => $data['district'],
            'qb_filledby'           => $data['qb_filledby'],
            'sub_theme'             => $data['sub_theme'],
            'tehsil'                => $data['tehsil'],
            'union_counsil'         => $data['union_counsil'],
            'village'               => $data['village'],
            'project_type'          => $data['project_type'],
            'project_name'          => $data['project_name'],
            'theme'                 => $data['theme'],
            'partner'               => $data['partner'],
            'staff_organization'    => $data['staff_organization'],
            'monitoring_type'       => $data['monitoring_type'],
            'total_qbs'             => $data['total_qbs'], 
            'qb_not_applicable'     => $data['qb_not_applicable'], 
            'qbs_fully_met'         => $data['qbs_fully_met'],
            'qbs_not_fully_met'     => $qb_not_met,
            'score_out'             => $score_out,
            'activity_description'  => $data['activity_description'],   
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
