<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::select('active')->get();
        $projects_count = Project::count();
        $activeCounts = $projects->groupBy('active')->map->count();
        $data = [
            'inactive' => $activeCounts->get(0, 0),
            'active' => $activeCounts->get(1, 0),
        ];

        return view('pages.dashboards.index', compact('projects_count','data'));
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
