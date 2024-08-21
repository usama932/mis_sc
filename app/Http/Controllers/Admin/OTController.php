<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ActivityProgress;

class OTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        addJavascriptFile('assets/js/custom/otTracker/index.js');
        addVendors(['datatables']);
        return view('admin.otTracker.index');
    }
    // {
    //     $apiToken = '9742a49db588994dae7593ec22d976ba8632f4f2';
    //     $formId = 'a7EmE4zZvMmPzasoS6rMy3'; // Replace with your form ID
    //     $baseUrl = "https://kobo.savethechildren.net/api/v2/assets/ahQcRFeXdkmGkNM2udu7BX/data.json/";

    //     // Step 1: Retrieve the submitted data for the specific form
    //     $response = Http::withHeaders([
    //         'Authorization' => "Token $apiToken",
    //     ])->get($baseUrl);

    //     if ($response->successful()) {
    //         $formData = $response->json();

    //         // Process the form data here
    //         // Example: Output form data
    //         dd($formData);
    //     } else {
    //         // Handle errors
    //         dd('Error fetching data for form', $response->status(), $response->body());
    //     }
    // }

    public function  get_output_tracker(Request $request){
        $query = ActivityProgress::latest();
        $totalData = $query->count();
    
       
       
        $totalFiltered = $query->count();
        $activity_progress = $query->with('activitymonth','activity','project','user')->get();
    
        dd($activity_progress);
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
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
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
}
