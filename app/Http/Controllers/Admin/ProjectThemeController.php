<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectTheme;
use App\Models\Project;
use App\Models\ProjectPartner;
use App\Models\SCITheme;
use App\Models\User;
use App\Models\DipActivity;
use App\Models\UserTheme;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectThemeController extends Controller
{
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    public function index()
    {
        //
    }
    
    public function project_themes(Request $request){
        $columns = array(
			1  => 'id',
			2  => 'theme_id',
            3  => 'project_id',
            4  => 'girls_target',
            5  => 'boys_target',
            6  => 'men_target',
            7  => 'women_target',
            11 => 'pwd_target',
            12 => 'plw_target',
            13 => 'other',
            14 => 'house_hold_target',
            15 => 'individual_target',
            16 => 'created_at',
            17 => 'updated_by',
            18 => 'updated_at',
            
		);
		
		$totalData = ProjectTheme::where('project_id',$request->project_id)->count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = ProjectTheme::where('project_id',$request->project_id)->count();
		$start = $request->input('start');	
        $project = ProjectTheme::where('project_id',$request->project_id);

        $projects =$project->offset($start)
                            ->limit($limit)->orderBy($order, $dir)->get();
		$data = array();

		if($projects){
			foreach($projects as $r){
			
                $edit_url = route('projects.edit',$r->id);
                $show_url = route('projects.show',$r->id);
				$nestedData['id']                = $r->id;
                $nestedData['theme']             = $r->scitheme_name?->name ?? '';
                $nestedData['sub_theme']         = $r->scisubtheme_name?->name ?? '';
                $nestedData['project']           = $r->project?->name ?? '';
                $nestedData['house_hold_target'] = $r->house_hold_target ?? '';
                $nestedData['individual_target'] = $r->individual_target ?? '';
                $nestedData['women_target']      = $r->women_target ?? '';
                $nestedData['men_target']        = $r->men_target ?? '';
                $nestedData['girls_target']      = $r->girls_target ?? '';
                $nestedData['boys_target']       = $r->boys_target ?? '';
                $nestedData['pwd_target']        = $r->pwd_target ?? '';
                $nestedData['plw_target']        = $r->plw_target ?? '';
                $nestedData['other']             = $r->other ?? '';
             

                $nestedData['action'] = '<div>
                                            <td>
                                            <a class="btn-icon mx-1" title="Edit project theme" onclick="event.preventDefault(); edittheme('.$r->id.');" title="Edit project theme" href="javascript:void(0)">
                                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn-icon mx-1" onclick="event.preventDefault(); project_themedel('.$r->id.');" title="Delete project theme" href="javascript:void(0)">
                                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                        </a>
                                            </td>
                                        </div>
                                        ';
               
				
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			=> intval($request->input('draw')),
			"recordsTotal"	=> intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			=> $data
		);
		
		echo json_encode($json_data);
    }
    public function edit_project_theme(Request $request){
        $id  =    $request->id;
        $theme =  ProjectTheme::find($id);
        $project    = Project::where('id',$theme->project_id)->with('detail')->orderBy('name')->first();
        $themes     =  $project->themes ?? '';
        $ths        = SCITheme::orderBy('name')->get();
        addJavascriptFile('assets/js/custom/project/projectthemeValidation.js');
        return view('admin.projects.partials.edit_theme',compact('theme','ths','themes'));
    }
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
      
        $project_theme = ProjectTheme::where('project_id' ,$request->project)
                                        ->where('theme_id' ,$request->theme)
                                        ->where('sub_theme_id' ,$request->sub_theme)->first();
        if(!empty($project_theme)){
          
            return response()->json([
                'message' => "Sub Theme aleady exists",
                'error' => "true"
            ]);
        }
        $total_target = $request->women_target + $request->men_target + $request->girls_target + $request->boys_target;
       
        if($total_target !=  $request->individual_target){
            return response()->json([
                'message' => "Individually Target Distributed Incorrectly",
                'error' => "true"
            ]);
        }
        else{
            $data = $request->except('_token');
            $projecttheme = $this->projectRepository->storeprojecttheme($data);
          
            $active = 'thematic';
            session(['project' => $active]);
            $editUrl = route('project.detail',$projecttheme->project_id);
            return response()->json([
                'message' => "Theme Added",
             
                'editUrl' => $editUrl,
                'error' => "false"
            ]);
        }
    }

   
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {   
       
        $theme =  ProjectTheme::find($id);
        $formData = $request->input('formData');
       
        parse_str($formData, $parsedData);
        
        $ind_target =$parsedData['women_target'] + $parsedData['men_target'] + $parsedData['girls_target'] + $parsedData['boys_target'];
        
        if($ind_target == $parsedData['individual_target']){
            if(!empty($parsedData['pwd_target']) && $parsedData['pwd_target'] > -1 || $parsedData['pwd_target'] == 0){
                $pwdtarget  = $parsedData['pwd_target'];
            }else{
                $pwdtarget  = $theme->pwd_target;
            }
            if(!empty($parsedData['plw_target']) && $parsedData['plw_target'] > -1 || $parsedData['plw_target'] == 0){
                $plw_target  = $parsedData['plw_target'];
            }else{
                $plw_target  = $theme->plw_target;
            }
            if(!empty($parsedData['other']) && $parsedData['other'] > -1 || $parsedData['other'] == 0){
                $other  = $parsedData['other'];
            }else{
                $other  = $theme->other;
            }
            if(!empty($theme)){

                ProjectTheme::where('id',$id)->update([
                    'house_hold_target' => $parsedData['house_hold_target'] ??  $theme->house_hold_target,
                    'individual_target' => $parsedData['individual_target'] ??  $theme->individual_target,
                    'pwd_target'        => $pwdtarget,
                    'plw_target'        => $plw_target,
                    'other'             => $other,
                    'women_target'      => $parsedData['women_target'] ??  $theme->women_target,
                    'men_target'        => $parsedData['men_target'] ??  $theme->men_target,
                    'girls_target'      => $parsedData['girls_target'] ??  $theme->girls_target,
                    'boys_target'       => $parsedData['boys_target'] ??  $theme->boys_target,
                    
                ]);
                return response()->json([
                    'message' => 'Theme Updated Successfully',
                    'error'   => true,
                ]);
            }
            else{
                return response()->json([
                    'message' => 'Theme not found',
                    'error'   => false,
                ]);
            }
        }
        else{
            return response()->json([
                'message' => 'Beneficiaries target distrubed not correctly',
                'error'   => false,
            ]);
        }
            
       
    }

    public function destroy(string $id)
    {
        
        $project_theme = ProjectTheme::where('id' ,$id)->first();
        
        if(!empty($project_theme)){
           $dip_activities = DipActivity::where('subtheme_id', $project_theme->sub_theme_id)->get();

            if ($dip_activities->isNotEmpty()) {
                foreach ($dip_activities as $dip_activity) {
                   
                    if ($dip_activity->progress()->count() > 0) {
                        $dip_activity->progress()->delete();
                    }

                    if ($dip_activity->months()->count() > 0) {
                        $dip_activity->months()->delete();
                    }

                    $dip_activity->delete();
                }
            }

            $project_theme->delete();
        
        }
        
        $active = 'thematic';
        session(['active' => $active]);
        
        return response()->json([
            'message' => "Project Theme Deleted",
            'error' => "true"
        ]);
    }
}
