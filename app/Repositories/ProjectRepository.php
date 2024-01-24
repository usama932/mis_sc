<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectPartner;
use App\Models\ProjectTheme;
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
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'active'                =>  '1',
            'created_by'            => auth()->user()->id,
        ]); 
       

    }

    public function updateproject($data)
    { 
        if(!empty($data['partner_email'])){
            foreach($data['partner_email'] as $key => $email){
                $emails =  ProjectPartner::where('project_id',$data['project'])->get();

                if(!empty($emails)) {
                    ProjectPartner::where('project_id', $data['project'])->delete();
                }

                $partner_emails =  ProjectPartner::create([
                    'partner_id'    =>  $key,
                    'email'         =>  $email,
                    'project_id'    =>  $data['project'],
                ]);
            }  
        }
        if(!empty($data['theme_targets'])){
            foreach($data['theme_targets'] as $key => $target){
                $themes =  ProjectTheme::where('project_id',$data['project'])->get();

                if (!empty($themes)) {
                    ProjectTheme::where('project_id', $data['project'])->delete();
                }

                $project_theme =  ProjectTheme::create([
                    'theme_id'      =>  $key,
                    'targets'       =>  $target,
                    'project_id'    =>  $data['project'],
                ]);
            }  
        }
        if($data['attachment']){
            $path = storage_path("app/public/project/attachment" .$data['attachment']);
            
            if(File::exists($path)){  
                File::delete(storage_path('app/public/project/attachment'.$data['attachment']));
            }
            
            $file = $data['attachment'];
            $attachment = $file->getClientOriginalName();
            $file->storeAs('public/project/attachment/',$attachment);
           
        }
        
        $project_details = ProjectDetail::create([ 
            'province'               => json_encode($data['province']),
            'district'               => json_encode($data['district']),
            'total_targets'          => $data['total_targets'],
            'male_targets'           => $data['male_targets'],
            'female_targets'         => $data['female_targets'],
            'boys_targets'           => $data['boys_targets'],
            'girls_targets'          => $data['girls_targets'],
            'hh_targets'             => $data['hh_targets'],
            'project_description'    => $data['project_description'],
            'individual_targets'     => $data['individual_targets'],
            'attachement'            => $data['attachement'] ?? '',
            'created_by'             => auth()->user()->id,
            'project_id'             => $data['project'],
        ]);

        return $project_details;
         
    }
    public function updatebasicproject($data,$id)
    { 
        return Project::where('id',$id)->update([
            'name'                  => $data['name'],
            'type'                  => $data['type'],
            'sof'                   => $data['sof'],
            'focal_person'          => $data['focal_person'],
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'active'                =>  '1',
            'updated_by'            => auth()->user()->id,
        ]); 
       
    }
}
