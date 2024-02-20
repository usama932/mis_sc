<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectTheme;
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
            11 => 'house_hold_target',
            11 => 'individual_target',
            12 => 'created_at',
            13 => 'updated_by',
            14 => 'updated_at',
            
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
				$nestedData['id'] = $r->id;
                $nestedData['theme'] = $r->scitheme_name?->name ?? '';
                $nestedData['sub_theme'] = $r->scisubtheme_name?->name ?? '';
                $nestedData['project'] = $r->project?->name ?? '';
                $nestedData['house_hold_target'] = $r->house_hold_target ?? '';
                $nestedData['individual_target'] = $r->individual_target ?? '';
                $nestedData['women_target'] = $r->women_target ?? '';
                $nestedData['men_target'] = $r->men_target ?? '';
                $nestedData['girls_target'] = $r->girls_target ?? '';
                $nestedData['boys_target'] = $r->boys_target ?? '';
                $nestedData['pwd_target'] = $r->pwd_target ?? '';
               
                // $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at))  ?? '';
                // $nestedData['created_by'] = $r->user?->created_by ?? '';

                $nestedData['action'] = '<div>
                                        <td>
                                          
                                            <a class="btn-icon mx-1" onclick="event.preventDefault();project_themedel('.$r->id.');" title="Delete project theme" href="javascript:void(0)">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                            </a>
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
    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
      
        $project_theme = ProjectTheme::where('project_id' ,$request->project)->where('theme_id' ,$request->theme)->first();
        if(!empty($project_theme)){
          
            return response()->json([
                'message' => "Duplicate Theme Enter",
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
            session(['active' => $active]);

            return response()->json([
                'message' => "Theme Added",
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
        //
    }

    public function destroy(string $id)
    {
        
        $project_theme = ProjectTheme::where('id' ,$id)->first();
        $project_theme->delete();
        
        $active = 'thematic';
        session(['active' => $active]);
        
        return response()->json([
            'message' => "Project Theme Deleted",
            'error' => "true"
        ]);
    }
}
