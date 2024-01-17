<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LearningLog;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Theme;
use App\Models\District;
use App\Models\Province;
use App\Repositories\Interfaces\LearningLogRepositoryInterface;


class LearningLogController extends Controller
{
    private $logRepository;

    public function __construct(LearningLogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    public function index()
    {
        $logs = LearningLog::count();
        $totalassesment = LearningLog::where('research_type', 'Assessment')->count();
        $totalEvaluation = LearningLog::where('research_type', 'Evaluation')->count();
        $totalPDM = LearningLog::where('research_type', 'PDM')->count();
        $totalResearch = LearningLog::where('research_type', 'Research Study')->count();
        $totalSurvey = LearningLog::where('research_type', 'Survey Repor')->count();
        $totallogs = LearningLog::count();
        $logs = LearningLog::latest()->paginate(12);
        $projects = Project::where('active','1')->latest()->get();
        $themes = Theme::latest()->get();
        return view('admin.learninglogs.index',compact('logs','projects','themes','totalassesment','totalEvaluation',
                    'totalPDM','totalResearch','totalSurvey','totallogs'));
    }
    public function search(Request $request)
    {   
        $research_type = $request->research_type;
        $project = $request->project;
        $theme = $request->theme;
        $logs = LearningLog::where('id','!=',-1);
      
        if (!empty($request->research_type)) {
            $logs->where('research_type', $request->research_type);
            
        }
        if (!empty($request->project)) {
           
            $logs->where('project', $request->project);
           
        }
        if (!empty($request->theme)) {
         
            $logs->whereJsonContains('theme', $request->theme);
            
        }
        
        $logs = $logs->paginate(12);
      
        return view('admin.learninglogs.search',compact('logs','project','theme','research_type'))->render();
    }
    public function get_learninglogs(Request $request){
        $id = $request->qb_id;
        $columns = array(
			0 => 'id',
			1 => 'title',
			2 => 'project',
            2 => 'project_type',
            2 => 'research_type',
            2 => 'thumbnail',
            8 => 'created_by',
           

		);
		
		$totalData = LearningLog::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		
        $logs = LearningLog::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        $totalFiltered = LearningLog::count();
	
		
		$data = array();
		
		if($logs){
			foreach($logs as $r){
                $edit_url = route('learning-logs.edit',$r->id);
                $show_url = route('learning-logs.show',$r->id);
                $nestedData['title'] = $r->title;
                $nestedData['project'] = $r->projects?->name ?? '';
                $nestedData['project_type'] = $r->project_type ?? '';
                $nestedData['research_type'] = $r->research_type ?? '';
                $nestedData['thumbnail'] = 'thumbnail';
                $nestedData['created_by'] = $r->user->name ?? '';
				$nestedData['action'] = '
                                <div>
                                <td>
                                   
                                    <a class=" btn-icon mx-1"  title="View Learning Log" href="'.$show_url.'">
                                    <i class="fa fa-eye  text-info" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn-icon  mx-1"  title="Edit Learning Log" href="'.$edit_url.'">
                                    <i class="fa fa-pencil text-warning" aria-hidden="true"></i>
                                    </a>
                                    <a class=" btn-icon  mx-1" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                        <i class="fa fa-trash  text-danger" aria-hidden="true"></i>
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
    public function view_learninglog(Request $request){
        
    }
    public function create()
    {
        $themes = Theme::latest()->get();
        $projects = Project::where('active','1')->latest()->get();
        addJavascriptFile('assets/js/custom/learninglog/createvalidations.js');
        return view('admin.learninglogs.create',compact('projects','themes','projects','themes'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $Qb = $this->logRepository->storelearninglog($data);
        $editUrl = route('learning-logs.index');
        addJavascriptFile('assets/js/custom/learninglog/createvalidations.js');
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }

    public function show(string $id)
    {
        $log = LearningLog::find($id);
        $theme_logs = json_decode($log->theme , true);
        $district_logs = json_decode($log->district , true);
        $province_logs = json_decode($log->province , true);

        $themes = Theme::whereIn('id', $theme_logs)->get();
        $districts = District::whereIn('district_id', $district_logs)->get();
        $provinces = Province::whereIn('province_id', $province_logs)->get();
        
        return view('admin.learninglogs.show',compact('log','themes','districts','provinces'));
    }

    public function edit(string $id)
    {
        $log = LearningLog::find($id);
        $theme_logs = json_decode($log->theme , true);
        $district_logs = json_decode($log->district , true);
        $province_logs = json_decode($log->province , true);
       
        $themes = Theme::whereIn('id', $theme_logs)->latest()->get();
        $districts = District::whereIn('district_id', $district_logs)->get();
       
        $provinces = Province::whereIn('province_id', $province_logs)->get();
        
        $projects = Project::where('active','1')->latest()->get(); 
        addJavascriptFile('assets/js/custom/learninglog/createvalidations.js');
        return view('admin.learninglogs.edit',compact('log','projects','themes','theme_logs','districts','provinces'));
    }
    public function downloadFile($id)
    {
        $log = LearningLog::find($id);
        
        $path = storage_path("app/public/learninglog/attachment/" . $log->attachment);
        
        $file = Storage::get('public/learninglog/attachment/'.$log->attachment);
         // Adjust the path and filename accordingly
      
        return response()->download($path);
    }

    public function update(Request $request, string $id)
    {
        
        $data = $request->except('_token');
        $Qb = $this->logRepository->updatelearninglog($data, $id);
        $editUrl = route('learning-logs.index');
     
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }

    public function destroy(string $id)
    {
        
        $logs = LearningLog::find($id);
	    if(!empty($logs)){
            $logs->delete();
		   
		   
	    }
      
	    return redirect()->back();
    }
}
