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
    
        $themeTargetCounts = DB::table('dip_activity_progress as dap')
                            ->join('dip_activity_months as dam', 'dap.quarter_id', '=', 'dam.id')
                            ->join('dip_activity as da', 'dam.activity_id', '=', 'da.id')
                            ->join('tbl_sci_sub_theme as sst', 'da.subtheme_id', '=', 'sst.id')
                            ->join('tbl_sci_themes as mt', 'sst.sci_theme_id', '=', 'mt.id')
                            ->select(
                                'mt.id as main_theme_id',
                                'mt.name as main_theme_name',
                                DB::raw('SUM(dap.boys_target) as total_boys_target'),
                                DB::raw('SUM(dap.girls_target) as total_girls_target'),
                                DB::raw('SUM(dap.women_target) as total_women_target'),
                                DB::raw('SUM(dap.men_target) as total_men_target')
                            )
                            ->groupBy('mt.id', 'mt.name')
                            ->where('dap.project_id', $projectId)  // Add your condition here
                            ->get();
        dd($themeTargetCounts);
        return response()->json(['districts' => $districts, 'provinces' => $provinces,'subThemes' => $subThemes,'themes' => $themes,]); 


    }
}
