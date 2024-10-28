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
}
