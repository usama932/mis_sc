<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OldQB;
use App\Models\OldActionTracker;

class OldQbController extends Controller
{
    
    public function index()
    {
        return view('admin.quality_bench.old_qbs.index');
    }

    public function get_old_qbs(Request $request)
    {
        $id = $request->qb_id;
        $columns = array(
			0 => 'id',
			1 => 'unique_code',
            2 => 'qb_moniterized',
            3 => 'project',
            4 => 'partner_name',
            5 => 'province',
            6 => 'district',
            7 => 'theme',
            8 => 'sub-theme',
            9 => 'activity',
            10 => 'village',
            11 => 'date_visit',
            12 => 'total_qbs',
            13 => 'total_qbs_not_met',
            14 => 'total_qbs_met',
            15 => 'not_applicable',
            16 => 'score_out',
            17 => 'qb_status',
            18 => 'completed_by',
            19 => 'meal_lead',
            20 => 'created_by',
            21 => 'created_at',
            
		);
		
		$totalData = OldQB::count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = OldQB::count();
		$start = $request->input('start');
		
        $qualit_benchs = OldQB::where('id','!=',-1);
  
        if($request->kt_select2_district != null && $request->kt_select2_district != 'None'){
            $qualit_benchs->where('district',$request->kt_select2_district);
        }
        if($request->kt_select2_province != null && $request->kt_select2_province != 'None'){

            $qualit_benchs->where('province',$request->kt_select2_province);
        }
      
        $dateParts = explode(' to ',$request->date_visit);
       
        $startdate = '';
        $enddate = '';
        if(!empty($dateParts)){
            $startdate = $dateParts[0];
            $enddate = $dateParts[1] ?? '';
        }
      
       
        if($request->date_visit != null){

            $qualit_benchs->whereBetween('date_visit',[$startdate ,$enddate]);
        }
       
        if($request->project_name != null){

            $qualit_benchs->where('project',$request->project_name);
        }
        if(auth()->user()->permissions_level == 'province-wide')
        {
            $qualit_benchs->where('province',auth()->user()->province);
        }
        if(auth()->user()->permissions_level == 'district-wide')
        {
            $qualit_benchs->where('district',auth()->user()->district);
        }
        $qualit_bench =$qualit_benchs->offset($start)
                                    ->limit($limit)
                                    ->orderBy($order, $dir)->get()->sortByDesc("id");
		$data = array();
		if($qualit_bench){
			foreach($qualit_bench as $r){
			
               
               
				$nestedData['id'] = $r->id;
                $nestedData['unique_code'] = $r->unique_code ?? '';
                $nestedData['qb_moniterized'] = $r->qb_moniterized ?? '';
                $nestedData['project'] = $r->project ?? '';
                $nestedData['partner'] = $r->partner_name ?? '';
                $nestedData['province'] = $r->province ?? '';
                $nestedData['district'] = $r->district ?? '';
                $nestedData['theme'] = $r->theme ?? '';
                $nestedData['sub-theme'] = $r->theme ?? '';
                $nestedData['activity'] = $r->activity ?? '';
                $nestedData['village'] = $r->village ?? '';
                $nestedData['date_visit'] =date('d-M-Y', strtotime($r->date_visit)) ?? '';
                $nestedData['total_qbs'] = $r->total_qbs ?? '';
                $nestedData['total_qbs_not_met'] = $r->total_qbs_not_met ?? '';
                $nestedData['total_qbs_met'] = $r->total_qbs_met ?? '';
                $nestedData['not_applicable'] = $r->not_applicable ?? '';
                
                $nestedData['score_out'] = $r->score_out ?? '';
     
                $nestedData['qb_status'] = $r->qb_status ?? '';
               
                $nestedData['completed_by'] = $r->completed_by ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
                $nestedData['created_by'] =$r->created_by;
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn-icon mx-1" href="" target="_blank">
                                    <i class="fa fa-eye text-warning" aria-hidden="true" ></i>
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
