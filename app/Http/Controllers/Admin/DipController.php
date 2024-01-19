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
		
		$totalData = Project::count();
       
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = Project::count();
       
		$start = $request->input('start');
		
        $dips = Project::query();

        $dips =$dips->limit($limit)->orderBy($order, $dir)->get();
      
		$data = array();
		if($dips){
			foreach($dips as $r){
                $create_url = route('dip.create',$r->id);
                $edit_url = route('dips.edit',$r->id);
                $show_url = route('dips.show',$r->id);
                $nestedData['dip_add'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1" href="'.  $create_url.'" target="_blank">
                                            <i class="fa fa-pencil text-success" aria-hidden="true" ></i>
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
                if(!empty($r->detail->partner )){
                    $partner_dip = json_decode($r->detail->partner , true);
                    $partners = Partner::whereIn('id', $partner_dip)->pluck('slug');
                }
                else{
                    $partners = '';
                }
                $nestedData['partner'] = $partners ?? '';
                if(!empty($r->detail->theme )){
                    $theme_dip = json_decode($r->detail->theme , true);
                    $themes = Theme::whereIn('id', $theme_dip)->pluck('name');
                }
                else{
                    $themes = '';
                }
                $nestedData['theme'] = $themes ?? '';
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
                                            <a class="btn-icon mx-1" href="'. $show_url.'" target="_blank">
                                            <i class="fa fa-eye text-success" aria-hidden="true" ></i>
                                            </a>
                                            <a class="btn-icon mx-1" href="'. $edit_url.'" target="_blank">
                                                <i class="fa fa-pencil text-warning" aria-hidden="true" ></i>
                                            </a>
                                            <a class="btn-icon mx-1" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
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
    public function dip_create($id)
    {
        $project = Project::where('id',$id)->first();
        addJavascriptFile('assets/js/custom/dip/dipvalidationform.js');
        return view('admin.dip.create',compact('project'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
     
        $data = $request->except('_token');
        $dip = $this->dipRepository->storedip( $data);
        $active = 'basic_info';
        session(['active' => $active]);
        $editUrl = route('dips.edit',$dip->id);
     
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }

    public function show(string $id)
    {
        $dip = Dip::with('projects','user','user1','activity')->find($id);
        $theme_dip = json_decode($dip->theme , true);
        $district_dip = json_decode($dip->district , true);
        $province_dip = json_decode($dip->province , true);
        $partner_dip = json_decode($dip->partner , true);

        $themes = Theme::whereIn('id', $theme_dip)->latest()->get();
        $partners = Partner::whereIn('id', $partner_dip)->get();
       
        $provinces = Province::whereIn('province_id', $province_dip)->get();
        $districts = District::whereIn('district_id', $district_dip)->get();
 
        return view('admin.dip.view_dip',compact('dip','themes','districts','provinces','partners'));
    }

    public function edit(string $id)
    {
      
        $dip = Dip::find($id);
      
        $project = Project::where('id',$dip->project)->first();
      
        $active = 'basic_info';
        if(session('active') == ''){
            session(['active' => $active]);
        }
        addJavascriptFile('assets/js/custom/dip/create.js');
        addJavascriptFile('assets/js/custom/dip/dip_activity_validations.js');
        return view('admin.dip.edit',compact('dip','project'));
    }

    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    public function destroy(string $id)
    {
        $dip = Dip::find($id);
        if(!empty($dip)){
            $dip->activity->each->delete();
           
            $dip->delete();
            return redirect()->route('dips.index');
        }
          return redirect()->route('dips.index');
    }
}
