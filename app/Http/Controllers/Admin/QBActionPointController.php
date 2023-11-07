<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActionPoint;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QBActionPointController extends Controller
{
    public function index()
    {
        //
    }
    public function get_action_points(Request $request)
    {
        $id = $request->qb_id;
        $columns = array(
			0 => 'id',
			1 => 'quality_bench_id',
			2 => 'monitor_visits_id',
			3 => 'action_agree',
			4 => 'qb_recommendation',
			5 => 'action_type',
            6 => 'responsible_person',
            7 => 'deadline',
            9 => 'deadline',
            9 => 'created_by',
            10 => 'created_at',

		);
		
		$totalData = ActionPoint::where('quality_bench_id',$id)->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$action_points = ActionPoint::where('quality_bench_id',$id)->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
			$totalFiltered = ActionPoint::where('quality_bench_id',$id)->count();
		}else{
			$search = $request->input('search.value');
			$action_points = ActionPoint::where('quality_bench_id',$id)->where('action_type','like',"%{$search}%")
                                    ->orWhere('action_agree','like',"%{$search}%")
                                    ->offset($start)
                                    ->limit($limit)
                                    ->orderBy($order, $dir)
                                    ->get();
			$totalFiltered = ActionPoint::where('quality_bench_id',$id)->where('action_type', 'like', "%{$search}%")
                                            ->orWhere('action_agree','like',"%{$search}%")
                                            ->orWhere('created_at','like',"%{$search}%")
                                            ->count();
            }
		
		
		$data = array();
		
		if($action_points){
			foreach($action_points as $r){
				$edit_url = route('monitor_visits.edit',$r->id);
				$nestedData['site'] = $r->monitor_visit?->activity_number ."-".$r->monitor_visit?->gap_issue  ;
				$nestedData['db_note'] = $r->db_note ?? '';
				$nestedData['action_agree'] = $r->action_agree ?? "";
                $nestedData['qb_recommendation'] = $r->qb_recommendation ?? '';
                $nestedData['action_type'] = $r->action_type ?? '';
                $nestedData['responsible_person'] = $r->responsible_person ?? '';
                $nestedData['deadline'] = date('d-M-Y',strtotime($r->deadline)) ?? '';
                $nestedData['status'] = $r->status ?? '';
                $nestedData['created_by'] = $r->user?->name ?? '';
                $nestedData['created_at'] = date('d-M-Y H:i:s',strtotime($r->created_at)) ?? '';
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();actionviewInfo('.$r->id.');" title="View Monitor Visit" href="javascript:void(0)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();actiondel('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
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
    public function view_action_point(Request $request){
       
        $action_point = ActionPoint::where('id',$request->id)->first();
        return view('admin.quality_bench.action_point.detail',compact('action_point'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $active = 'action_point';
        
        session(['active' => $active]);
        $editUrl = route('quality-benchs.edit',$request->quality_bench_id);

        if($request->action_agree == 'Yes'){
            $validator = Validator::make($request->all(), [
                'qb_recommendation'  => 'required',
                'action_type'  => 'required',
                'responsible_person'  => 'required',
                'status'  => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'editUrl' => $editUrl
                ]);
        
            }
        }

        $monitor_visits = ActionPoint::create([
            'quality_bench_id'      => $request->quality_bench_id,
            'monitor_visits_id'     => $request->activity_number,
            'action_agree'          => $request->action_agree,
            'qb_recommendation'     => $request->qb_recommendation ?? 'NA',
            'db_note'               => $request->db_note ?? 'NA',
            'action_type'           => $request->action_type ?? 'NA',
            'responsible_person'    => $request->responsible_person ?? 'NA',
            'deadline'              => $request->deadline,
            'status'                => $request->status,
            // 'created_by'            => auth()->user()->id,
        ]);
        
        return response()->json([
            'editUrl' => $editUrl
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $action_point = ActionPoint::find($id);
   
        $active = 'action_point';
	    if(!empty($action_point)){
		    $action_point->delete();
            session(['active' => $active]);
		    Session::flash('success_message', 'action Point successfully deleted!');
	    }
	    return redirect()->back();
    }
}
