<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QualityBench;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Models\MonitorVisit;
use Illuminate\Support\Facades\Session;
use App\Models\GeneralObservations;
use Illuminate\Support\Facades\Validator;

class MonitorVisitsController extends Controller
{
    
    public function index()
    {
        //
    }
    public function get_monitor_visits(Request $request)
    {
        $id = $request->qb_id;
     
        $columns = array(
			0 => 'id',
			1 => 'activity_number',
			2 => 'qbs_description',
			3 => 'qb_met',
			4 => 'gap_issue',
			5 => 'quality_bench_id',
            5 => 'created_by',
            5 => 'created_at'
		);
		
		$totalData = MonitorVisit::where('quality_bench_id',$id)->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$monitor_visits = MonitorVisit::where('quality_bench_id',$id)->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
			$totalFiltered = MonitorVisit::where('quality_bench_id',$id)->count();
		}else{
			$search = $request->input('search.value');
			$monitor_visits = MonitorVisit::where('quality_bench_id',$id)->where('activity_number','like',"%{$search}%")
                                    ->orWhere('qb_met','like',"%{$search}%")
                                    ->offset($start)
                                    ->limit($limit)
                                    ->get();
			$totalFiltered = MonitorVisit::where('quality_bench_id',$id)->orWhere('activity_number', 'like', "%{$search}%")
                                            ->orWhere('qb_met','like',"%{$search}%")
                                            ->orWhere('created_at','like',"%{$search}%")
                                            ->count();
            }
		
            $monitor_visits->sortBy("activity_type");
		$data = array();
		
		if($monitor_visits){
			foreach($monitor_visits as $r){
                if( is_float($r->activity_number )){
                    $activity_number = $r->activity_number;
                }
                else{
                    $activity_number = 'Observation-'.$r->activity_number;
                }
				$nestedData['activity_number'] =  $activity_number ?? '';
                $nestedData['qbs_description'] = $r->qbs_description     ?? '';
				$nestedData['gap_issue'] = $r->gap_issue ?? '';
				$nestedData['created_at'] = date('d-M-Y H:i:s',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn-icon mx-1" onclick="event.preventDefault();monitorviewInfo('.$r->id.');" title="View Monitor Visit" href="javascript:void(0)" >
                                        <i class="fa fa-eye  text-warning" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn-icon  mx-1 text-success" onclick="event.preventDefault();monitorEdit('.$r->id.');" title="Edit Monitor Visit" href="javascript:void(0)">
                                        <i class="fa fa-pencil  text-info" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn-icon  mx-1" onclick="event.preventDefault();monitordel('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                        <i class="fa fa-trash  text-danger" aria-hidden="true"></i>
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
    public function view_monitor_visit(Request $request){
        $monitor_visit = MonitorVisit::where('id',$request->id)->first();
        return view('admin.quality_bench.monitor_visits.detail',compact('monitor_visit'));
    }
    public function edit_monitor_visit(Request $request){
        $monitor_visit = MonitorVisit::where('id',$request->id)->first();
        $qb  = QualityBench::with('monitor_visit','action_point')->where('id',$monitor_visit->quality_bench_id)->first();
        return view('admin.quality_bench.monitor_visits.edit',compact('monitor_visit','qb'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       
        $active = 'monitor_visit';

     
        $g_obs = MonitorVisit::where('quality_bench_id', $request->quality_bench_id)->where('activity_type','obs')->latest()->first();
        if($request->gb == "999999"){
            
            $activity_type = 'obs';
            $activity_number =  !empty($g_obs) ? $g_obs->activity_number + 1 : "1";
        }
        else{
            $activity_type = 'act';
            $activity_number = $request->activity_number;
        }
       
        $monitor_visits = MonitorVisit::create([
            'quality_bench_id'      => $request->quality_bench_id,
            'activity_number'       => $activity_number,
            'activity_type'         => $activity_type,
            'qbs_description'       => $request->qbs_description,
            'qb_met'                => $request->qb_met,
            'gap_issue'             => $request->gap_issue ?? 'NA',
            'created_by'            => auth()->user()->id
        ]);
        
        session(['active' => $active]);
        $editUrl = route('quality-benchs.edit',$request->quality_bench_id);
      
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
       
        $active = 'monitor_visit';

        if($request->qb_met == 'Not Fully Met'){
            $validator = Validator::make($request->all(), [
                'gap_issue'  => 'required',
            ]);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator);
            }
        }
     
        $g_obs = MonitorVisit::where('quality_bench_id', $request->quality_bench_id)->where('activity_type','obs')->latest()->first();
        if($request->gb == "999999"){
            
            $activity_type = 'obs';
            $activity_number =  !empty($g_obs) ? $g_obs->activity_number + 1 : "1";
        }
        else{
            $activity_type = 'act';
            $activity_number = $request->activity_number;
        }
       
        $monitor_visits = MonitorVisit::where('id',$id)->update([
            'quality_bench_id'      => $request->quality_bench_id,
            'activity_number'       => $activity_number,
            'activity_type'         => $activity_type,
            'qbs_description'       => $request->qbs_description,
            'qb_met'                => $request->qb_met,
            'gap_issue'             => $request->gap_issue ?? 'NA',
            'created_by'            => auth()->user()->id
        ]);
        
        session(['active' => $active]);
        $editUrl = route('quality-benchs.edit',$request->quality_bench_id);
      
        return redirect()->route('quality-benchs.edit',$request->quality_bench_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      
	    $monitorVisit = MonitorVisit::find($id);
        $active = 'monitor_visit';
	    if(!empty($monitorVisit)){
            $monitorVisit->action_point->each->delete();
		    $monitorVisit->delete();
		    Session::flash('success_message', 'Monitor Visit successfully deleted!');
	    }
        session(['active' => $active]);
	    return redirect()->back();
	   
    }
}

