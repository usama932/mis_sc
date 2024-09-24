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
        $project_data = Project::select('projects.id', 'projects.name')
                        ->leftJoin('dip_activity as da', 'projects.id', '=', 'da.project_id')
                        ->leftJoin('dip_activity_months as dam', 'da.id', '=', 'dam.activity_id')
                        ->leftJoin('dip_activity_progress as dap', 'dam.id', '=', 'dap.quarter_id')
                        ->select(
                            'projects.name as project_name',
                            DB::raw('COUNT(DISTINCT da.id) AS total_activities_count'),
                            DB::raw('COUNT(DISTINCT dam.id) AS total_activities_target_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date <= CURRENT_DATE AND dap.id IS NOT NULL THEN dam.id END) AS complete_activities_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date < CURRENT_DATE AND dap.id IS NULL THEN dam.id END) AS overdue_count'),
                            DB::raw('COUNT(DISTINCT CASE WHEN dam.completion_date > CURRENT_DATE AND dap.id IS NULL THEN dam.id END) AS pending_count')
                        )
                        ->groupBy('projects.id', 'projects.name')
                        ->get();

        $data = [];
            foreach ($project_data as $item) { // Changed variable from $data to $item
            $data[] = [
                'name' => $item->project_name,
                'total_activities_count' => $item->total_activities_count,
                'total_activities_target_count' => $item->total_activities_target_count,
                'complete_activities_count' => $item->complete_activities_count,
                'overdue_count' => $item->overdue_count,
                'pending_count' => $item->pending_count,
            ];
        }
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
