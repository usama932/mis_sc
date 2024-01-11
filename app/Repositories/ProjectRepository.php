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
        $project = Project::create([
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
        $projectdetail = ProjectDetail::create([
            'theme'             => json_encode($data['theme']),
            'created_by'        => auth()->user()->id,
            'project_id'        => $project->id
        ]);
        return $project;

    }

    public function updateproject($data, $id)
    {
        $project = Project::where('id',$id)->first();

        Project::where('id',$id)->update([
            'name'                  => $data['name'] ??  $project->name,
            'type'                  => $data['type'] ??  $project->type,
            'sof'                   => $data['sof'] ??  $project->sof,
            'focal_person'          => $data['focal_person'] ??  $project->focal_person,
            'status'                => $data['status'] ??  $project->status,
            'start_date'            => $data['start_date'] ??  $project->start_date,
            'end_date'              => $data['end_date'] ??  $project->end_date,
            'updated_by'            => auth()->user()->id ,
        ]);
        $projectdetail = ProjectDetail::where('project_id',$project->id)->update([
            'theme'             => json_encode($data['theme']),
            'updated_by'        => auth()->user()->id,
        ]);
        return $project;
    }

}
