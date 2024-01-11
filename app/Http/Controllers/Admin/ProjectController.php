<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Models\StaffEmail;
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
        return view('admin.projects.index');
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

        if($request->project_name != null){

            $project->where('project',$request->project_name);
        }
        
        $projects =$project->limit($limit)
                                    ->orderBy($order, $dir)->get()->sortByDesc("date_visit");
		$data = array();
		if($projects){
			foreach($projects as $r){
			
                $edit_url = route('projects.edit',$r->id);
                $show_url = route('projects.show',$r->id);
             
				$nestedData['id'] = $r->id;
                $nestedData['project'] = $r->name ?? '';
                $nestedData['type'] = $r->type ?? '';
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
                $nestedData['active'] = $r->active ?? '';
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
    public function create()
    {
        addJavascriptFile('assets/js/custom/project/create.js');
        $themes = Theme::orderBy('name')->get();
        $persons = StaffEmail::orderBy('name')->get();
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

    public function show(string $id)
    {
        $project = Project::find($id);
        return view('admin.projects.show',compact('project'));
    }

    public function edit(string $id)
    {
        $project = Project::find($id);
        addJavascriptFile('assets/js/custom/project/create.js');
        return view('admin.projects.edit',compact('project'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');
    
        $Qb = $this->projectRepository->updateproject($data,$id);
        $editUrl = route('projects.index');
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }


    public function destroy(string $id)
    {
        $project = Project::find($id);
        if(!empty($project)){
            $project->delete();
            return redirect()->route('projects.index');
        }
        return redirect()->route('projects.index');
    }
}
