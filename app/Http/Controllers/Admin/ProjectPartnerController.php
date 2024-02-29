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
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = ProjectPartner::where('project_id',$request->project_id)->count();
		$start = $request->input('start');	
        $project = ProjectPartner::where('project_id',$request->project_id);

        $projects =$project->offset($start)
                            ->limit($limit)->orderBy($order, $dir)->get();
		$data = array();

		if($projects){
			foreach($projects as $r) {
                $edit_url = route('projects.edit', $r->id);
                $show_url = route('projects.show', $r->id);
                $nestedData['id'] = $r->id;
                $nestedData['project'] = $r->project?->name ?? '';
                $nestedData['themes'] = $r->scisubtheme_name?->name ?? '';
                $nestedData['partner'] = $r->partner_name?->slug ?? '';
                $nestedData['email'] = $r->email ?? '';
                $nestedData['province'] = $r->provinces->province_name ?? '';
                $nestedData['district'] = $r->districts?->district_name ?? '';
            
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
        $id  =    $request->id;
        $partner =  ProjectPartner::find($id);
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
      
        $project_partner = ProjectPartner::where('project_id' ,$request->project)->where('partner_id' ,$request->partner)->first();
        if(!empty($project_partner)){
          
            return response()->json([
                'message' => "Duplicate Partner ",
                'error' => "true"
            ]);
        }
        else{
            $data = $request->except('_token');
            $projectpartner = $this->projectRepository->storeprojectpartner($data);
            
            $active = 'partner';
            session(['project' => $active]);
            $editUrl = route('project.detail',$projectpartner->project_id);
            return response()->json([
                'message' => "Partner Added",
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
        $project_partner->delete();
        
        $active = 'partner';
        session(['active' => $active]);
        return response()->json([
            'message' => "Project Theme Deleted",
            'error' => "true"
        ]);
    }
}
