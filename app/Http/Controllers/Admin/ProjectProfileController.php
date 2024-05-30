<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProjectProfile; 
use App\Models\District;
use App\Models\Province;
use App\Models\Tehsil;
use App\Models\UnionCounsil;
use App\Models\Project;

class ProjectProfileController extends Controller
{
    public function index()
    {
        //
    }

    public function profile_detail(Request $request){
        $id                 = $request->id;
        $profile            = ProjectProfile::find($id);

        $district_logs      = json_decode($profile->districts , true);
        $tehsil_logs        = json_decode($profile->tehsils , true);
        $uc_logs            = json_decode($profile->ucs , true);
     
        $districts          = District::whereIn('district_id', $district_logs)->pluck('district_name')->toArray();
        $tehsils            = Tehsil::whereIn('id', $tehsil_logs)->pluck('tehsil_name')->toArray();
        $ucs                = UnionCounsil::whereIn('union_id', $uc_logs)->pluck('uc_name')->toArray();
      
        return view('admin.projects.partials.view_profile_detail',compact('profile','districts','tehsils','ucs'));
    }
    public function project_profile(Request $request){
        $columns = array(
			1  => 'id',
			2  => 'partner_id',
            3  => 'project_id',
            4  => 'email',
            5  => 'district',
            6  => 'themes',
            7  => '	province',
            8 => 'created_at',
            9 => 'updated_by',
            10 => 'updated_at',
            
		);
		
		$totalData = ProjectProfile::where('project_id',$request->project_id)->count();
		$limit = $request->input('length');
        // $orderIndex = $request->input('order.0.column');
        // if (isset($columns[$orderIndex])) {
        //     $order = $columns[$orderIndex];
        // } else {
            
        //     $order = 'id'; 
        // }
        // $dir = $request->input('order.0.dir');
        $totalFiltered = ProjectProfile::where('project_id',$request->project_id)->count();
		$start = $request->input('start');	
        $profiles = ProjectProfile::where('project_id',$request->project_id);

        $profiles =$profiles->orderBy('created_at')->get();
		$data = array();

		if($profiles){
			foreach($profiles as $r) {
                $edit_url = route('edit_project_profile',$r->id);
                $nestedData['id']       = $r->id;
                $nestedData['project']  = $r->project?->name ?? '';
                $nestedData['theme']    = $r->theme?->name ?? '';
                $district_logs          = json_decode($r->districts , true);
                $tehsil_logs            = json_decode($r->tehsils , true);
                $uc_logs                = json_decode($r->ucs , true);

             
                $districts  = District::whereIn('district_id', $district_logs)
                                            ->pluck('district_name')
                                            ->toArray();
                $provinceIds = District::whereIn('district_id', $district_logs)
                ->pluck('provinces_id')
                ->unique()
                ->toArray();
                $province = Province::whereIn('province_id',$provinceIds)->pluck('province_name')->toArray();
                $tehsils    = Tehsil::whereIn('id', $tehsil_logs)->pluck('tehsil_name')->toArray();;
                $ucs        = UnionCounsil::whereIn('union_id', $uc_logs)->pluck('uc_name')->toArray();
                $districtsString = implode(', ', $districts);
                $tehsilsString = implode(', ', $tehsils);
                $ucsString = implode(', ', $ucs);
                $provinceString = implode(', ', $province);
                $nestedData['province'] = '<li><strong>'.$provinceString.'</strong>';
                $nestedData['district'] = '<li><strong>'.'District'.':</strong> '.($districtsString ?? ''). 
                '</li><li><strong>'.'Tehsils'.':</strong> '.($tehsilsString ?? ''). '</li>
                <li><strong>'.'UC'.':</strong> '.($ucsString ?? '') . '</li>
                <li><strong>'.'Villages'.':</strong> '.($r->village ?? '') . '</li>
                </li>
                <li><strong>'.'Detail'.':</strong> '.($r->detail ?? '') . '</li><br>';

                // $nestedData['tehsil'] =  $tehsils  ?? '';
                // $nestedData['uc'] =  $ucs ?? '';
                // $nestedData['village'] = $r->village ?? '';
                $nestedData['action'] = '<div>
                    <td>
                        <a class="btn-icon mx-1" title="Edit project theme"  title="Edit project theme" href="' .$edit_url. '">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                        </a>
                        <a class="btn-icon mx-1" onclick="event.preventDefault(); project_profiledel('.$r->id.');" title="Delete project theme" href="javascript:void(0)">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </a>
                    </td>
                </div>';
                                    // <a class="btn   btn-clean btn-icon" onclick="event.preventDefault();view('.$r->id.');" title="View Project Profile Detail" href="javascript:void(0)">
                        //     <i class="fa fa-eye" aria-hidden="true"></i>
                        // </a>
                $data[] = $nestedData;
            }
			
		}
		
		$json_data = array(
			"draw"			=> intval($request->input('draw')),
			"recordsTotal"	=> intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			=> $data
		);
        echo json_encode($json_data);
    }
    public function edit_project_profile(Request $request){
        $id = $request->id;
        $profile = ProjectProfile::find($id);
        $project = Project::where('id', $profile->project_id)->with('detail')->orderBy('name')->first();
        
        if (!empty($project->detail?->district)) {
            $districts = District::whereIn('district_id', json_decode($project->detail->district))->orderBy('district_name')->get();
        } else {
            $districts = [];
        }
        
        $district_logs = json_decode($profile->districts, true);
        $profiledistricts = District::whereIn('district_id', $district_logs)->get();
        $tehsil_logs = json_decode($profile->tehsils, true);
        $tehils = Tehsil::whereIn('id', $tehsil_logs)->get();
        $uc_logs = json_decode($profile->ucs, true);
        $ucs = UnionCounsil::whereIn('union_id', $uc_logs)->get();
        addJavascriptFile('assets/js/custom/project/editProjectprofile.js');
        
        return view('admin.projects.partials.edit_profile', compact('project','ucs','tehils','profile', 'districts', 'profiledistricts'));
    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
    
        $project_profile = ProjectProfile::where('project_id' ,$request->project)->where('theme_id' ,$request->ptheme)->first();
        if(!empty($project_profile)){
            return response()->json([
                'message' => "Project Profile already exist",
                'error' => "true"
            ]);
        }
        else{
            ProjectProfile::create([
                'project_id' => $request->project,
                'theme_id' => $request->ptheme,
                'districts' => json_encode($request->district),
                'tehsils' =>json_encode($request->tehsil),
                'village' => $request->village,
                'ucs' => json_encode($request->uc),
                'detail' => $request->detail,
            ]);
            $active = 'profile';
            session(['project' => $active]);
            $editUrl = route('project.detail',$request->project);
            
            return response()->json([
                'message' => "submitted Sucessfully",
                'editUrl' => $editUrl,
                'error' => "false"
            ]);
        
          
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $project_profile = ProjectProfile::where('project_id' ,$request->project)->where('id' ,$id)->first();
       
        ProjectProfile::where('id' ,$id)->update([
            'project_id' => $request->project,
            'theme_id' => $project_profile->theme_id,
            'districts' => json_encode($request->district),
            'tehsils' =>json_encode($request->tehsil),
            'village' => $request->village,
            'ucs' => json_encode($request->uc),
            'detail' => $request->detail,
        ]);
        $active = 'profile';
        session(['project' => $active]);
        $editUrl = route('project.detail',$request->project);
        
        return response()->json([
            'message' => "submitted Sucessfully",
            'editUrl' => $editUrl,
            'error' => "false"
        ]);
    }

    public function destroy(string $id)
    {
        $ProjectProfile = ProjectProfile::where('id' ,$id)->first();
        $ProjectProfile->delete();
        $active = 'profile';
        session(['active' => $active]);
        return response()->json([
            'message' => "Project Profile Deleted",
            'error' => "true"
        ]);
    }
}
