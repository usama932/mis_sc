<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\OtTracker;
use App\Models\Project;
use App\Models\ActivityProgress;
use App\Models\SciSubTheme;
use App\Models\SciTheme;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OTController extends Controller
{
  
    public function index()
    {
      
        $projects   = Project::latest()->get();
        $subthemes  = SciSubTheme::orderBy('name')->get();
        $themes     = SciTheme::orderBy('name')->get();
        $activity_user = ActivityProgress::get('created_by')->toArray(); 
        $users = User::whereIn('id',$activity_user)->get();

        addJavascriptFile('assets/js/custom/otTracker/index.js');
        addVendors(['datatables']);
        return view('admin.otTracker.index',compact('projects','subthemes','themes','users'));
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
      
        $query = OtTracker::latest();
       
        if ($request->has('project') && !empty($request->input('project'))) {
         
            $query->where('project_name', $request->input('project'));
        }
        
        if ($request->has('subtheme') && !empty($request->input('subtheme'))) {
            $query->where('subtheme_name', $request->input('subtheme'));
        }
        
        if ($request->has('added_by') && !empty($request->input('added_by'))) {
            $query->where('created_by', $request->input('added_by'));
        }
        
        $totalMen   = $query->sum('men_target');
        $totalWomen = $query->sum('women_target');
        $totalBoys  = $query->sum('boys_target');
        $totalGirls = $query->sum('girls_target');
        $totalPWD   = $query->sum('pwd_target');
        
        $totalAdults    = $totalMen + $totalWomen;
        $totalChildren  = $totalBoys + $totalGirls;
        $totalReach     = $totalAdults + $totalChildren;
        
        $totalRow = [
            'date'              => '',  // Empty columns
            'reported_date'     => '',
            'project'           => '',
            'sof'               => '',
            'activity'          => '',
            'theme'             => '',
            'lop'               => '',
            'benefiary_target'  => '',
            'monthly_achieve'   => '',
            'women'             => $totalWomen,
            'men'               => $totalMen,
            'total_adult'       => $totalAdults,
            'girls'             => $totalGirls,
            'boys'              => $totalBoys,
            'pwd'               => $totalPWD,
            'total_child'       => $totalChildren,
            'total_reach'       => $totalReach,
            'remarks'           => '',
            'created_by'        => '',
            'created_at'        => '',
        ];  
        $data = [$totalRow]; 
        
        $totalData = $query->count();
        $totalFiltered = $query->count();
        $activity_progress = $query->get();
        
        foreach ($activity_progress as $progress) {
           
            $activity_progress      = ActivityProgress::where('id',$progress->progress_id)->with('activity','activitymonth')->first();
     
            $nestedData = [
                'activity_title'    => $activity_progress->activity?->activity_number ?? '' .'-'. $activity_progress->activity?->activity_title ?? '',
                'date'              => date('M d,Y', strtotime($progress->created_at ?? '')),
                'reported_date'     => date('M d,Y', strtotime($progress->reported_date ?? '')),
                'project'           => $progress->project_name ?? '',
                'sof'               => $progress->sof ?? '',
                'activity'          => $activity_progress->activity?->activity_number.'-'.$progress->activity_title ?? '',
                'theme'             => $progress->main_theme_name .'->'.$progress->subtheme_name,
                'benefiary_target'  => $activity_progress->activitymonth?->beneficiary_target ?? 0,
                'lop'               => $progress->lop_target ?? '',
                'monthly_achieve'   => $progress->activity_target ?? '',
                'women'             => $progress->women_target ?? '',
                'men'               => $progress->men_target ?? '',
                'total_adult'       => $progress->men_target + $progress->women_target ?? '',
                'girls'             => $progress->girls_target ?? '',
                'boys'              => $progress->boys_target ?? '',
                'total_child'       => $progress->boys_target + $progress->girls_target ?? '',
                'pwd'               => $progress->pwd_target ?? '',
                'total_reach'       => $progress->women_target + $progress->men_target + $progress->girls_target + $progress->boys_target,
                'remarks'           => $progress->remarks,
                'created_by'        => $progress->user_name ?? '',
                'created_at'        => ($progress->created_at) ? date('M d, Y', strtotime($progress->created_at)) . '<br>' . date('h:iA', strtotime($progress->created_at)) : '',
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
  
    public function getThemeGenderData(Request $request)
    {
        // Query to get theme-wise progress subdivided by gender
        $data = OtTracker::select('main_theme_name', 
                DB::raw('SUM(men_target) as men'), 
                DB::raw('SUM(women_target) as women'), 
                DB::raw('SUM(boys_target) as boys'), 
                DB::raw('SUM(girls_target) as girls'))
                ->groupBy('main_theme_name')
                ->get();

        return response()->json($data);
    }

    public function getProjectThemeGenderData(Request $request)
    {
        // Query to get project-wise progress subdivided by theme and gender
        $data = OtTracker::select('project_name', 'main_theme_name', 
                DB::raw('SUM(men_target) as men'), 
                DB::raw('SUM(women_target) as women'), 
                DB::raw('SUM(boys_target) as boys'), 
                DB::raw('SUM(girls_target) as girls'))
                ->groupBy('project_name', 'main_theme_name')
                ->get();

        return response()->json($data);
    }

    public function getProjectReachData(Request $request)
    {
        // Example query to get project reach data
        $data = OtTracker::select('project_name', 'main_theme_name', 
            DB::raw('SUM(men_target) as men'), 
            DB::raw('SUM(women_target) as women'), 
            DB::raw('SUM(boys_target) as boys'), 
            DB::raw('SUM(girls_target) as girls'),
            DB::raw('SUM(men_target + women_target + boys_target + girls_target) as total_reach'))
        ->groupBy('project_name', 'main_theme_name')
        ->get();

        return response()->json($data);
    }
}
