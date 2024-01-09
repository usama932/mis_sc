<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use File;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function storeproject($data)
    {
        return Project::create([
           
            'name'                  => $data['name'],
            'type'                  => $data['type'],
            'sof'                   => $data['sof'],
            'theme'                 => json_encode($data['theme']),
            'status'                => $data['status'],
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'active'                =>  '1',
            'created_by'            => auth()->user()->id,
        ]);
    }

    

    public function updateproject($data, $id)
    {
       $project = Project::where('id',$id)->first();

        return Project::where('id',$id)->update([
            'project'               => $data['project'],
            'sof'                   => $data['sof'],
            'theme'                 => json_encode($data['theme']),
            'type'                  => $data['type'],
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'updated_by'            => auth()->user()->id,
        ]);
    }

}
