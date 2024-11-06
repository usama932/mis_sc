<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectPartner;

use App\Models\ProjectActivitySummary;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $user_email = $user->email;
        $user_name = $user->name;
        
        // Initialize common variables for project data and project summaries
        $project_data = ProjectActivitySummary::orderBy('project_name');

        // Determine the role and fetch data accordingly
        if ($user->hasRole('partner')) {
            // Fetch projects for the partner based on email
            $project_ids = ProjectPartner::where('email', $user_email)
                ->pluck('project_id')
                ->toArray();

            // Fetch project data summaries for these project IDs
            $project_data = $project_data->whereIn('project_id', $project_ids);
            $projects = Project::whereHas('partners', function ($query) use ($user_email) {
                $query->where('email', $user_email);
            })->orderBy('name');
        } elseif ($user->hasRole('focal person') || $user->hasRole('budget holder')) {
            // Fetch project summaries for the focal person/budget holder
            $project_data = $project_data->where('focal_person', 'LIKE', '%' . $user_name . '%');
            $projects = Project::whereJsonContains('focal_person', $user_id)->orderBy('name');
        } else {
            // For other roles, just get all projects and project summaries
            $projects = Project::orderBy('name');
        }

        // Get the final data
        $projects = $projects->get();
        $project_data = $project_data->get();

        // Prepare data to pass to the view
        $projectNames = $project_data->pluck('name');
        $completeActivities = $project_data->pluck('complete_activities_count');
        $overdueActivities = $project_data->pluck('overdue_count');
        $pendingActivities = $project_data->pluck('pending_count');

        addVendors(['datatables']);
        
        // Return the view with the relevant data
        return view('pages.dashboards.index', compact(
            'projects', 
            'project_data', 
            'projectNames', 
            'completeActivities', 
            'overdueActivities', 
            'pendingActivities'
        ));
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
