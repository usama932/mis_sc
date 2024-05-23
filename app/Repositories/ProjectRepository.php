<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectPartner;
use App\Models\ProjectTheme;
use App\Models\Partner;
use App\Models\UserTheme;
use App\Models\UserProvinceDistricts;
use App\Models\User;
use App\Models\District;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\ProjectQuarter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function storeproject($data)
    {
       
        $project =  Project::create([
            'name'                  => $data['name'],
            'type'                  => $data['type'],
            'sof'                   => $data['sof'],
            'status'                => 'Initiative',
            'active'                => 1,
            'focal_person'          => json_encode($data['focal_person']),
            'budget_holder'         => json_encode($data['budget_holder']),
            'award_person'          => $data['award_person'],
            'donor'                 => $data['donor'],
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'active'                =>  '1',
            'created_by'            => auth()->user()->id,
        ]); 
       
        return $project;

    }

    public function updateproject($data)
    { 
    
        $project = ProjectDetail::where('project_id',$data['project'])->first();
        if(!empty($data['implemented_sc']) && $data['implemented_sc'] == 'on'){
            $implemented_sc = 1;
            
        }else{
            $implemented_sc = 0;
        }
       
        if(empty($project )){
            $project_details = ProjectDetail::create([ 
                'province'               => json_encode($data['province']),
                'district'               => json_encode($data['district']),
                'project_description'    => $data['project_description'],
                'project_id'             => $data['project'],
                'implemented_sc'         => $implemented_sc,
                'created_by'             => auth()->user()->id
            ]);
        }
        else{
         
            $project_details = ProjectDetail::where('project_id',$data['project'])->update([ 
                'province'               => json_encode($data['province']),
                'district'               => json_encode($data['district']),
                'project_description'    => $data['project_description'],
                'project_id'             => $data['project'],
                'implemented_sc'         => $implemented_sc,
                'updated_by'             => auth()->user()->id
            ]);
           
        }

        return $project_details;
         
    }
    public function updatebasicproject($data,$id)
    { 
        
        if(!empty($data['project_extended']) && $data['project_extended'] == 'on'){
            $extended = 1;
            
        }else{
            $extended = 0;
        }
        if(!empty($data['active']) &&  $data['active'] == 'on'){

            $active = 1;
        }else{
            $active = 0;
        }
        if(!empty($data['nce']) &&  $data['nce'] == 'on'){

            $nce = 1;
        }else{
            $nce = 0;
        }
      
        $project =  Project::where('id',$id)->update([
            'name'                  => $data['name'],
            'type'                  => $data['type'],
            'sof'                   => $data['sof'],
            'focal_person'          => $data['focal_person'],
            'budget_holder'         => $data['budget_holder'],
            'award_person'          => $data['award_person'],
            'donor'                 => $data['donor'],
            'start_date'            => $data['start_date'],
            'end_date'              => $data['end_date'],
            'active'                => $active,
            'nce'                   => $nce,
            'updated_by'            => auth()->user()->id,
        ]); 
       
        return $project;
       
    }

    public function storeprojecttheme($data){
        return ProjectTheme::create([
            'theme_id'              => $data['theme'],
            'sub_theme_id'          => $data['sub_theme'],
            'project_id'            => $data['project'],
            'girls_target'          => $data['girls_target'],
            'boys_target'           => $data['boys_target'],
            'men_target'            => $data['men_target'],
            'women_target'          => $data['women_target'],
            'pwd_target'            => $data['pwd_target'],
            'plw_target'            => $data['plw_target'],
            'other'                 => $data['other'],
            'house_hold_target'     => $data['house_hold_target'],
            'individual_target'     => $data['individual_target'],
            'created_by'            => auth()->user()->id,
        ]); 
    }

    public function storeprojectpartner($data){
      
        try {
           
            foreach($data['addmore'] as $row) {
               
                $project = Project::where('id', $data['project'])->firstOrFail();
                $partner = Partner::where('id', $data['partner'])->firstOrFail();
                
                $user = User::where('email',$row['email'])->first();
                
                if (empty($user)) {
                    $user = User::create([
                        'email' =>  $row['email'],
                        'name'  => $partner->name,
                        'password' => Hash::make('12345678'),
                        'permissions_level' => 'nation-wide',
                        'designation' => '48',
                        'status' => '1',
                        'user_type' => 'R1',
                    ]);
                    $userr = User::latest()->first();
                    $userr->assignRole("partner");
                  
                }
            
                $projectPartner = ProjectPartner::create([
                    'partner_id'      => $data['partner'],
                    'project_id'      => $data['project'],
                    'email'           => $user->email,
                    'designation'     => $row['desig'],
                    'created_by'      => auth()->user()->id,
                ]);
                //Insert themes
                foreach ($data['theme'] as $themeId) {
                    $user_theme = UserTheme::where('theme_id',$themeId)->where('user_id',$user->id)->where('partner_id',$projectPartner->id)->first();
                    if(empty($user_theme)){
                        UserTheme::firstOrCreate([
                            'theme_id' => $themeId,
                            'user_id' => $user->id,
                            'partner_id' => $projectPartner->id
                        ]);
                    }
                }
                
                foreach ($data['district'] as $districtId) {
                    $district = District::where('district_id',$districtId)->first();
                    if ($district) {
                        $user_district = UserProvinceDistricts::where('province_id',$district->provinces_id)
                        ->where('district_id',$districtId)->where('user_id',$user->id)->where('partner_id',$projectPartner->id)->first();
                        if(empty($user_district)){
                            UserProvinceDistricts::firstOrCreate([
                                'province_id' => $district->provinces_id,
                                'district_id' => $districtId,
                                'user_id' => $user->id,
                                'partner_id' => $projectPartner->id
                            ]);
                        }
                    }
                }
                $userCreatedWithinLastHour = User::where('id',$user->id)->where('created_at', '>=', Carbon::now()->subHour())->first();
                if (empty($userCreatedWithinLastHour)) {
                    $details = [
                        'title' => 'Save the children',
                        "password" => "12345678",
                        'email'   => $user->email,
                        'project' => $project->name,
                        'partner' => $partner->name
                    ];
                    Mail::to($email)->send(new \App\Mail\partnerMail($details));
                }
              
            }
            DB::commit();
            return 1;
        } 
        catch (\Exception $e) {
            $x =  $e->getMessage();
            
            DB::rollback();
                DB::rollback(); 
                return $x ;
            
        }
    }

    public function updateprojectpartner($data ,$id){
        
        $project = Project::where('id',$data['project_id'])->first();
        $partner = Partner::where('id' ,$data['partner_id'])->first();
        
        $details = [
            'title' => 'Save the children',
            "password" => "12345678",
            'email' => $data['email'],
            'project' => $project->name,
            'partner' => $partner->name
           
        ];
        Mail::to($data['email'])->send(new \App\Mail\partnerMail($details));
    
        $user = User::where('email' ,$data['email'])->first();
        if(empty($user)){
            $user = User::create([
                'name'              => $partner->name,
                'email'             => $data['email'],
                'password'          => Hash::make('12345678'),
                'permissions_level' => 'nation-wide',
                'designation'       => '48',
                'province'          => $data['province'],
                'district'          => $data['partner_district'],
                'status'            => '1',
                'user_type'         => 'R1',
              
            ]);
            $user->assignRole('partner');
        }
        return ProjectPartner::where('id',$id)->update([
            'email'             => $data['email'],
            'district'          => $data['partner_district'],
            'themes'            => $data['partner_theme'],
            'province'          => $data['province'],
            'updated_by'        => auth()->user()->id,
        ]); 
    }
}
