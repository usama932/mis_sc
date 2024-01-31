<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Models\District;
use App\Models\Province;
use App\Models\Partner;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectController extends Controller
{
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index()
    {
        $projects = Project::orderBy('name')->get();
        return view('admin.projects.index',compact('projects'));
    }

    public function get_project_index()
    {
        $projects = Project::orderBy('name')->get();
        return view('admin.projects.projectDetail_index',compact('projects'));
    }

    public function get_project_details(Request $request)
    {
        $columns = array(
			1 => 'id',
			2 => 'project',
            3 => 'partner',
            4 => 'theme',
            5 => 'province',
            6 => 'district',
            7 => 'project_start',
            8 => 'project_end',
            9 => 'project_submition',
            10 => 'attachment',
            11 => 'created_by',
            12 => 'created_at',
            13 => 'updated_by',
            14 => 'updated_at',
		);
		
		$totalData = Project::count();
       
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = Project::count();
       
		$start = $request->input('start');
		
        $project_details = Project::query();
        if($request->project != null){

            $project_details->where('id',$request->project);
        }

        $project_details =$project_details->limit($limit)->offset($start)->orderBy($order, $dir)->get();
      
		$data = array();
		if($project_details){
			foreach($project_details as $r){
			
                $edit_url = route('project.detail',$r->id);
                $show_url = route('projects.show',$r->id);
             
				$nestedData['id'] = $r->id;
                $nestedData['project'] = $r->name ?? '';
                $nestedData['sof'] = $r->sof ?? '';
                if(!empty($r->detail->province )){
                    $province_dip = json_decode($r->detail->province , true);
                    $provinces = Province::whereIn('province_id', $province_dip)->pluck('province_name');
                }
                else{
                    $provinces = '';
                }
                $nestedData['province'] = $provinces ?? '';
                if(!empty($r->detail->district )){
                    $district_dip = json_decode($r->detail->district , true);
                    $districts = District::whereIn('district_id', $district_dip)->pluck('district_name');
                }
                else{
                    $districts = '';
                }
                $nestedData['district'] = $districts ?? '';
               
             
                if($r->start_date != null && $r->end_date != null){
                    $nestedData['project_tenure'] = date('d-M-Y', strtotime($r->start_date)) .' To '.date('d-M-Y', strtotime($r->end_date));
                }
                else{
                    $nestedData['project_tenure'] ='' ;
                }      
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
                if(empty($r->detail)){
                    $nestedData['action'] = '<div>
                                                <td>
                                                <a class="btn btn-primary btn-sm" href="'. $edit_url .'" target="_blank" style="font-size: 0.8em; font-weight: bold; padding: 6px 10px;">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Add Detail
                                                </a>
                                                </td>
                                            </div>';
                }else{
                    $nestedData['action'] = '<div>
                    <td>
                        <a class="btn-icon mx-1" href="'. $show_url.'" target="_blank">
                        <i class="fa fa-eye text-success" aria-hidden="true" ></i>
                        </a>
                        <a class="btn-icon mx-1" href="'. $edit_url.'" target="_blank">
                            <i class="fa fa-pencil text-warning" aria-hidden="true" ></i>
                        </a>
                        <a class="btn-icon mx-1" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </a>
                    </a>
                    </td>
                    </div>
                    ';
                }
               
               
				
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
    public function get_projects(Request $request)
    {
       
        $columns = array(
			1 => 'id',
			2 => 'project',
            3 => 'type',
            4 => 'start_date',
            5 => 'end_date',
            6 => 'status',
            7 => 'active',
            11 => 'created_by',
            12 => 'created_at',
            13 => 'updated_by',
            14 => 'updated_at',
            
		);
		
		$totalData = Project::count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = Project::count();
		$start = $request->input('start');
		
        $project = Project::query();

        if($request->project != null){

            $project->where('id',$request->project);
        }
        
        $projects =$project->offset($start)
                            ->limit($limit)->orderBy($order, $dir)->get();
		$data = array();
		if($projects){
			foreach($projects as $r){
			
                $edit_url = route('projects.edit',$r->id);
                $show_url = route('projects.show',$r->id);
             
				$nestedData['id'] = $r->id;
                $nestedData['project'] = $r->name ?? '';
                $nestedData['type'] = $r->type ?? '';
                $nestedData['sof'] = $r->sof ?? '';
                if(!empty($r->start_date)){
                    $nestedData['start_date'] = date('d-M-Y', strtotime($r->start_date)) ?? '';
                }
                else{
                    $nestedData['start_date'] =  '';
                }
                if(!empty($r->end_date)){
                    $nestedData['end_date'] = date('d-M-Y', strtotime($r->end_date)) ?? '';
                }
                else{
                    $nestedData['end_date'] =  '';
                }
                
                $nestedData['status'] = $r->status ?? '';
           
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
             
                $nestedData['action'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1" href="'. $show_url.'" target="_blank">
                                            <i class="fa fa-eye text-success" aria-hidden="true" ></i>
                                            </a>
                                            <a class="btn-icon mx-1" href="'. $edit_url.'" target="_blank">
                                                <i class="fa fa-pencil text-warning" aria-hidden="true" ></i>
                                            </a>
                                            <a class="btn-icon mx-1" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                            </a>
                                        </a>
                                        </td>
                                        </div>
                                        ';
               
				
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
    public function view_get_project(Request $request)
    {
        
    }
    public function createProject_details($id){

        $project   = Project::where('id',$id)->with('detail')->orderBy('name')->first();
        $partners   = Partner::orderBy('slug')->get();  
        $themes     = Theme::orderBy('name')->get();
        $provinces   = Province::orderBy('province_name')->get();
        if(!empty($project->detail?->district)){
            $districts   = District::whereIn('district_id', json_decode($project->detail->district))->orderBy('district_name')->get();
        }
        else{
            $districts   =  '';
        }
        $active = 'detail';    
        session(['active' => $active]);

        addJavascriptFile('assets/js/custom/dip/create.js');
        addJavascriptFile('assets/js/custom/project/projectthemeValidation.js');
        addJavascriptFile('assets/js/custom/project/projectpartnerValidation.js');
        addVendors(['datatables']);
        return view('admin.projects.updateprojectdetail',compact('project','partners','themes','provinces','districts'));
    }
    public function create()
    {
        addJavascriptFile('assets/js/custom/project/create.js');
        $themes = Theme::orderBy('name')->get();
        $persons = User::role('focal person')->get();
        return view('admin.projects.create',compact('themes','persons'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $this->projectRepository->storeproject($data);
        
        $editUrl = route('projects.index');
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }
    
    public function project_update(Request $request)
    {
       
        $data = $request->except('_token');
        
        $project = $this->projectRepository->updateproject($data);

        $active = 'detail';
        session(['active' => $active]);
        
        return response()->json([
            'message' => "Project Detail Update Successfully",
            'error' => "true"
        ]);
    }

    public function show(string $id)
    {
        $project = Project::with('detail')->find($id);

        $provinces = [];
        $districts = "";
        if($project->detail?->district != null) {
            $district_project = json_decode($project->detail->district , true);
            $districts = District::whereIn('district_id', $district_project)->get();
        }
       
        if($project->detail?->province != null) {
            $province_project = json_decode($project->detail->province , true);
            $provinces = Province::whereIn('province_id', $province_project)->get();
        }
        addJavascriptFile('assets/js/custom/dip/create.js');
        addJavascriptFile('assets/js/custom/project/projectthemeValidation.js');
        addJavascriptFile('assets/js/custom/project/projectpartnerValidation.js');
        addVendors(['datatables']);
        return view('admin.projects.show',compact('project','provinces','districts'));
    }

    public function edit(string $id)
    {
        $project = Project::find($id);
        $persons = User::role('focal person')->get();

        addJavascriptFile('assets/js/custom/project/create.js');
  
       
        return view('admin.projects.edit',compact('project','persons'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');
    
        $update_project_basic = $this->projectRepository->updatebasicproject($data,$id);
        $editUrl = route('projects.index');
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }

    public function destroy(string $id)
    {
        $project = Project::with('themes','partners','detail')->find($id);
        if(!empty($project)){
            $project->delete();
            return redirect()->route('projects.index');
        }else{
            return redirect()->route('projects.index');
        }
        
    }

  
}
