<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndicatorActivities;
use App\Repositories\Interfaces\IndicatorInterface;
use App\Models\Indicator;
use App\Models\DipActivity;
use App\Models\Project;

class IndicatorActivityController extends Controller
{
    protected $indicatorRepo;

    public function __construct(IndicatorInterface $indicatorRepo)
    {
        $this->indicatorRepo = $indicatorRepo;
    }
    
    public function activityForm(){
        $projects   = Project::where('active',1)->latest()->get();
        $indicators = Indicator::latest()->get();
        addJavascriptFile('assets/js/custom/indicators/create_activities.js');
        
        return view('admin.indicators.addIndicatorActivities',compact('indicators','projects'));
    }

    public function index(){
      
        $projects   = Project::where('active',1)->latest()->get();
        $indicators = Indicator::latest()->get();

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/indicators/indicatorActivities.js');
        
        return view('admin.indicators.indicatorActivities',compact('indicators','projects'));
    }

    public function getIndicatorActivities(Request $request)
    {
        $query = Indicator::with(['project', 'user','activities'])->latest();
        if ($request->filled('project')) {
            $query->where('project_id', $request->project);
        }
        
        // Get the filtered and total count
        $totalData = $query->count();
        $totalFiltered = $totalData; // Since the query is already filtered
    
        $indicators = $query->get();
        
        foreach ($indicators as $indicator) {
           
            foreach ($indicator->activities as $activity) {
                $text = $activity->activity?->activity_title ?? "";
                $words = str_word_count($text, 1);
                $lines = array_chunk($words, 5  );
                $finalText = implode("<br>", array_map(fn($line) => implode(" ", $line), $lines));
                $nestedData = [
                    $show_url = route('indicatorActivityShow', $activity->id),
                 
                    'id' => $indicator->id,
                    'project' => 'sfdf' , 
                    'indicator_name' => $indicator->indicator_name ?? '',
                    'indicator_type' => $indicator->indicator_context_type ?? '',
                    'activity' => $activity->activity?->activity_number .'-'.$finalText ?? '',
                    'activity_target' => $activity->activity?->lop_target ?? '',
                    'created_by' => $activity->user->name ?? '',
                    'created_at' => $activity->created_at ? $activity->created_at->format('M d, Y') : '',
                    'action' => '<td><td><a class="" href="' . $show_url . '" target="_blank" title="Show Activity" href="javascript:void(0)"><i class="fa fa-eye text-success mx-3" aria-hidden="true"></i></a>
                                        <a class="" onclick="event.preventDefault();del('.$activity->id.');" title="Delete Client" href="javascript:void(0)">
                                        <i class="icon-1x text-danger  fa fa-trash"></i>
                                    </a>
                                    </td><div><td>',
                ];
                $data[] = $nestedData;
            }
        }
        
        // Return JSON response for DataTables
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        ]);
    }

    public function addActivityForm(Request $request)
    {
       
        $data = $request->except('_token');
       
        $indicator = $this->indicatorRepo->createIndicatorActivity($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Indicator Activities created successfully',

        ], 201);
    }

    public function getProjectActivities(Request $request)
    {
     
        $projectId = $request->projectId;
      
        // Retrieve the project ID associated with the indicator
        $indicators = Indicator::where('project_id', $projectId)->latest()->get();
    
        // Fetch activities associated with the project
        $activities = DipActivity::where('project_id', $projectId)->get(['id', 'activity_title']);
     
        // Return the activities as JSON
        return response()->json(['activities' => $activities,'indicators' => $indicators]);
    }

    public function indicatorActivityShow(Request $request, $id){
        $indicatorActivity =IndicatorActivities::where('id',$id)->with('indicator','activity')->first();
        return view('admin.indicators.showindicatorActivity',compact('indicatorActivity'));
    }

    public function indicatorActivityDelete(Request $request, $id){
      
        $indicatorActivity =IndicatorActivities::where('id',$id)->first();
        $indicatorActivity->delete();
        return redirect()->back();
    }
}
