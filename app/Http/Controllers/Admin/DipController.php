<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dip;
use App\Models\DipActivity;
use App\Models\Project;
use App\Models\Theme;
use App\Models\Partner;

class DipController extends Controller
{
   
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
			
              
				$nestedData['id'] = $r->id;
                $nestedData['project'] = $r->projects->name ?? '';
                $nestedData['province'] = $r->provinces->province_name ?? '';
                $nestedData['district'] = $r->districts->district_name ?? '';
                $nestedData['partner'] = $r->partner_name ?? '';
                $nestedData['province'] = $r->province ?? '';
                $nestedData['district'] = $r->district ?? '';
                $nestedData['project_tenure'] = $r->theme ?? '';
                $nestedData['project_submition'] = $r->project_submition ?? '';
                $nestedData['attachment'] = $r->attachment ?? '';
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
          
             
                $nestedData['action'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1" href="" target="_blank">
                                            <i class="fa fa-arrow-right text-warning" aria-hidden="true" ></i>
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
        //
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
        //
    }
}
