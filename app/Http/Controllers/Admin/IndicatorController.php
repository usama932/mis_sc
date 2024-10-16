<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IndicatorInterface;
use App\Models\SCITheme;
use App\Models\Project;
use App\Models\SCISubTheme;
use App\Models\Indicator;


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

    public function getIndicators(Request $request){
        $query = Indicator::latest();
       
    
        // Apply filters
        if ($request->filled('project')) {
            $query->where('project_id', $request->project); // Assuming project_id is in the indicators table
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('active', $request->status);
        }
    
        // Get the filtered count
        $totalFiltered = $query->count();
        $totalData = $query->count();
        // Get the paginated data
        $indicators = $query->get();
    
        // Prepare data for DataTables
        $data = [];
        foreach ($indicators as $indicator) {
            $nestedData = [
                'id' => $indicator->id,
                'project' => $indicator->project->name ?? '', // Assuming there is a relationship
                'theme' => $indicator->theme ?? '',
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
                'created_at' => ($indicator->created_at) ? date('M d, Y', strtotime($indicator->created_at)) : '',
                'action' => '', // Add your action buttons here if needed
                'edit_url' => route('indicators.edit', $indicator->id),
                'show_url' => route('indicators.show', $indicator->id),
                'delete_url' => route('indicators.delete', $indicator->id),
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
            'message' => 'Indicator created successfully',
            'data' => $indicator // Send back the created indicator
        ], 201);
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
}
