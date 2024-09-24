<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\District;
use App\Models\Province;
use App\Models\ProjectTheme;
use App\Models\SciSubTheme;
use Illuminate\Support\Facades\DB;
use App\Models\SciTheme;
use App\Models\ProjectPartner;

class ProjectAjaxController extends Controller
{
    public function getDistricts(Request $request)
    {
        $projectId = $request->input('project_id');
        $project = Project::with('detail')->find($projectId);

        $districts = [];
        $provinces = [];

        if ($project->detail?->district != null) {
            $district_project = json_decode($project->detail->district, true);
            $districts = District::whereIn('district_id', $district_project)->get();
        }

        if ($project->detail?->province != null) {
            $province_project = json_decode($project->detail->province, true);
            $provinces = Province::whereIn('province_id', $province_project)->get();
        }

        $projectThemeIds = ProjectTheme::where('project_id', $projectId)
            ->pluck('sub_theme_id')
            ->toArray();

        $subThemes = SciSubTheme::whereIn('id', $projectThemeIds)->get();
        $themes = SciTheme::whereIn('id', $subThemes->pluck('sci_theme_id'))->distinct()->get();

        $themeTargetCounts = DB::table('tbl_sci_themes as mt')
            ->leftJoin('tbl_sci_sub_theme as sst', 'mt.id', '=', 'sst.sci_theme_id')
            ->leftJoin('dip_activity as da', 'sst.id', '=', 'da.subtheme_id')
            ->leftJoin('dip_activity_months as dam', 'da.id', '=', 'dam.activity_id')
            ->leftJoin('dip_activity_progress as dap', 'dam.id', '=', 'dap.quarter_id')
            ->select(
                'mt.id as main_theme_id',
                'mt.name as main_theme_name',
                DB::raw('IFNULL(SUM(dap.boys_target), 0) as total_boys_target'),
                DB::raw('IFNULL(SUM(dap.girls_target), 0) as total_girls_target'),
                DB::raw('IFNULL(SUM(dap.women_target), 0) as total_women_target'),
                DB::raw('IFNULL(SUM(dap.men_target), 0) as total_men_target')
            )
            ->where('da.project_id',$projectId)
            ->groupBy('mt.id', 'mt.name')
            ->get();

        // Sample response for projectPartners and projectData
        $project_partners   = ProjectPartner::where('project_id',$projectId)->with('partner_name','partnertheme','user')->get();
      
        $projectData = Project::select('projects.id', 'projects.name')
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
                                    ->where('projects.id', $projectId) // Add this line to filter by project ID
                                    ->groupBy('projects.id', 'projects.name')
                                    ->get();        

        return response()->json([
            'districts' => $districts,
            'provinces' => $provinces,
            'themes' => $themes,
            'subThemes' => $subThemes,
            'themeTargetCounts' => $themeTargetCounts,
            'project_partners' => $project_partners,
            'projectData' => $projectData
        ]);

    }
}
