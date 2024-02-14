<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dip;
use App\Models\DipActivity;
use App\Models\Project;
use App\Models\Theme;
use App\Models\Partner;
use App\Models\District;
use App\Models\Province;
use Carbon\Carbon; 
use App\Repositories\Interfaces\DipRepositoryInterface;

class DipController extends Controller
{
    private $dipRepository;

    public function __construct(DipRepositoryInterface $dipRepository)
    {
        $this->dipRepository = $dipRepository;
    }
    public function index()
    {
        return view('admin.dip.index');
    }

    public function get_dips(Request $request)
    {
       
        $columns = array(
			1 => 'id',
			2 => 'project',
            3 => 'partner',
            4 => 'theme',
            5 => 'province',
            6 => 'district',
            7 => 'project_start',
            8 => 'project_end',
            9 => 'project_submition',
            10 => 'attachment',
            11 => 'created_by',
            12 => 'created_at',
            13 => 'updated_by',
            14 => 'updated_at',
            
		);
		if(auth()->user()->user_type != 'admin'){
            $totalData = Project::orWhere('focal_person' ,auth()->user()->id)->orWhereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            })->count();
        }else{
            $totalData = Project::count();
        }
		
       
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(auth()->user()->user_type != 'admin'){
            $totalFiltered = Project::orWhere('focal_person' ,auth()->user()->id)->orWhereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            })->count();
        }
        else{
            $totalFiltered = Project::count();
        }
       
		$start = $request->input('start');
		if(auth()->user()->user_type != 'admin'){
            $dips = Project::orWhere('focal_person' ,auth()->user()->id)->orWhereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            });
        }
        else{
            $dips = Project::query();
        }

        $dips =$dips->limit($limit)->offset($start)->orderBy($order, $dir)->get();
      
		$data = array();
		if($dips){
			foreach($dips as $r){
                
                $edit_url = route('dips.edit',$r->id);
                $show_url = route('dips.show',$r->id);
                $nestedData['dip_add'] = '<div>
                                        <td>
                                            <a class="btn btn-info btn-sm " title="Add Activity" href="'.  $edit_url.'" target="_blank">
                                            <i class="fa fa-plus" aria-hidden="true" ></i>
                                            </a>
                                        </a>
                                        </td>
                                        </div>
                                        ';
				$nestedData['id'] = $r->id;
                $nestedData['project'] = $r->name ?? '';
                if(!empty($r->detail->province )){
                    $province_dip = json_decode($r->detail->province , true);
                    $provinces = Province::whereIn('province_id', $province_dip)->pluck('province_name');
                }
                else{
                    $provinces = '';
                }
                $nestedData['province'] = $provinces ?? '';
                if(!empty($r->detail->district )){
                    $district_dip = json_decode($r->detail->district , true);
                    $districts = District::whereIn('district_id', $district_dip)->pluck('district_name');
                }
                else{
                    $districts = '';
                }
                $nestedData['district'] = $districts ?? '';
              
               
                if($r->start_date != null && $r->end_date != null){
                    $nestedData['project_tenure'] = date('d-M-Y', strtotime($r->start_date)) .' To '.date('d-M-Y', strtotime($r->end_date));
                }
                else{
                    $nestedData['project_tenure'] ='' ;
                }      
                $nestedData['attachment'] = $r->detail->attachment ?? '';
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
                       
                $nestedData['action'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1"title="View Project"  href="'. $show_url.'" target="_blank">
                                            <i class="fa fa-eye text-success" aria-hidden="true" ></i>
                                            </a>

                                         
                                        </a>';
                                        if (auth()->user()->user_type == 'admin') {
                                            $nestedData['action'] .= '
                                            <a class="btn-icon mx-1" title="Delete " onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                            </a>';
                                        }
                                        $nestedData['action'] .= '</td></div>';
                        
				
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			    => intval($request->input('draw')),
			"recordsTotal"	    => intval($totalData),
			"recordsFiltered"   => intval($totalFiltered),
			"data"			    => $data
		);
		
		echo json_encode($json_data);
    }
    public function dip_create($id)
    {
        
        $project = Project::with(['quarters' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->where('id',$id)->first();
     
        addJavascriptFile('assets/js/custom/dip/dip_activity_validations.js');
        return view('admin.dip.create',compact('project'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
     
        $data = $request->except('_token');
        $dip = $this->dipRepository->storedip( $data);
        $dip = 'basic_info';
        session(['dip' => $dip]);
        $editUrl = route('dips.edit',$dip->id);
     
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }

    public function show(string $id)
    {
        $project = Project::with('detail','partners','themes','user','user1')->find($id);
        $provinces = [];
        $districts = "";
        if($project->detail?->district != null) {
            $district_project = json_decode($project->detail->district , true);
            $districts = District::whereIn('district_id', $district_project)->get();
        }
       
        if($project->detail?->province != null) {
            $province_project = json_decode($project->detail->province , true);
            $provinces = Province::whereIn('province_id', $province_project)->get();
        }

        return view('admin.dip.view_dip',compact('project','districts','provinces'));
    }

    public function edit(string $id)
    {

        $project = Project::with(['quarters' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->find($id);

        $dip = 'basic_project';
        session(['dip' => $dip]);
       
        addJavascriptFile('assets/js/custom/dip/create.js');
        addVendors(['datatables']);
        return view('admin.dip.edit',compact('project'));
    }

    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    public function destroy(string $id)
    {
        $dip = Project::find($id);
        
        if(!empty($dip)){
            $dip->detail?->delete();
            return redirect()->route('dips.index');
        }
          return redirect()->route('dips.index');
    }
}
