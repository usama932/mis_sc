<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndicatorActivities;
use App\Models\IndicatorSummary;
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
    
    public function activityForm()
    {
        $projects   = Project::where('active',1)->latest()->get();
        $indicators = Indicator::latest()->get();
        addJavascriptFile('assets/js/custom/indicators/create_activities.js');
        
        return view('admin.indicators.addIndicatorActivities',compact('indicators','projects'));
    }

    public function index()
    {

        $projects   = Project::where('active',1)->latest()->get();
        $indicators = Indicator::latest()->get();

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/indicators/indicatorActivities.js');
        
        return view('admin.indicators.indicatorActivities',compact('indicators','projects'));
    }

    public function getIndicatorActivities(Request $request)
    {
        $query = Indicator::with(['project', 'user', 'activities'])->latest();

        // Apply filters
        if ($request->filled('project')) {
            $query->where('project_id', $request->project);
        }
    
        // Get the filtered and total count
        $totalData = $query->count();
        $totalFiltered = $totalData; // The query is already filtered
    
        // Fetch indicators
        $indicators = $query->get();
        $data = []; // Initialize data array
    
        foreach ($indicators as $indicator) {
            foreach ($indicator->activities as $activity) {
                // Process activity title for word wrapping
                $text = $activity->activity?->activity_title ?? "";
                $words = str_word_count($text, 1);
                $lines = array_chunk($words, 5);
                $finalText = implode("<br>", array_map(fn($line) => implode(" ", $line), $lines));
    
                // Generate the action URL
                $show_url = route('indicatorActivityShow', $activity->id);
    
                // Prepare nested data
                $nestedData = [
                    'id' => $indicator->id,
                    'project' => $indicator->project?->name ?? 'N/A',
                    'indicator_name' => $indicator->indicator_name ?? '',
                    'indicator_type' => $indicator->indicator_context_type ?? '',
                    'activity' => ($activity->activity?->activity_number ?? '') . '-' . $finalText,
                    'activity_target' => $activity->activity?->lop_target ?? '',
                    'created_by' => $activity->user?->name ?? '',
                    'created_at' => $activity->created_at ? $activity->created_at->format('M d, Y') : '',
                    'action' => '
                        <a class="" href="' . $show_url . '" target="_blank" title="Show Activity">
                            <i class="fa fa-eye text-success mx-3" aria-hidden="true"></i>
                        </a>
                        <a class="" onclick="event.preventDefault();del(' . $activity->id . ');" title="Delete Activity" href="javascript:void(0)">
                            <i class="icon-1x text-danger fa fa-trash"></i>
                        </a>',
                ];
                $data[] = $nestedData; // Add nested data to the main data array
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
    public function getActivitiesProgress()
    {
        $projects   = Project::where('active',1)->latest()->get();

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/indicators/indicatorprogress.js');
        return view('admin.indicators.indicatorProgress',compact('projects'));
    }
    
    public function getIndicatorProgress(Request $request)
    {
        $query = IndicatorSummary::query();
    
        if ($request->filled('project')) {
            $query->where('project_id', $request->project);
        }
    
        // Pagination and sorting parameters
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $orderColumn = $request->input('order.0.column', 0);
        $orderDir = $request->input('order.0.dir', 'asc');
        $searchValue = $request->input('search.value', '');
    
        // Column mapping for ordering (adjust if needed)
        $columns = ['project_name', 'indicator_name', 'overall_lop_target', 'total_activity_target', 'total_women_target', 'total_men_target', 'total_girls_target', 'total_boys_target', 'total_pwd_target'];
        $query->orderBy($columns[$orderColumn], $orderDir);
    
        // Apply search filter
        if (!empty($searchValue)) {
            $query->where(function($q) use ($searchValue) {
                $q->where('indicator_name', 'like', "%{$searchValue}%")
                  ->orWhere('project_name', 'like', "%{$searchValue}%");
            });
        }
    
        $totalData = $query->count();
        $indicators = $query->offset($start)->limit($length)->get();
    
        $data = [];
        foreach ($indicators as $indicator) {
            $text = $indicator->indicator_name ?? "";
            $words = str_word_count($text, 1);
            $lines = array_chunk($words, 5  );
            $finalText = implode("<br>", array_map(fn($line) => implode(" ", $line), $lines));
            $data[] = [
                'project'               => $indicator->project_name,
                'indicator'             =>  $finalText,
                'indicator_lop_target'  => $indicator->overall_lop_target ?? '0',
                'activity_lop_target'   => $indicator->total_activity_target ?? '0',
                'total_women_target'    => $indicator->total_women_target ?? '0',
                'total_men_target'      => $indicator->total_men_target ?? '0',
                'total_girls_target'    => $indicator->total_girls_target ?? '0',
                'total_boys_target'     => $indicator->total_boys_target ?? '0',
                'total_pwd_target'      => $indicator->total_pwd_target ?? '0'
            ];
        }
    
        // Return JSON response for DataTables
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data,
        ]);
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

    public function indicatorActivityShow(Request $request, $id)
    {
        $indicatorActivity =IndicatorActivities::where('id',$id)->with('indicator','activity')->first();
        return view('admin.indicators.showindicatorActivity',compact('indicatorActivity'));
    }

    public function indicatorActivityDelete(Request $request, $id)
    {  
        $indicatorActivity =IndicatorActivities::where('id',$id)->first();
        $indicatorActivity->delete();
        return redirect()->back();
    }
}
