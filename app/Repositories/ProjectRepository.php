<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectPartner;
use App\Models\ProjectTheme;
use App\Mail\DipPartnerEmailMail;
use Illuminate\Support\Facades\Mail;
use File;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function storeproject($data)
    {
        return Project::create([
            'name'                  => $data['name'],
            'type'                  => $data['type'],
            'sof'                   => $data['sof'],
            'status'                => 'Initiative',
            'active'                => 1,
            'focal_person'          => $data['focal_person'],
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'active'                =>  '1',
            'created_by'            => auth()->user()->id,
        ]); 
       

    }

    public function updateproject($data)
    { 
        $project = ProjectDetail::where('project_id',$data['project'])->first();
        if(!empty($data['project'])){
            $project_details = ProjectDetail::where('project_id',$data['project'])->update([ 
                'province'               => json_encode($data['province']),
                'district'               => json_encode($data['district']),
                'project_description'    => $data['project_description'],
                'project_id'             => $data['project'],
                'updated_by'             => auth()->user()->id
            ]);
        }
        else{
            $project_details = ProjectDetail::create([ 
                'province'               => json_encode($data['province']),
                'district'               => json_encode($data['district']),
                'project_description'    => $data['project_description'],
                'project_id'             => $data['project'],
                'created_by'             => auth()->user()->id
            ]);
        }

        return $project_details;
         
    }
    public function updatebasicproject($data,$id)
    { 
        
        if($data['project_extended'] == 'on'){
            $extended = 1;
            
        }else{
            $extended = 0;
        }
        if($data['active'] == 'on'){

            $active = 1;
        }else{
            $active = 0;
        }
        return Project::where('id',$id)->update([
            'name'                  => $data['name'],
            'type'                  => $data['type'],
            'sof'                   => $data['sof'],
            'focal_person'          => $data['focal_person'],
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'active'                => $active,
            'updated_by'            => auth()->user()->id,
        ]); 
       
    }
    public function storeprojecttheme($data){
        return ProjectTheme::create([
            'theme_id'              => $data['theme'],
            'project_id'            => $data['project'],
            'girls_target'          => $data['girls_target'],
            'boys_target'           => $data['boys_target'],
            'men_target'            => $data['men_target'],
            'women_target'          => $data['women_target'],
            'pwd_target'            => $data['pwd_target'],
            'house_hold_target'     => $data['house_hold_target'],
            'individual_target'     => $data['individual_target'],
            'created_by'            => auth()->user()->id,
        ]); 
    }
    public function storeprojectpartner($data){

        $details = [
            'title' => 'Save the children',
           
           
        ];
        Mail::to($data['email'])->send(new \App\Mail\partnerMail($details));
        return ProjectPartner::create([
            'partner_id'        => $data['partner'],
            'project_id'        => $data['project'],
            'email'             => $data['email'],
            'district'          => $data['district'],
            'themes'            => $data['theme'],
            'province'          => $data['province'],
            'created_by'        => auth()->user()->id,
        ]); 
    }
}
