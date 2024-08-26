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
    
       
        $data = [];
        foreach ($activity_progress as $progress) {
            $nestedData = [
                'date' => date('M d,Y', strtotime($progress->activity->created_at ?? '')),
                'reported_date' =>date('M d,Y', strtotime($progress->activitymonth?->complete_date ?? '')) ,
                'project' => $progress->project?->name ?? '',
                'sof' => $progress->project?->sof ?? '',
                'activity' => $progress->activity?->activity_title ?? '',
                'theme' => $progress->activity?->scisubtheme_name?->maintheme?->name ?? '' .'-'.$progress->activity?->scisubtheme_name?->name ?? '',
                'lop' => $progress->activity?->lop_target ?? '',
                'monthly_achieve' => $progress->activity_target ?? '',
                'women' => $progress->women_target ?? '',
                'men' => $progress->men_target ?? '',
                'total_adult' => $progress->men_target + $progress->women_target ?? '',
                'girls' => $progress->girls_target ?? '',
                'boys' => $progress->boys_target ?? '',
                'total_child' => $progress->boys_target + $progress->girls_target ?? '',
                'pwd' => $progress->pwd_target ?? '',
                'total_reach' =>$progress->women_target + $progress->men_target + $progress->girls_target + $progress->boys_target,
                'remarks' => $progress->remarks,
                'created_by' => $progress->user->name ?? '',
                'created_at' => ($progress->created_at) ? date('M d, Y', strtotime($progress->created_at)) . '<br>' . date('h:iA', strtotime($progress->created_at)) : '',
                
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
