<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use App\Models\ProjectDetail;
use File;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function storeproject($data)
    {
        return Project::create([
            'name'                  => $data['name'],
            'type'                  => $data['type'],
            'sof'                   => $data['sof'],
            'focal_person'          => $data['focal_person'],
            'status'                => $data['status'],
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'active'                =>  '1',
            'created_by'            => auth()->user()->id,
        ]); 
       

    }

    public function updateproject($data)
    {
        dd($data);
        
        return ProjectDetail::create([ 
                'province'               => json_encode($data['province']),
                'district'               => json_encode($data['district']),
                'total_targets'          => $data['total_targets'],
                'male_targets'           => $data['male_targets'],
                'female_targets'         => $data['female_targets'],
                'boys_targets'           => $data['boys_targets'],
                'girls_targets'          => $data['girls_targets'],
                'hh_targets'             => $data['hh_targets'],
                'project_description'    => $data['project_description'],
                'individual_targets'     => $data['district'],
                'attachement'            => $data['attachement'],
                'attachement'            => $data['attachement'],
                'project_id'            => $data['project_id'],
                'created_by'        => auth()->user()->id,
                'project_id'        => $project->id
            
        ]);
       
         
    }

}
