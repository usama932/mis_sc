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
		
		$totalData = Dip::count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = Dip::count();
		$start = $request->input('start');
		
        $dips = Dip::query();
  
        if($request->kt_select2_district != null && $request->kt_select2_district != 'None'){
            $dips->where('district',$request->kt_select2_district);
        }
        if($request->kt_select2_province != null && $request->kt_select2_province != 'None'){

            $dips->where('province',$request->kt_select2_province);
        }
      
        $dateParts = explode(' to ',$request->date_visit);
       
        $startdate = '';
        $enddate = '';
        if(!empty($dateParts)){
            $startdate = $dateParts[0];
            $enddate = $dateParts[1] ?? '';
        }
      
       
        if($request->date_visit != null){

            $dips->whereBetween('date_visit',[$startdate ,$enddate]);
        }
       
        if($request->project_name != null){

            $dips->where('project',$request->project_name);
        }
        
        $dips =$dips->limit($limit)
                                    ->orderBy($order, $dir)->get()->sortByDesc("date_visit");
		$data = array();
		if($dips){
			foreach($dips as $r){
			
                $edit_url = route('dips.edit',$r->id);
                $show_url = route('dips.show',$r->id);
             
				$nestedData['id'] = $r->id;
                $nestedData['project'] = $r->projects->name ?? '';
                $province_dip = json_decode($r->province , true);
                $provinces = Province::whereIn('province_id', $province_dip)->pluck('province_name');
                $nestedData['province'] = $provinces ?? '';
                $district_dip = json_decode($r->district , true);
                $districts = District::whereIn('district_id', $district_dip)->pluck('district_name');
                $nestedData['district'] = $districts ?? '';
                $partner_dip = json_decode($r->partner , true);
                $partners = Partner::whereIn('id', $partner_dip)->pluck('name');
                $nestedData['partner'] = $partners ?? '';
                $theme_dip = json_decode($r->theme , true);
                $themes = Theme::whereIn('id', $theme_dip)->pluck('name');
                $nestedData['theme'] = $themes ?? '';
                $nestedData['project_tenure'] = date('d-M-Y', strtotime($r->project_start)) .' To '.date('d-M-Y', strtotime($r->project_end));
                $nestedData['project_submition'] = date('d-M-Y', strtotime($r->project_submition)) ?? '';
                $nestedData['attachment'] = $r->attachment ?? '';
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
 
    public function create()
    {
        $projects = Project::where('active',1)->get();
        $partners = Partner::all();
        
        $themes = Theme::all();

        addJavascriptFile('assets/js/custom/dip/create.js');
        return view('admin.dip.create',compact('projects','partners','themes'));
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
        //
    }

    public function edit(string $id)
    {
      
        $dip = Dip::find($id);
        $projects = Project::where('active',1)->get();
        $partners = Partner::all();
      

        $themes = Theme::all();

        
        $theme_dip = json_decode($dip->theme , true);
        $district_dip = json_decode($dip->district , true);
        $province_dip = json_decode($dip->province , true);
        $partner_dip = json_decode($dip->partner , true);

        $districts = District::whereIn('district_id', $district_dip)->get();
       
        if(session('active') == ''){
            session(['active' => $active]);
        }
        addJavascriptFile('assets/js/custom/dip/create.js');
        addJavascriptFile('assets/js/custom/dip/dip_activity_validations.js');
        return view('admin.dip.edit',compact('dip','projects','partners','themes','theme_dip','districts','province_dip','partner_dip'));
    }

    public function update(Request $request, string $id)
    {
        //
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
