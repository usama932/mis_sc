<?php
namespace App\Repositories;
use App\Repositories\Interfaces\IndicatorInterface;
use App\Models\Indicator;
use App\Models\IndicatorActivities;

class IndicatorRepository implements IndicatorInterface
{
    public function createIndicator(array $data)
    {
        if(!empty($data['is_total_reach_indicator']) && $data['is_total_reach_indicator'] == 'Yes'){
            $is_total_reach_indicator = 1;
        }
        else{
          
            $is_total_reach_indicator = 0;
        }
        $indicator = Indicator::create([
            'project_id'                    => $data['project'],
            'log_frame_level'               => $data['log_frame_level'],
            'log_frame_result_statement'    => $data['log_frame_result_statement'],
            'indicator_name'                => $data['indicator_name'],
            'indicator_context_type'        => $data['indicator_context_type'],
            'is_total_reach_indicator'      => $is_total_reach_indicator,
            'unit_of_measure'               => $data['unit_of_measure'],
            'actual_periodicity'            => $data['actual_periodicity'],
            'nature'                        => $data['nature'],
            'theme'                         => json_encode($data['theme']),
            'sub_theme'                     => json_encode($data['subtheme']),
            'data_format'                   => $data['data_format'],
            'disaggregation'                => $data['disaggregation'],
            'baseline'                      => $data['baseline'],
            'annual_target'                 => $data['annual_target'],
            'quarterly_target'              => $data['quarterly_target'],
            'monthly_target'                => $data['monthly_target'],
            'overall_lop_target'            => $data['overall_lop_target'],
            "created_by"                    => auth()->user()->id,

        ]);
        return $indicator;
    }

    public function createIndicatorActivity(array $data){
        foreach($data['activities'] as $activity){
            $indicatorActivity = IndicatorActivities::create([
                'activity_id'   => $activity,
                'indicator_id'  => $data['indicatorId'],
                'created_by'    => auth()->user()->id
            ]);
        }
        return $indicatorActivity;
    }
}