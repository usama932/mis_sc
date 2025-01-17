<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectPartner;
use App\Models\ProjectTheme;
use App\Models\Project;
use App\Models\Province;
use App\Models\Partner;
use App\Models\District;
use App\Models\SCITheme;
use App\Models\SciSubTheme;
use App\Models\User;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectPartnerController extends Controller
{
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    public function index()
    {
        //
    }
    public function project_partners(Request $request){
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
		
		$totalData = ProjectPartner::where('project_id',$request->project_id)->count();
		$limit = $request->input('length');
        // $orderIndex = $request->input('order.0.column');
        // if (isset($columns[$orderIndex])) {
        //     $order = $columns[$orderIndex];
        // } else {
            
        //     $order = 'id'; // Or any other default column name
        // }
        // $dir = $request->input('order.0.dir');
        $totalFiltered = ProjectPartner::where('project_id',$request->project_id)->count();
		$start = $request->input('start');	
        $project = ProjectPartner::where('project_id',$request->project_id);

        $projects =$project->orderBy('created_at')->get();
		$data = array();

		if($projects){
			foreach($projects as $r) {
                $edit_url = route('projects.edit', $r->id);
                $show_url = route('projects.show', $r->id);
                $nestedData['id'] = $r->id;
                $nestedData['project'] = $r->project?->name ?? '';
                $subth = [];
                $mainth = [];
                foreach($r->partnertheme as $theme){
                    $th = SciSubTheme::where('id',$theme->theme_id)->first();
                    $subth[] = $th->name;
                    $mainth[] = $th->maintheme?->name;
                    $maintheme = array_values(array_unique($mainth));
                   
                }
                $nestedData['themes'] = $maintheme ?? '';

                $nestedData['sub_themes'] = $subth ?? '';
                $nestedData['partner'] = $r->partner_name?->slug ?? '';
                $nestedData['email'] = $r->email ?? '';
                $prov = []; 
                foreach($r->provincedistrict as $p){
                    $pro = Province::where('province_id',$p->province_id)->first();
                    $prov[] = $pro->province_name;
                    $province = array_values(array_unique($prov));
                }
                $district = [];
                foreach($r->provincedistrict as $d){
                    $dis = District::where('district_id',$d->district_id)->first();
                    $district[] = $dis->district_name;
                }
                $nestedData['province'] =  $province ?? '';
                $nestedData['district'] =  $district ?? '';
            
                $nestedData['action'] = '<div>
                    <td>
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
    public function edit_project_partner(Request $request){
        $id         = $request->id;
        $partner    = ProjectPartner::find($id);
        $partners   = Partner::orderBy('slug')->get(); 
        $project    = Project::where('id',$partner->project_id)->with('detail')->orderBy('name')->first();

        if($project->detail?->province != null) {
            $province_project = json_decode($project->detail->province , true);
            $provinces = Province::whereIn('province_id', $province_project)->get();
        }else{
            $provinces   = [];
        }

        if(!empty($project->detail?->district)){
            $districts   = District::whereIn('district_id', json_decode($project->detail->district))->orderBy('district_name')->get();
        }
        else{
            $districts   = [];
        }
        
        $themes     =  $project->themes ?? '';
        return view('admin.projects.partials.edit_partner',compact('partner','themes','provinces','districts','partners'));
    }
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
      
        //$project_partner = ProjectPartner::where('project_id' ,$request->project)->where('partner_id' ,$request->partner)->first();

        $data = $request->except('_token');
        $projectpartner = $this->projectRepository->storeprojectpartner($data);
        if($projectpartner == 1){
            $active = 'partner';
            session(['project' => $active]);
            $editUrl = route('project.detail',$request->project);
            return response()->json([
                'message' => "Partner Added",
                'editUrl' => $editUrl,
                'error' => "false"
            ]);
        }
        elseif($projectpartner == 0){
            
            $active = 'partner';
            session(['project' => $active]);
            $editUrl = route('project.detail',$request->project);
            return response()->json([
                'message' => "Duplicate Email Error",
                'editUrl' => $editUrl,
                'error' => "true"
            ]);
            
        }
        else{
            $active = 'partner';
            session(['project' => $active]);
            $editUrl = route('project.detail',$request->project);
            return response()->json([
                'message' => "Error occurred while processing data",
                'editUrl' => $editUrl,
                'error' => "true"
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
      
        $project_partner = ProjectPartner::where('project_id' ,$request->project)->where('partner_id' ,$id)->first();
        if(!empty($project_partner)){
            
            return response()->json([
                'message' => "Duplicate Partner Entry",
                'error' => "true"
            ]);
        }else{
           
            $data = $request->except('_token');
            $projectpartner = $this->projectRepository->updateprojectpartner($data,$id);
            $active = 'partner';
            session(['project' => $active]);
            $editUrl = route('project.detail',$request->project_id);
            return response()->json([
                'message' => "Implementing Partner Updated",
                'editUrl' => $editUrl,
                'error' => "false"
            ]);
        }
       
    }

   
    public function destroy(string $id)
    {
        $project_partner = ProjectPartner::where('id' ,$id)->first();
        if(!empty($project_partner)){
            // $user = User::where('email',$project_partner->email)->first();
            // if(!empty($user)){
            //     $user->delete();
            // }
          
            $project_partner->delete();
        }
        
        $active = 'partner';
        session(['active' => $active]);
        return response()->json([
            'message' => "Project Theme Deleted",
            'error' => "true"
        ]);
    }
}
