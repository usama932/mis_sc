<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use DB;
use App\Models\ProjectActivitySummary;

class DashboardController extends Controller
{
    public function index()
    {
    
        $projects_count = Project::count();
        $user_id = auth()->user()->id;
        $user = $user_id.'';
        if(auth()->user()->hasRole('partner')){
            $projects = Project::whereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            })->orderBy('name');
        }
        elseif(auth()->user()->hasRole('focal person')){
            
            $projects = Project::whereJsonContains('focal_person', $user)->orderBy('name');
            
        }else{
            $projects = Project::orderBy('name');
        }
        $project_data = ProjectActivitySummary::orderBy('project_name')->get();
        $projects = $projects->get();
      
        $projectNames = $project_data->pluck('name');
        $completeActivities = $project_data->pluck('complete_activities_count');
        $overdueActivities = $project_data->pluck('overdue_count');
        $pendingActivities = $project_data->pluck('pending_count');
        addVendors(['datatables']);
        return view('pages.dashboards.index', compact('projects','project_data','projectNames', 'completeActivities', 'overdueActivities', 'pendingActivities'));
    }
    public function frm_dashboard()
    {
       
        return view('pages.dashboards.frm_dashboard');
    }
    public function output_tracker_dashboard(){

        return view('pages.dashboards.output_tracker_dashboard');
    }
    public function qb_dashboard()
    {
       
        return view('pages.dashboards.qb_dashboard');
    }
    public function medical_exit_interview()
    {
       
        return view('pages.dashboards.medical_exit_interview');
    }
}
