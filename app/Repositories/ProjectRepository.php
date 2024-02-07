<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectPartner;
use App\Models\ProjectTheme;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


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
   
        if(empty($project )){
            
            $project_details = ProjectDetail::create([ 
                'province'               => json_encode($data['province']),
                'district'               => json_encode($data['district']),
                'project_description'    => $data['project_description'],
                'project_id'             => $data['project'],
                'created_by'             => auth()->user()->id
            ]);
            
        }
        else{
         
            $project_details = ProjectDetail::where('project_id',$data['project'])->update([ 
                'province'               => json_encode($data['province']),
                'district'               => json_encode($data['district']),
                'project_description'    => $data['project_description'],
                'project_id'             => $data['project'],
                'updated_by'             => auth()->user()->id
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
        $project = Project::where('id',$data['project'])->first();
        $partner = Partner::where('id' ,$data['partner'])->first();
        $details = [
            'title' => 'Save the children',
            "password" => "12345678",
            'email' => $data['email'],
            'project' => $project->name,
            'partner' => $partner->name
           
        ];
        // Mail::to($data['email'])->send(new \App\Mail\partnerMail($details));
    //  dd('sd');
        $user = User::where('email' ,$data['email'])->first();
        if(empty($user)){
            $user = User::create([
                'name'              => $partner->name,
                'email'             => $data['email'],
                'password'          => Hash::make('12345678'),
                'permissions_level' => 'nation-wide',
                'designation'       => '48',
                'province'          => $data['province'],
                'district'          => $data['district'],
                'status'            => '1',
                'user_type'         => 'R1',
              
            ]);
            $user->assignRole('partner');
        }
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
