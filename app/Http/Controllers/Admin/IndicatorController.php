<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IndicatorInterface;
use App\Models\SCITheme;
use App\Models\Project;
use App\Models\SCISubTheme;
use App\Models\Indicator;
use App\Models\DipActivity;
use Carbon\Carbon;

class IndicatorController extends Controller
{
    protected $indicatorRepo;

    public function __construct(IndicatorInterface $indicatorRepo)
    {
        $this->indicatorRepo = $indicatorRepo;
    }
    public function index()
    {
        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/indicators/index.js');
        return view('admin.indicators.index');
    }

    public function getIndicators(Request $request)
    {
        // Initialize the query
        $query = Indicator::with(['project', 'user'])->latest();

        // Apply filters if present
        if ($request->filled('project')) {
            $query->where('project_id', $request->project);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('active', $request->status);
        }
    
        // Get the filtered and total count
        $totalData = $query->count();
        $totalFiltered = $totalData; // Since the query is already filtered
    
      
        $indicators = $query->get();
      
        // Prepare data for DataTables
        $data = $indicators->map(function ($indicator) {
            $edit_url= route('indicators.edit', $indicator->id);
            $show_url = route('indicators.show', $indicator->id);
            $delete_url = route('indicators.delete', $indicator->id);
            return [
                'id' => $indicator->id,
                'project' => $indicator->project->name ?? '', // Assuming relationship
               // 'theme' => $indicator->theme ?? '',
                'log_frame' => $indicator->log_frame_level ?? '',
                'indicator_name' => $indicator->indicator_name ?? '',
                'indicator_type' => $indicator->indicator_context_type ?? '',
                'unit_of_measure' => $indicator->unit_of_measure ?? '',
                'actual_periodicity' => $indicator->actual_periodicity ?? '',
                'nature' => $indicator->nature ?? '',
                'data_format' => $indicator->data_format ?? '',
                'dis_segragation' => $indicator->disaggregation ?? '',
                'baseline' => $indicator->baseline ?? '',
                'created_by' => $indicator->user->name ?? '',
                'created_at' => $indicator->created_at ? $indicator->created_at->format('M d, Y') : '',
                'action' => '<td><td><a class="" href="' . $show_url . '" target="_blank" title="Show Activity" href="javascript:void(0)"><i class="fa fa-eye text-success mx-3" aria-hidden="true"></i></a>
                <a class="" href="' . $edit_url . '" target="_blank" title="Edit Activity" href="javascript:void(0)"><i class="fa fa-pencil text-success mx-3" aria-hidden="true"></i></a>
                                        <a class="" onclick="event.preventDefault();del('.$indicator->id.');" title="Delete Client" href="javascript:void(0)">
                                        <i class="icon-1x text-danger  fa fa-trash"></i>
                                    </a>
                                    </td><div><td>',
                
            ];
        });
    
        // Return JSON response for DataTables
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data->toArray(),
        ]);
    }
    
    public function create()
    {
        $themes = SCITheme::orderBy('name')->select('id','name')->get();
        $projects = Project::where('active',1)->whereHas('detail')->orderBy('name')->select('id','name')->get();
        addJavascriptFile('assets/js/custom/indicators/create.js');
        return view('admin.indicators.create',compact('themes','projects'));
    }

    public function store(Request $request)
    {
        $indicator = Indicator::where('project_id',$request->project)->first();
        if($indicator){
            return response()->json([
                'status' => 'error',
                'message' => 'Indicator already exist',
            ], 422);
        }
        $data = $request->except('_token');
       
        $indicator = $this->indicatorRepo->createIndicator($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Indicator created successfully'
        ], 201);
    }
    
    public function edit(string $id)
    {
        $indicator = Indicator::find($id);
        $themes = SCITheme::orderBy('name')->select('id','name')->get();
        $projects = Project::where('active',1)->whereHas('detail')->orderBy('name')->select('id','name')->get();
        addJavascriptFile('assets/js/custom/indicators/create.js');
        return view('admin.indicators.edit',compact('themes','projects','indicator'));
    }

    public function show(Request $request, string $id)
    {
        $indicatorActivity =Indicator::where('id',$id)->with('activities','project')->first();
        return view('admin.indicators.showindicator',compact('indicatorActivity'));
    }
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function getSubthemes(Request $request)
    {
        $themeIds = $request->input('themes', []);
        
        // Adjust your query as per your database structure
        $subthemes = SCISubTheme::whereIn('sci_theme_id', $themeIds)->get();

        return response()->json(['subthemes' => $subthemes]);
    }
    
    public function getProjectQuarters(Request $request)
    {
        $projectId = $request->input('project_id');
 
        // Fetch project data
        $project = Project::find($projectId);
       
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.'
            ]);
        }
        $startDate = Carbon::parse($project->start_date);
        $endDate = Carbon::parse($project->end_date);
        $quarters = [];
        $currentDate = $startDate->copy();

        // Loop through each month from start_date to end_date
        while ($currentDate->lte($endDate)) {
            $month = $currentDate->month;

            // Determine quarter
            $quarter = ceil($month / 3);
            $year = $currentDate->year;
            $quarterName = 'Q' . $quarter . ' ' . $year;
           
            // Initialize quarter array if not already done
            if (!isset($quarters[$quarterName])) {
                $quarters[$quarterName] = [
                    'name' => $quarterName,
                    'dates' => []
                ];
            }

            // Add the current date to the quarter
            $quarters[$quarterName]['dates'][] = $currentDate->format('Y-m-d');

            $currentDate->addMonth(); // Move to the next month
        }
        dd($quarters);
        // Reformat quarters for response
        $quartersResponse = [];
        foreach ($quarters as $quarter) {
            $quartersResponse[] = [
                'name' => $quarter['name'],
                'dates' => $quarter['dates']
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $quartersResponse
        ]);
    }
    
}
