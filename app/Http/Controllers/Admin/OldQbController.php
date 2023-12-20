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
			1 => 'id',
			2 => 'unique_code',
            3 => 'qb_moniterized',
            4 => 'project',
            5 => 'partner_name',
            6 => 'province',
            7 => 'district',
            8 => 'theme',
            9 => 'sub-theme',
            10 => 'activity',
            11 => 'village',
            12 => 'date_visit',
            13 => 'total_qbs',
            14 => 'total_qbs_not_met',
            15 => 'total_qbs_met',
            16 => 'not_applicable',
            17 => 'score_out',
            18 => 'qb_status',
            19 => 'completed_by',
            20 => 'meal_lead',
            21 => 'created_by',
            22 => 'created_at',
            
		);
		
		$totalData = OldActionTracker::count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = OldQB::count();
		$start = $request->input('start');
		
        $qualit_benchs = OldQB::query();
  
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
       
        if($request->project_name != null && $request->project_name != 'None'){

            $qualit_benchs->where('project',$request->project_name);
        }
        // if(auth()->user()->permissions_level == 'province-wide')
        // {
        //     $qualit_benchs->where('province',auth()->user()->province);
        // }
        // if(auth()->user()->permissions_level == 'district-wide')
        // {
        //     $qualit_benchs->where('district',auth()->user()->district);
        // }
        $qualit_bench =$qualit_benchs->limit($limit)
                                    ->orderBy($order, $dir)->get()->sortByDesc("date_visit");
		$data = array();
		if($qualit_bench){
			foreach($qualit_bench as $r){
			
               $view_url = route('get_old_action_points',$r->id);
               
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
                if($r->action_point->count() > 0){
                    $nestedData['action'] = '
                    <div>
                    <td>
                        <a class="btn-icon mx-1" href="'.$view_url.'" target="_blank">
                        <i class="fa fa-arrow-right text-warning" aria-hidden="true" ></i>
                        </a>
                       
                    </td>
                    </div>
                ';
                }
                else {
                    $nestedData['action'] = '';
                }
				
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
    public function get_old_action_points($id)
    {
        $qb = OldQB::find($id);
        return view('admin.quality_bench.old_qbs.action_point',compact('qb'));
    }
    public function old_action_points(Request $request)
    {
        $id = $request->qb_id;
        
        $columns = array(
			1 => 'id',
			2 => 'unique_code',
            3 => 'type',
            4 => 'issue_gap',
            5 => 'action_to_make',
            6 => 'responsible_person',
            7 => 'deadline',
            8 => 'status',
            9 => 'completion_date',
            10 => 'comments',
            11 => 'remarks',
            12 => 'created_by',
            13 => 'created_at',
            
		);
		
		$totalData = OldActionTracker::where('qb_id',$id)->count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = OldActionTracker::where('qb_id',$id)->count();
		$start = $request->input('start');
		
        $action_points = OldActionTracker::where('qb_id',$id);

        $action_point = $action_points->limit($limit)
                        ->orderBy($order, $dir)->get()->sortByDesc("id");
		$data = array();
		if($action_point){
			foreach($action_point as $r){
			
               $view_url = route('get_old_action_points',$r->id);
               
				$nestedData['id'] = $r->id;
                $nestedData['unique_code'] = $r->unique_code ?? '';
                if($r->type == 'act'){
                    $type = "Activity";
                }
                else{
                    $type = "General Obeservation";
                }
                $nestedData['type'] = $type ?? '';
                $nestedData['issue_gap'] = $r->issue_gap ?? '';
                $nestedData['action_to_make'] = $r->action_to_make ?? '';
                $nestedData['responsible_person'] = $r->responsible_person ?? '';
                $nestedData['deadline'] = date('d-M-Y', strtotime($r->deadline)) ?? '';
                $nestedData['status'] = $r->status ?? '';
                $nestedData['completion_date'] =date('d-M-Y', strtotime($r->completion_date)) ?? '';
                $nestedData['comments'] = $r->comments ?? '';
                $nestedData['remarks'] = $r->remarks ?? '';
                $nestedData['created_at'] =date('d-M-Y', strtotime($r->created_at)) ?? '';
                $nestedData['created_by'] = $r->created_by ?? '';
                
				
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
