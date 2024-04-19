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

class ProjectProfileController extends Controller
{
    public function index()
    {
        //
    }

    public function profile_detail(Request $request){
        $id = $request->id;
        $profile = ProjectProfile::find($id);

        $district_logs = json_decode($profile->districts , true);
        $tehsil_logs       = json_decode($profile->tehsils , true);
        $uc_logs       = json_decode($profile->ucs , true);

     
        $districts  = District::whereIn('district_id', $district_logs)
                                    ->pluck('district_name')
                                    ->toArray();
        $tehsils    = Tehsil::whereIn('id', $tehsil_logs)->pluck('tehsil_name')->toArray();
        $ucs        = UnionCounsil::whereIn('union_id', $uc_logs)->pluck('uc_name')->toArray();
      
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
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = ProjectProfile::where('project_id',$request->project_id)->count();
		$start = $request->input('start');	
        $profiles = ProjectProfile::where('project_id',$request->project_id);

        $profiles =$profiles->offset($start)
                            ->limit($limit)->orderBy($order, $dir)->get();
		$data = array();

		if($profiles){
			foreach($profiles as $r) {
                $edit_url = route('projects.edit', $r->id);
                $show_url = route('projects.show', $r->id);
                $nestedData['id'] = $r->id;
                $nestedData['project'] = $r->project?->name ?? '';
                
                $nestedData['theme']  = $r->theme?->name ?? '';

                $district_logs = json_decode($r->districts , true);
                $tehsil_logs       = json_decode($r->tehsils , true);
                $uc_logs       = json_decode($r->ucs , true);

             
                $districts  = District::whereIn('district_id', $district_logs)
                                            ->pluck('district_name')
                                            ->toArray();
                $tehsils    = Tehsil::whereIn('id', $tehsil_logs)->pluck('tehsil_name')->toArray();;
                $ucs        = UnionCounsil::whereIn('union_id', $uc_logs)->pluck('uc_name')->toArray();
            
                $nestedData['district'] =  $districts ?? '';
                $nestedData['tehsil'] =  $tehsils  ?? '';
                $nestedData['uc'] =  $ucs ?? '';
                $nestedData['village'] = $r->village ?? '';
                $nestedData['action'] = '<div>
                    <td>
                        <a class="btn   btn-clean btn-icon" onclick="event.preventDefault();view('.$r->id.');" title="View Project Profile Detail" href="javascript:void(0)">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <a class="btn-icon mx-1" onclick="event.preventDefault(); project_partnerdel('.$r->id.');" title="Delete project theme" href="javascript:void(0)">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </a>
                    </td>
                </div>';
            
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
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
