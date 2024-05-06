<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Models\District;
use App\Models\Province;
use App\Exports\project\ExportProjectActivities;
use App\Models\Partner;
use App\Models\Donor;
use App\Models\SCITheme;
use App\Models\ProjectPartner;
use App\Models\ProjectTheme;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;

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
        $columns = [
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
        ];
        $meal_team =  ['Meal Assistant','Meal Officer','Meal Manager','Meal Coordinator','Accountability Officer','MIS Manager','MIS Officer','Head of Meal','administrator','MIS Officer'];
        $limit = $request->input('length');
        $orderIndex = $request->input('order.0.column');
        $order = $columns[$orderIndex] ?? 'id';
        $dir = strtolower($request->input('order.0.dir') ?? 'asc');
        
        $start = $request->input('start');
        
        $userType = auth()->user()->user_type;
        $user_id = auth()->user()->id;

        $userRole =  $role = Auth::user()->getRoleNames()->first();
     
        $role = '';
        if (in_array($userRole,$meal_team))
        {
           $role = 'meal';
        }elseif($userRole == "focal person"){
            $role = 'f_p';
        }
        elseif($userRole == 'awards'){
            $role = 'awards';
        }
        elseif($userRole == "budget holder"){
            $role = 'budget_holder';
        }else{
            $role = "all";
        }

        //projects 
        if ($role == 'f_p') {
           
            $project_details = Project::where('focal_person', $user_id)->latest();
        }
        elseif($role == 'meal'){
            if(auth()->user()->user_type == 'admin'){
                $project_details = Project::latest();
            }
            else{
              
                $province = auth()->user()->province.'';
                $district = auth()->user()->district.'';
                
                // $project_details = Project::latest()
                //     ->whereHas('detail', function ($query) use ($province) {
                //         $query->whereJsonContains('province', $province);
                //     })
                //     ->with('detail');
                $project_details = Project::latest()->whereHas('detail')
                    ->with('detail')->latest();
            }
        }
        elseif( $role == 'awards'){
            $project_details = Project::where('award_person', $user_id)->whereHas('detail')
            ->with('detail')->latest();
        }
        elseif($role == 'budget_holder'){
           
            $project_details = Project::where('budget_holder', $user_id)->latest()->whereHas('detail')
            ->with('detail')->latest();
        }
        else{
            $project_details = Project::latest();
        }

        //filter project
        if ($request->project !== null) {
            $project_details->where('id', $request->project);
        }
        $totalData = $project_details->count();
        $totalFiltered =$project_details->count();
        
        $project_details = $project_details->limit($limit)->offset($start)->orderBy($order, $dir)->get();
        
        $data = [];
		if($project_details){
			foreach($project_details as $r){
			
                $edit_url = route('project.detail',$r->id);
                $view_url = route('project.view',$r->id);
                $show_url = route('projects.show',$r->id);
                $projectreviews_url = route('projectreviews.show',$r->id);
				$nestedData['id'] = $r->id;
                $nestedData['project'] = $r->name ?? '';
                $nestedData['sof'] = $r->sof ?? '';
                $nestedData['type'] = $r->type ?? '';
                if(!empty($r->detail->province )){
                    $province_dip = json_decode($r->detail->province , true);
                    $provinces = Province::whereIn('province_id', $province_dip)->pluck('province_name');
                    $provinces   = implode("<br>", $provinces->toArray());
                }
                else{
                    $provinces = '';
                }
                $nestedData['province'] = $provinces ?? '';
                if(!empty($r->detail->district )){
                    $district_dip = json_decode($r->detail->district , true);
                    $districts = District::whereIn('district_id', $district_dip)->pluck('district_name');
                    $districts = implode("<br>", $districts->toArray());
                }
                else{
                    $districts = '';
                }
                $nestedData['district'] = $districts ?? '';
               
                $nestedData['project_activities'] = '<a class="btn" href="' . $view_url . '" target="_blank" title="Download project DIP">
                                                    <i class="far fa-caret-square-right text-info"></i>
                                                    </a>';
                
                 $nestedData['review_meeting'] = '<a class="btn" href="' . $projectreviews_url . '" title="Add/Show Review Meeting">
                                                <i class="far fa-calendar-alt text-info"></i>
                                                </a>';
                if($r->start_date != null && $r->end_date != null){
                    $nestedData['project_tenure'] = date('M d, Y', strtotime($r->start_date)) . '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<br>' . date('M d, Y', strtotime($r->end_date));
                }
                else{
                    $nestedData['project_tenure'] ='' ;
                }      
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] =date('M d ,Y', strtotime($r->created_at)). '<br>'. date('h:iA', strtotime($r->created_at)) ?? '';
                if(empty($r->detail )){
                $nestedData['action'] = '<div class="text-center mt-5">
                                                <td>
                                                <a class="" href="'. $edit_url .'"  style="font-size: 0.8em; font-weight: bold; padding: 6px 10px;">
                                                <span class="badge badge-primary">Add Detail</span>
                                                </a>
                                                </td>
                                            </div>';
                }else{
                    $nestedData['action'] = '<div class="text-center mt-5">
                    <td>
                        <a class="btn-icon mx-1" href="'. $show_url.'" target="_blank" title="show project">
                            <i class="far fa-eye text-success" ></i>
                        </a>';
                    if (auth()->user()->user_type != 'R3'  && auth()->user()->user_type != 'admin') {
                        '<a class="btn-icon mx-1 " href="'. $edit_url.'" title=" project edit">
                            <i class="fas fa-pencil-alt text-warning"  ></i>
                        </a>';
                    }
                    if (auth()->user()->user_type == 'admin') {
                        $nestedData['action'] .= '
                        <a class="btn-icon mx-1 " href="'. $edit_url.'" title=" project edit">
                            <i class="fas fa-pencil-alt text-warning"  ></i>
                        </a>
                            <a class="btn-icon  mx-1 " onclick="event.preventDefault();del('.$r->id.');" title="Delete Project" href="javascript:void(0)">
                                <i class="fas fa-trash-alt text-danger" ></i>
                            </a>';
                    }
                
                    $nestedData['action'] .= '</td></div>';
                }
               
               
                
				$data[] = $nestedData;
			}
		}
		
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];
        
        echo json_encode($json_data);
    }

    public function get_projects(Request $request)
    {
        $columns = array(
            0 => 'project',
            1 => 'type',
            2 => 'sof',
            3 => 'donor',
            4 => 'focal_person',
            5 => 'budget_holder',
            6 => 'award_person',
            7 => 'start_date',
            8 => 'end_date',
            9 => 'created_by',
            10 => 'created_at',
        );
        
        $totalData = Project::count();
        $limit = $request->input('length');
        $orderColumn = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');
        $order = $columns[$orderColumn];
        $totalFiltered = Project::count();
        $start = $request->input('start');
        
        $projectQuery = Project::latest();
        
        if ($request->project != null) {
            $projectQuery->where('id', $request->project);
        }
        
        if ($request->startdate != null) {
            $projectQuery->where('start_date', '>=', $request->startdate);
            if ($request->enddate != null) {
                $projectQuery->where('start_date', '<=', $request->enddate);
            }
        }
        
        if ($request->enddate != null) {
            $projectQuery->where('end_date', '<=', $request->enddate);
            if ($request->startdate != null) {
                $projectQuery->where('end_date', '>=', $request->startdate);
            }
        }
        
        $projects = $projectQuery->offset($start)
            ->limit($limit)
            ->orderBy($order, $orderDirection)
            ->get();
        
        $data = array();
        if ($projects) {
            foreach ($projects as $r) {
                $edit_url = route('projects.edit', $r->id);
                $show_url = route('projects.show', $r->id);
        
                $nestedData['id'] = $r->id;
                $nestedData['project'] = $r->name ?? '';
                $nestedData['type'] = $r->type ?? '';
                $nestedData['sof'] = $r->sof ?? '';
                $nestedData['donor'] = $r->donors?->name ?? '';
                $nestedData['focal_person'] = $r->focalperson?->name ?? '';
                $nestedData['budgetholder'] = $r->budgetholder?->name ?? '';
                $nestedData['awardsfp'] = $r->awardfp?->name ?? '';
                if (!empty($r->start_date)) {
                    $nestedData['start_date'] = date('M d,Y', strtotime($r->start_date)) ?? '';
                } else {
                    $nestedData['start_date'] = '';
                }
                if (!empty($r->end_date)) {
                    $nestedData['end_date'] = date('M d,Y', strtotime($r->end_date)) ?? '';
                } else {
                    $nestedData['end_date'] = '';
                }
        
                $nestedData['status'] = $r->status ?? '';
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('M d, Y', strtotime($r->created_at)) . '<br>' . date('h:iA', strtotime($r->created_at)) ?? '';
        
                $nestedData['action'] = '<div>
                    <td>
                        <a class="btn-icon mx-1" href="' . $show_url . '" >
                            <i class="fa fa-eye text-success" ></i>
                        </a>
                        <a class="btn-icon mx-1" href="' . $edit_url . '" target="_blank">
                            <i class="fa fa-pencil text-warning" aria-hidden="true"></i>
                        </a>
                        <a class="btn-icon mx-1" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete Monitor Visit" href="javascript:void(0)">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </a>
                    </td>
                </div>';
        
                $data[] = $nestedData;
            }
        }
        
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        
        echo json_encode($json_data);
    }
  
    public function createProject_details($id){

        $project    = Project::where('id',$id)->with('detail')->orderBy('name')->first();
        $partners   = Partner::orderBy('slug')->get();  
        $themes     =  $project->themes ?? '';
        $ths        = SCITheme::orderBy('name')->get();
        $ps         = Province::orderBy('province_name')->get();
      
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
        if(session('project') == ''){
            $active = 'detail';    
            session(['project' => $active]);
        }
        $project_partners   = ProjectPartner::where('project_id',$id)->get();  
        $project_themes   = ProjectTheme::where('project_id',$id)->get();  
        addJavascriptFile('assets/js/custom/dip/create.js');
        addJavascriptFile('assets/js/custom/project/projectthemeValidation.js');
        addJavascriptFile('assets/js/custom/project/projectpartnerValidation.js');
        addJavascriptFile('assets/js/custom/project/projectprofilingValidation.js');
        addVendors(['datatables']);
       
        return view('admin.projects.updateprojectdetail',compact('project_themes','project','project_partners','partners','themes','provinces','districts','ps','ths'));
    }

    public function project_view($id){

        $project   = Project::where('id',$id)->with('detail','activities')->orderBy('name')->first();
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
        $project_partners   = ProjectPartner::where('project_id',$id)->get();  
        $project_themes   = ProjectTheme::where('project_id',$id)->get();  

        $start_date = new DateTime($project->start_date);
        $end_date = new DateTime($project->end_date);
        
        $months = array();
        while ($start_date <= $end_date) {
            $months[] = $start_date->format('M Y'); // Add month name and year to the array
            $start_date->modify('+1 month'); // Move to the next month
        }
       
        return view('admin.projects.projectView',compact('project','provinces','districts','project_partners','project_themes','months'));
    }

    public function create()
    {
        addJavascriptFile('assets/js/custom/project/create.js');
        $themes = Theme::orderBy('name')->get();
        $persons = User::latest()->get();
        $donors = Donor::orderBy('name')->get();
        $budget_holders = User::latest()->get();
        $awards = User::with('desig')->whereHas('desig', function ($query) {
            $query->whereIn('designation_name', ['Head of Awards','Sub-Grants Coordinator', 'Manager Awards']);
        })->get();
        return view('admin.projects.create',compact('themes','persons','donors','awards','budget_holders'));
    }

    public function store(Request $request)
    {
        $project = Project::orWhere('name',$request->name)->orWhere('sof',$request->sof)->first();
        if(empty($project)){
            $data = $request->except('_token');
            $this->projectRepository->storeproject($data);
             
            $editUrl = route('projects.index');
            return response()->json([
                'editUrl' => $editUrl,
                'error' => false,
            ]);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => "Project already exist"
            ]);
        }
      
    }
    
    public function project_update(Request $request)
    {
       
        $data = $request->except('_token');
        
        $project = $this->projectRepository->updateproject($data);
       
        $project = 'thematic';
        session(['project' => $project]);
       
        $editUrl = route('project.detail',$request->project);
     
        return response()->json([
            'editUrl' => $editUrl,
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
        addJavascriptFile('assets/js/custom/project/projectprofilingValidation.js');
        addVendors(['datatables']);
        return view('admin.projects.show',compact('project','provinces','districts'));
    }

    public function edit(string $id)
    {
        $project = Project::find($id);
        $persons = User::latest()->get();
        $donors = Donor::orderBy('name')->get();
        $budget_holders = User::latest()->get();
        $awards = User::with('desig')->whereHas('desig', function ($query) {
            $query->whereIn('designation_name', ['Head of Awards','Sub-Grants Coordinator', 'Manager Awards']);
        })->get(); 

        addJavascriptFile('assets/js/custom/project/create.js');
  
       
        return view('admin.projects.edit',compact('project','persons','donors','budget_holders','awards'));
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
            $project->themes->each?->delete();
            $project->partners?->each?->delete();
            if(!empty($project->partners)){
                $project->partners->each(function ($partner) {
                    $partner->partnertheme()->delete();
                });
                $project->partners->each(function ($partner) {
                    $partner->provincedistrict()->delete();
                });
            }
            $project->detail?->delete();
            $project->activities?->each?->delete();
            $project->activity_months?->each?->delete();
            $project->progress?->each?->delete();
            $project->profile?->each?->delete();
            $project->reviews()->each(function ($review) {
                $review->action_point()->delete();
            });
            $project->reviews?->each?->delete();
            $project->delete();
            return redirect()->route('projects.index');
        }else{
            return redirect()->route('projects.index');
        }
        
    }

    public function getexport($id){

        $id = $id;
        $project = Project::find($id);
        $data =  ['id'=> $id];
        $fileName = $project->name.'activites'.'.csv';
        return Excel::download(new ExportProjectActivities($data),  $fileName);
    }
}
