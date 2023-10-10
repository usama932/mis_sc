<?php
namespace App\Repositories;

use App\Repositories\Interfaces\QbRepositoryInterface;
use App\Models\QualityBench;

class QbRepository implements QbRepositoryInterface
{
    public function storeQb($data)
    {
        return QualityBench::create([
            'visit_staff_name'      => $data['visit_staff_name'],
            'date_visit'            => $data['date_visit'],
            'accompanied_by'        => $data['accompanied_by'],
            'type_of_visit'         => $data['type_of_visit'],   
            'province'              => $data['province'],
            'district'              => $data['district'],
            'tehsil'                => $data['tehsil'],
            'union_counsil'         => $data['union_counsil'],
            'village'               => $data['village'],
            'project_type'          => $data['project_type'],
            'project_name'          => $data['project_name'],
            'monitoring_type'       => $data['monitoring_type'],
            'qb_not_applicable'     => $data['qb_not_applicable'], 
            'qbs_fully_met'         => $data['qbs_fully_met'],
            'qbs_not_fully_met'     => $data['qbs_not_fully_met'],
            'score_out'             => $data['score_out'],
            'created_by'            => auth()->user()->id,
            'activity_description'  => $data['activity_description'],   
        ]);
    }

    public function findQb($id)
    {
        return Frm::find($id);
    }

    public function destroyQb($id)
    {
        $Frm = Frm::find($id);
        $Frm->delete();
    }
}
