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
        $projects = Project::orderBy('name')->latest()->get();

        $total_projects = Project::count();
        $humanterian = Project::where('type','Humanitarian')->count();
        $development = Project::where('type','Development')->count();
        $active = Project::where('active',1)->count();
        $inactive = Project::where('active',0)->count();
        $detail = Project::has('detail')->count();

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/project/index_script.js');
        return view('admin.projects.index',compact('projects','inactive','detail','active','development','humanterian','total_projects'));
    }

    public function get_project_index()
    {
        $projects = Project::orderBy('name')->get();

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/project/detail_index_script.js');
        return view('admin.projects.projectDetail_index',compact('projects'));
    }

    public function get_project_details(Request $request)
    {

        $meal_team = ['Meal Assistant', 'Meal Officer', 'Meal Manager', 'Meal Coordinator', 'Accountability Officer', 'MIS Manager', 'MIS Officer', 'Head of Meal', 'administrator', 'MIS Officer'];
        $limit = $request->input('length');
        $orderIndex = $request->input('order.0.column');
        $order = $columns[$orderIndex] ?? 'id';
        $dir = strtolower($request->input('order.0.dir') ?? 'asc');
        $start = $request->input('start');
        
        $userRole = Auth::user()->getRoleNames()->first();
     
        $roleMap = [
            'Meal Assistant'         => 'meal',
            'Meal Officer'           => 'meal',
            'Meal Manager'           => 'meal',
            'Meal Coordinator'       => 'meal',
            'Accountability Officer' => 'meal',
            'MIS Manager'            => 'meal',
            'MIS Officer'            => 'meal',
            'Head of Meal'           => 'meal',
            'administrator'          => 'meal',
            'focal person'           => 'f_p',
            'awards'                 => 'awards',
            'budget holder'          => 'budget_holder',
        ];
        
        $role = $roleMap[$userRole] ?? 'all';
        
        $user_id = auth()->user()->id;
        
        $user = $user_id.'';
        
        $project_details = Project::query();
      
        if ($role == 'f_p') 
        {
            $project_details->where(function ($query) use ($user) {
                $query->orWhereJsonContains('focal_person', $user);    
            });

        } 
        elseif ($role == 'meal') 
        {
          
            if (auth()->user()->user_type == 'admin') {
                $project_details->latest();
            } else {
                // Apply filtering based on province and district
                // $province = auth()->user()->province ?? '';
                // $district = auth()->user()->district ?? '';
                // $project_details->whereHas('detail', function ($query) use ($province, $district) {
                //     $query->whereJsonContains('province', $province)
                //         ->whereJsonContains('district', $district);
                // });
                $project_details->whereHas('detail')->latest();
            }
        } 
        elseif ($role == 'awards') 
        {
            $project_details->whereHas('detail')->where('award_person', $user_id);
        } 
        elseif ($role == 'budget_holder') 
        {
            $project_details->where(function ($query) use ($user) {
                $query->orWhereJsonContains('budget_holder', $user);    
            });
        }
        else{
            $project_details->whereHas('detail');
        }
        
        // Filter projects if requested
        if ($request->project !== null) {
            $project_details->where('id', $request->project);
        }
        
        // Count total records before pagination
        $totalData = $totalFiltered = $project_details->count();
        
        // Apply pagination and ordering
        $projects = $project_details->with('detail')
            ->orderBy($order, $dir)
            ->limit($limit)
            ->offset($start)
            ->latest()->get();
        
        $data = [];
        foreach ($projects as $project) {
            $text = $project->name ?? "";
            $words = str_word_count($text, 1);
            $lines = array_chunk($words, 10);
            $finalText = implode("<br>", array_map(fn($line) => implode(" ", $line), $lines));
            $nestedData['id']       = $project->id;
            $nestedData['project']  = $finalText ?? '';
            $nestedData['sof']      = $project->sof ?? '';
            $nestedData['type']     = $project->type ?? '';
            $provinces              = optional($project->detail)->province;
            $districts              = optional($project->detail)->district;
            $nestedData['province'] = $provinces ? implode("<br>", Province::whereIn('province_id', json_decode($provinces, true))->pluck('province_name')->toArray()) : '';
            $nestedData['district'] = $districts ? implode("<br>", District::whereIn('district_id', json_decode($districts, true))->pluck('district_name')->toArray()) : '';
            $nestedData['project_tenure'] = ($project->start_date && $project->end_date) ? '<span style="font-size: smaller;">' . date('M d, Y', strtotime($project->start_date)) . '<br><span class="spacer">-</span><br>' . date('M d, Y', strtotime($project->end_date)) . '</span>' : '';
            $nestedData['role']           =  $role;           
            $data[] = $nestedData;
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
      
        $columns = [
            'project', 'type', 'sof', 'donor', 'focal_person', 'budget_holder',
            'award_person', 'start_date', 'end_date', 'created_by', 'created_at'
        ];
    
        $query = Project::latest();
        $totalData = $query->count();
    
        // Apply filters
        if ($request->filled('project')) {
            $query->where('id', $request->project);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('active', $request->status);
        }
        if ($request->filled('startdate') && $request->startdate != 1) {
            $query->where('start_date', '>=', $request->startdate);
        }
        if ($request->filled('enddate') && $request->enddate != 1) {
            $query->where('end_date', '<=', $request->enddate);
        }
    
        $totalFiltered = $query->count();
    
        // Order
        $orderColumn = $columns[$request->input('order.0.column')];
        $orderDirection = $request->input('order.0.dir');
        $query->orderBy($orderColumn, $orderDirection);
    
        // Pagination and get data
        $start = $request->input('start');
        $limit = $request->input('length');
        $projects = $query->offset($start)
                         ->limit($limit)
                         ->get();
    
        // Prepare data for DataTables
        $data = [];
        foreach ($projects as $project) {
            $nestedData = [
                'id' => $project->id,
                'project' => $project->name ?? '',
                'type' => $project->type ?? '',
                'sof' => $project->sof ?? '',
                'donor' => $project->donors?->name ?? '',
                'focal_person' => $this->getUserNames($project->focal_person),
                'budgetholder' => $this->getUserNames($project->budget_holder),
                'awardsfp' => $project->awardfp?->name ?? '',
                'start_date' => $project->start_date ? date('M d,Y', strtotime($project->start_date)) : '',
                'end_date' => $project->end_date ? date('M d,Y', strtotime($project->end_date)) : '',
                'status' => $project->status ?? '',
                'created_by' => $project->user->name ?? '',
                'created_at' => ($project->created_at) ? date('M d, Y', strtotime($project->created_at)) . '<br>' . date('h:iA', strtotime($project->created_at)) : '',
                'action' => '',
                'edit_url' => route('projects.edit', $project->id),
                'show_url' => route('projects.show', $project->id),
            ];
            $data[] = $nestedData;
        }
    
        // Return JSON response for DataTables
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        ]);
    }
    protected function getUserNames($userIds)
    {
        if (!$userIds) {
            return '';
        }
        $userIdsArray = json_decode($userIds, true);
        if (!$userIdsArray) {
            return '';
        }
        $users = User::whereIn('id', $userIdsArray)->pluck('name')->toArray();
        return implode("<br>", $users);
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
        $focalperson = $project->focal_person;
        $budgetholder = $project->budget_holder;
        $focal_person = $focalperson ? implode(", ", User::whereIn('id', json_decode($focalperson, true))->pluck('name')->toArray()) : '';
        $budgetholder = $budgetholder ? implode(", ", User::whereIn('id', json_decode($budgetholder, true))->pluck('name')->toArray()) : '';
        addJavascriptFile('assets/js/custom/project/projectthemeValidation.js');
        addJavascriptFile('assets/js/custom/project/projectpartnerValidation.js');
        addJavascriptFile('assets/js/custom/project/projectprofilingValidation.js');
        addVendors(['datatables']);
       
        return view('admin.projects.updateprojectdetail',compact('focal_person','budgetholder','project_themes','project','project_partners','partners','themes','provinces','districts','ps','ths'));
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
        $focalperson = $project->focal_person;
        $budgetholder = $project->budget_holder;
        $focal_person = $focalperson ? implode(", ", User::whereIn('id', json_decode($focalperson, true))->pluck('name')->toArray()) : '';
        $budgetholder = $budgetholder ? implode(", ", User::whereIn('id', json_decode($budgetholder, true))->pluck('name')->toArray()) : '';
        return view('admin.projects.projectView',compact('project','focal_person','budgetholder','provinces','districts','project_partners','project_themes','months'));
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

        $focalperson = $project->focal_person;
        $budgetholder = $project->budget_holder;
        $focal_person = $focalperson ? implode(", ", User::whereIn('id', json_decode($focalperson, true))->pluck('name')->toArray()) : '';
        $budgetholder = $budgetholder ? implode(", ", User::whereIn('id', json_decode($budgetholder, true))->pluck('name')->toArray()) : '';
        return view('admin.projects.show',compact('project','provinces','districts','focal_person','budgetholder'));
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

        if($project->focal_person != null) {
            $focal_person = json_decode($project->focal_person , true);
            $fpersons = User::whereIn('id', $focal_person)->get();
        }else{
            $fpersons   = '';
        }
        if($project->focal_person != null) {
            $focal_person = json_decode($project->focal_person , true);
            $fpersons = User::whereIn('id', $focal_person)->get();
        }else{
            $fpersons   = '';
        }
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
