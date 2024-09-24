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
        $projects = Project::wherehas('detail')->select('name','id')->get();
        $projects_count = Project::count();
        $activeCounts = $projects->groupBy('active')->map->count();
        $project_data = DB::table('projects as p')
                        ->leftJoin('dip_activity as da', 'p.id', '=', 'da.project_id')
                        ->leftJoin('dip_activity_months as dam', 'da.id', '=', 'dam.activity_id')
                        ->leftJoin('dip_activity_progress as dap', 'dam.id', '=', 'dap.quarter_id')
                        ->select(
                            'p.name as project_name',
                            DB::raw('COUNT(DISTINCT dam.id) AS total_activities_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date <= CURRENT_DATE AND dap.id IS NOT NULL THEN dam.id END) AS complete_activities_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date < CURRENT_DATE AND dap.id IS NULL THEN dam.id END) AS overdue_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date > CURRENT_DATE AND dap.id IS NULL THEN dam.id END) AS pending_count')
                        )
                        ->groupBy('p.id', 'p.name')
                        ->get();
               
      
       
        return view('pages.dashboards.index', compact('projects','project_data'));
    }
    public function frm_dashboard()
    {
       
        return view('pages.dashboards.frm_dashboard');
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
