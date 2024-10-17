<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use DB;

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
            $projects = Project::wherehas('detail')->orderBy('name');
        }
        $project_data = $projects->wherehas('detail')->select('projects.id', 'projects.name')
                        ->leftJoin('dip_activity as da', 'projects.id', '=', 'da.project_id')
                        ->leftJoin('dip_activity_months as dam', 'da.id', '=', 'dam.activity_id')
                        ->leftJoin('dip_activity_progress as dap', 'dam.id', '=', 'dap.quarter_id')
                        ->select(
                            'projects.name','projects.id','projects.sof','projects.type','projects.focal_person','projects.budget_holder','projects.start_date','projects.end_date',
                            DB::raw('COUNT(DISTINCT da.id) AS total_activities_count'),
                            DB::raw('COUNT(DISTINCT dam.id) AS total_activities_target_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date <= CURRENT_DATE AND dap.id IS NOT NULL THEN dam.id END) AS complete_activities_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date < CURRENT_DATE AND dap.id IS NULL THEN dam.id END) AS overdue_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date > CURRENT_DATE AND dap.id IS NULL THEN dam.id END) AS pending_count')
                        )
                        ->groupBy('projects.id', 'projects.name')
                        ->orderBy('projects.name')
                        ->get();
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
