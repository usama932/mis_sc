<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActionPoint;
use App\Models\Project;
use App\Models\User;
use App\Models\QualityBench;
use App\Models\MonitorVisit;
use App\Models\ActionAcheive;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\UserTheme;

class QBActionPointController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        addVendors(['datatables']);
        return view('admin.quality_bench.action_point.index',compact('projects','users'));
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
                $edit_url = route('action_points.edit',$r->id);
				$nestedData['site'] = $r->monitor_visit?->activity_number ."-".$r->monitor_visit?->gap_issue  ;
				$nestedData['db_note'] = $r->db_note ?? '';
				$nestedData['action_agree'] = $r->action_agree ?? "";
                $nestedData['qb_recommendation'] = $r->qb_recommendation ?? '';
                $nestedData['action_type'] = $r->action_type ?? '';
                $nestedData['responsible_person'] = $r->responsible_person ?? '';
                if($r->deadline != '' && $r->deadline != Null){
                    $nestedData['deadline'] =date('d-M-Y',strtotime($r->deadline)) ?? '' ;
                }else{
                    $nestedData['deadline'] ='';
                }
                $nestedData['status'] = $r->status ?? '';
                $nestedData['created_by'] = $r->user?->name ?? '';
                $nestedData['created_at'] = date('d-M-Y H:i:s',strtotime($r->created_at)) ?? '';
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="mx-1  " onclick="event.preventDefault();actionviewInfo('.$r->id.');" title="View Action Point" href="javascript:void(0)">
                                    <i class="fa fa-eye text-warning" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn-icon  mx-1" title="Edit Action Point" href="'.$edit_url.'" target="_blank"><i class="fa fa-pencil text-info" aria-hidden="true"></i></a>
                                    <a class="mx-1 " onclick="event.preventDefault();actiondel('.$r->id.');" title="Delete Action Point" href="javascript:void(0)">
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

    public function get_qbs_actionpoints(Request $request)
    {
        $id = $request->qb_id;
        $columns = array(
            0   => 'assement_code',
            1   => 'id',
            2   => 'village',
            3   => 'theme',
			4   => 'activity',
			5   => 'issue/gap',
			6   => 'action_agree',
			7   => 'db_note',
			8   => 'action_point',
            9   => 'responsible_person',
            10  => 'deadline',
            11  => 'status',
            12  => 'created_by',
            13  => 'created_at',
          

		);
		
        $start = $request->input('start');
        $qb_actionpoints = ActionPoint::with('qb', 'monitor_visit');
      
        if($request->kt_select2_province != null && $request->kt_select2_province != 'all' && $request->kt_select2_province != 'None'){
         
            $qb_actionpoints->whereHas('qb', function ($query) use ($request) {
                $query->where('province', $request->kt_select2_province);
            });
        }
        if ($request->kt_select2_district != null && $request->kt_select2_district != 'all' && $request->kt_select2_district != 'None') {
            $qb_actionpoints->whereHas('qb', function ($query) use ($request) {
                $query->where('district', $request->kt_select2_district);
            });
        }
        if ($request->status != null && $request->status != 'None') {
            $qb_actionpoints->where('status', $request->status);
           
        }
        if ($request->assesment_code != null && $request->assesment_code != 'None') {
            $qb_actionpoints->whereHas('qb', function ($query) use ($request) {
                $query->where('assement_code', $request->assesment_code);
            });
        }
        $dateParts = explode('to', $request->date_visit);
        $startdate = '';
        $enddate = '';
        if(!empty($dateParts)){
            $startdate = $dateParts[0];
            $enddate = $dateParts[1] ?? '';
        }
        if ($request->date_visit != null && $request->date_visit != 'None') {
            $qb_actionpoints->whereHas('qb', function ($query) use ($startdate ,$enddate) {
                $query->whereBetween('date_visit',[$startdate ,$enddate]);
            });
        }
       
        if(auth()->user()->permissions_level == 'province-wide')
        {
            $qb_actionpoints->whereHas('qb', function ($query) {
                $query->where('province',auth()->user()->province);
            });
         
        }
        if(auth()->user()->permissions_level == 'district-wide')
        {
            $qb_actionpoints->whereHas('qb', function ($query) {
                $query->where('district',auth()->user()->district);
            });
        }
        $totalData = $qb_actionpoints->count();
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered =  $qb_actionpoints->count();
        if(auth()->user()->hasRole("IP's")){
            $qb_actionpoints->where('created_by',auth()->user()->id);
        }
		$action_points = $qb_actionpoints->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
      
		$data = array();
        
		if($action_points){
			foreach($action_points as $action_point){                 
                $edit_url = route('action_points.edit',$action_point->id);
                $view_url = route('action_points.show',$action_point->id);
                $update_url = route('getupdate_actionpoint',$action_point->id);
                $nestedData['assement_code'] = $action_point->qb->assement_code ?? '';
                $nestedData['district']      = $action_point->qb->districts?->district_name ?? '';
                $nestedData['theme']         = $action_point->qb->theme_name?->name ?? '';
                $nestedData['activity']      = $action_point->qb->activity_description ?? '';
                if($action_point->monitor_visit?->activity_type == 'act'){
                    $activity = $action_point->monitor_visit?->activity_number ?? '';
                }
                elseif($action_point->monitor_visit?->activity_type == 'obs'){
                    $activity = 'General Observation';
                }
                else{
                    $activity = '';
                }
                $nestedData['qb_no']         = $activity ?? '';
                $nestedData['village']       = $action_point->qb->village ?? '';
                $nestedData['date_visit']    = date('d-M-Y', strtotime($action_point->qb->date_visit)) ?? '';
                $nestedData['activity_number'] =$action_point->monitor_visit?->activity_number ?? '';
                $nestedData['db_note'] = wordwrap($action_point->monitor_visit?->gap_issue, 5, "\n");
                $nestedData['action_point'] =wordwrap($action_point->db_note, 5, "\n"); 
                $nestedData['qb_recommendation'] = wordwrap($action_point->qb_recommendation, 5, "\n");
                $nestedData['responsible_person'] = $action_point->responsible_person ?? '';
                if($action_point->deadline != '' && $action_point->deadline != Null){
                    $nestedData['deadline'] =date('d-M-Y',strtotime($action_point->deadline)) ?? '' ;
                }else{
                    $nestedData['deadline'] ='';
                }
                $nestedData['status'] = $action_point->status ?? '';
                $nestedData['created_by'] = $action_point->user?->name ?? '';
                $nestedData['created_at'] = date('d-M-Y H:i:s',strtotime($action_point->created_at)) ?? '';
                if($action_point->status == "Acheived" || $action_point->status == "Not Acheived" || $action_point->status == "Partialy Acheived"){
                    $edit = '';
                    $update_status = '<a class="btn-icon mx-1"  title=" Status Lock" href="javascript:void(0)" ><i class="fa fa-lock text-warning" aria-hidden="true"></i></a>';
                }else{
                    $edit = '<a class="btn-icon  mx-1" title="Edit Action Point" href="'.$edit_url.'" target="_blank"><i class="fa fa-pencil text-info" aria-hidden="true"></i></a>';
                    $update_status = '<a class="btn-icon mx-1"  title="Update Status" href="'.$update_url.'"><i class="fa fa-lock-open text-warning" aria-hidden="true"></i></a>';
                }
                if (auth()->check() && auth()->user()->can('edit quality benchmarks', 'delete quality benchmarks',)){
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn-icon mx-1" href="'.$view_url.'" title="View Action Point" target="_blank">
                                        <i class="fa fa-eye text-warning" aria-hidden="true"></i>
                                    </a>
                                    '.$update_status.'
                                    '.$edit.'
                                    <a class="btn-icon  mx-1"  title="Delete ActionPoint" onclick="event.preventDefault();actiondel('.$action_point->id.');" title="Delete Action Point" href="javascript:void(0)">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </a>
                                </td>
                                </div>
                            ';
                }else{
                    $nestedData['action'] = '<div>
                                            <td>
                                                <a class="btn-icon mx-1" href="'.$view_url.'" title="View Action Point" target="_blank">
                                                    <i class="fa fa-eye text-warning" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            </div>';
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
            'created_by'            => auth()->user()->id,
        ]);
        
        return response()->json([
            'editUrl' => $editUrl
        ]);

    }

    public function show(string $id)
    {
        $action_point =  ActionPoint::where('id',$id)->with('qb','monitor_visit')->first();
        return view('admin.quality_bench.action_point.Qb_detail',compact('action_point'));
    }

    public function edit(string $id)
    {
        $action_point =  ActionPoint::where('id',$id)->with('qb','monitor_visit')->first();
        $monitor_visit = MonitorVisit::where('id',$action_point->monitor_visits_id)->first();
        $qb  = QualityBench::with('monitor_visit','action_point')->where('id',$action_point->quality_bench_id)->first();
        addJavascriptFile('assets/js/custom/quality_benchmark/updateactionpointvalidation.js');
        
        return view('admin.quality_bench.action_point.edit_actionpoint',compact('action_point','qb','monitor_visit'));
    }

    public function update(Request $request, string $id)
    {
        $active = 'action_point';
        
        session(['active' => $active]);
        $editUrl = route('action_points.index');

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

        $monitor_visits = ActionPoint::where('id',$id)->update([
            'action_agree'          => $request->action_agree,
            'qb_recommendation'     => $request->qb_recommendation ?? 'NA',
            'db_note'               => $request->db_note ?? 'NA',
            'action_type'           => $request->action_type ?? 'NA',
            'responsible_person'    => $request->responsible_person ?? 'NA',
            'deadline'              => $request->deadline,
            'status'                => $request->status,
            'created_by'            => auth()->user()->id,
        ]);
        
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }

    public function getupdate_actionpoint($id){
        $action_point =  ActionPoint::where('id',$id)->with('qb','monitor_visit')->first();
        addJavascriptFile('assets/js/custom/quality_benchmark/updateactionpointvalidation.js');
        return view('admin.quality_bench.action_point.update_actionpoint',compact('action_point'));
    }

    public function postupdate_actionpoint(Request $request,$id){
      
        $validator = Validator::make($request->all(), [ 
            'status'  => 'required',
            'completion_date'  => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);   
        }

        $actionachieve = ActionAcheive::create([
            'action_point_id'           => $request->action_point_id,
            'completion_date'           => $request->completion_date,
            'comments'                  => $request->comments,
            'status'                    => $request->status,
        ]);
       
        $monitor_visits = ActionPoint::where('id',$id)->update([
            'status'            => $request->status,
            'completion_date'   => $request->completion_date,
            'updated_by'         => auth()->user()->id,
        ]);
        $actionpoint    = QualityBench::where('id',$request->qb_id)->first();
        if($actionpoint->theme == '5'){
            $actiontheme = 6;
        }else{
            $actiontheme = $actionpoint->theme;
        }
        $qb_theme       = User::where('theme_id',$actionpoint->theme)->first();
   
        if(!empty($qb_theme ) && !empty($actionpoint->action_point)){
            $qb_action_point =   ActionPoint::where('id',$id)->first();
            $email = $qb_theme->email;
           
              //$email = 'usama.qayyum@savethechildren.org';
            $bccEmails = [ 'walid.malik@savethechildren.org','usama.qayyum@savethechildren.org','irfan.majeed@savethechildren.org'];
            $details = [
                'id'            => $actionpoint->id,
                'action_id'     => $qb_action_point->id,
                'village'       => $actionpoint->village,
                'activity'      => $actionpoint->activity_description,
                'response_id'   => $actionpoint->assement_code,
                'action_point'  => $qb_action_point,
                'date_visit'    => $actionpoint->date_visit,
                'gap'           =>  $qb_action_point->monitor_visit?->gap_issue ?? '',
                'status'        =>  $qb_action_point->status ?? '',
                'deadline'      =>  $qb_action_point->deadline ?? '',
                'comments'      =>   $actionachieve->comments ?? '',
                'completion_date'       =>   $actionachieve->completion_date ?? '',
                'qb_recommendation'     =>  $qb_action_point->qb_recommendation ?? '',
            ];
            $subject = "[APT-".$actionpoint->assement_code."] ". $actionpoint->activity_description ." in ". $actionpoint->village ;
            Mail::to($email)
            ->bcc($bccEmails)
            ->send(new \App\Mail\QBstatusMail($details,$subject));
        }
        $actionpoint->submit = '1';
        $actionpoint->save();
        $editUrl = route('action_points.index');
     
        return response()->json([
            'editUrl' => $editUrl
        ]);
        return redirect()->route('action_points.index');
    }
    
    public function destroy(string $id)
    {
        $action_point = ActionPoint::find($id);
   
        $active = 'action_point';
	    if(!empty($action_point)){
            $action_point->action_achiev?->delete();
		    $action_point->delete();
            session(['active' => $active]);
		    Session::flash('success_message', 'action Point successfully deleted!');
	    }
	    return redirect()->back();
    }
}
