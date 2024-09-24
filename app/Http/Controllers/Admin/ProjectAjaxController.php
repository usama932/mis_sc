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

        // Get all sub themes based on sub_theme_ids
        $subThemes = SciSubTheme::whereIn('id', $projectThemeIds)->get();
        
        // Get all themes based on sci_theme_id from subThemes
        $themes = SciTheme::whereIn('id', $subThemes->pluck('sci_theme_id'))->distinct()->get();

        // Calculate theme targets
        
        $themeTargetCounts = DB::table('tbl_sci_themes as mt')
                            ->leftJoin('tbl_sci_sub_theme as sst', 'mt.id', '=', 'sst.sci_theme_id')
                            ->leftJoin('dip_activity as da', 'sst.id', '=', 'da.subtheme_id')
                            ->leftJoin('dip_activity_months as dam', 'da.id', '=', 'dam.activity_id')
                            ->leftJoin('dip_activity_progress as dap', 'dam.id', '=', 'dap.quarter_id')
                            ->select(
                                'mt.id as main_theme_id',
                                'mt.name as main_theme_name',
                                DB::raw('SUM(dap.boys_target) as total_boys_target'),
                                DB::raw('SUM(dap.girls_target) as total_girls_target'),
                                DB::raw('SUM(dap.women_target) as total_women_target'),
                                DB::raw('SUM(dap.men_target) as total_men_target')
                            )
                            ->where('da.project_id', $projectId) // Replace 3 with $projectId if needed
                            ->groupBy('mt.id')
                            ->get();
                            
        $project_partners   = ProjectPartner::with('partner_name','partnertheme','user')->where('project_id',$projectId)->get();  
        return response()->json([
            'districts'         => $districts,
            'provinces'         => $provinces,
            'subThemes'         => $subThemes,
            'themes'            => $themes,
            'projectPartners'   => $project_partners,
            'themeTargetCounts' => $themeTargetCounts
        ]); 

    }
}
