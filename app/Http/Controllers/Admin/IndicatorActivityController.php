<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndicatorActivities;
use App\Repositories\Interfaces\IndicatorInterface;
use App\Models\Indicator;
use App\Models\DipActivity;

class IndicatorActivityController extends Controller
{
    protected $indicatorRepo;

    public function __construct(IndicatorInterface $indicatorRepo)
    {
        $this->indicatorRepo = $indicatorRepo;
    }
    
    public function activityForm(){
        $indicators = Indicator::latest()->get();
        addJavascriptFile('assets/js/custom/indicators/create_activities.js');
        return view('admin.indicators.addIndicatorActivities',compact('indicators'));
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
        $indicatorId = $request->indicatorId;

        // Retrieve the project ID associated with the indicator
        $project = Indicator::find($indicatorId)->project_id;
    
        // Fetch activities associated with the project
        $activities = DipActivity::where('project_id', $project)->get(['id', 'activity_title']);
    
        // Return the activities as JSON
        return response()->json(['activities' => $activities]);
    }
}
