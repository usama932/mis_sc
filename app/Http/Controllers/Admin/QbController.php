<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QualityBench;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Http\Requests\CreateQbRequest;
use App\Http\Requests\UpdateQbRequest;
use Illuminate\Support\Facades\Session;
use App\Models\MonitorVisit;
use Carbon\Carbon;
use App\Models\QBAttachement;
use App\Exports\QB\ExportQB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QB\ActionPoint;
use App\Repositories\Interfaces\QbRepositoryInterface;

class QbController extends Controller
{
    private $QbRepository;

    public function __construct(QbRepositoryInterface $QbRepository)
    {
        $this->QbRepository = $QbRepository;
    }
    public function index()
    {
        $projects = Project::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();

        return view('admin.quality_bench.index',compact('projects','users'));
    }

    public function get_qbs(Request $request)
    {
        $id = $request->qb_id;
        $columns = array(
			0 => 'id',
			1 => 'date_visit',
            2 => 'accompanied_by',
            3 => 'type_of_visit',
            4 => 'province',
            5 => 'district',
            6 => 'project_type',
            7 => 'project_name',
            8 => 'created_at',

		);
		
		$totalData = QualityBench::count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = QualityBench::count();
		$start = $request->input('start');
		
        $qualit_benchs = QualityBench::where('id','!=',-1);
  
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
        if($request->accompanied_by != null && $request->accompanied_by != 'None'){

            $qualit_benchs->where('accompanied_by',$request->accompanied_by);
        }
        if($request->visit_type != null && $request->visit_type != 'None'){

            $qualit_benchs->where('type_of_visit',$request->visit_type);
        }
        if($request->project_type != null){

            $qualit_benchs->where('project_type',$request->project_type);
        }
        if($request->project_name != null){

            $qualit_benchs->where('project_name',$request->project_name);
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
				$edit_url = route('quality-benchs.edit',$r->id);
                $view_url = route('quality-benchs.show',$r->id);
				$nestedData['id'] = $r->id;
                $nestedData['date_visit'] =date('d-M-Y', strtotime($r->date_visit)) ?? '';
                $nestedData['accompanied_by'] = $r->accompanied_by ?? '';
                $nestedData['type_of_visit'] = $r->type_of_visit ?? '';
                $nestedData['province'] = $r->provinces?->province_name ?? '';
                $nestedData['district'] = $r->districts?->district_name ?? '';
                $nestedData['project_type'] = $r->project_type ?? '';
                $nestedData['project_name'] = $r->project?->name ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" href="'.$view_url.'">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a title="Edit" class="btn btn-sm btn-clean btn-icon"
                                    href="'.$edit_url.'">
                                    <i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
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

    public function create()
    {
        $projects = Project::where('active','1')->latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        addJavascriptFile('assets/js/custom/quality_benchmark/general.js');
        addJavascriptFile('assets/js/custom/quality_benchmark/qb.js');
        return view('admin.quality_bench.basic_information.create',compact('projects','themes','users'));
    }

   
    public function store(CreateQbRequest $request)
    {
        $data = $request->except('_token');
        $Qb = $this->QbRepository->storeQb( $data);
        $active = 'basic_info';
        session(['active' => $active]);
        $editUrl = route('quality-benchs.edit',$Qb->id);
     
        return response()->json([
            'editUrl' => $editUrl
        ]);
   
        
    }


    public function show(string $id)
    {
        $qb = QualityBench::where('id',$id)->with('monitor_visit','action_point','qbattachement')->first();
      
        return view('admin.quality_bench.Qb_detail',compact('qb'));
    }

  
    public function edit(string $id)
    {
        $active     = 'basic_info';
        $title      = "Add QBs Details and Action Points Details";

        $projects   = Project::latest()->get();
        $themes     = Theme::latest()->get();
        $users      = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        $qb         = QualityBench::with('monitor_visit','action_point')->find($id);

        $count_monitor_visit  = MonitorVisit::where('quality_bench_id',$id)->where('activity_type', 'act')->count();
        $count_action_point   =   $qb->action_point->count();

        
        $monitor_visits = MonitorVisit::where('activity_type',"act")->where('quality_bench_id',$id)->latest()->get();
        $qb_attachment  = QBAttachement::where('quality_bench_id',$id)->first();

        
        if(session('active') == ''){
            session(['active' => $active]);
        }

        addJavascriptFile('assets/js/custom/quality_benchmark/edit.js');
        addJavascriptFile('assets/js/custom/quality_benchmark/qb.js');
        addVendors(['datatables']);
        return view('admin.quality_bench.edit',compact('projects','themes','users','qb','monitor_visits','title','qb_attachment','count_monitor_visit','count_action_point'));
    }

  
    public function update(UpdateQbRequest $request, string $id)
    {
        $data = $request->except('_token');
        $Qb = $this->QbRepository->updateQb($data,$id);
        $active = 'basic_info';
        if(session('active') == ''){
            session(['active' => $active]);
        }
        $editUrl = route('quality-benchs.edit',$id);
     
        return response()->json([
            'editUrl' => $editUrl
        ]);
   
    
    }

 
    public function destroy(string $id)
    {
        $qb = QualityBench::find($id);
        if(!empty($qb)){
            $qb->monitor_visit->each->delete();
            $qb->action_point->each->delete();
            $qb->qbattachement->each->delete();
            $qb->delete();
            return redirect()->route('quality-benchs.index');
        }
    }
    public function getqbexportform(){
        $projects = Project::latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        addJavascriptFile('assets/js/custom/frm/frm.js');
        addJavascriptFile('assets/js/custom/quality_benchmark/export.js');
        return view('admin.quality_bench.qb_export.qb_export',compact('projects','themes','users'));
    }
    public function getqbactionpointexportform(){
        addJavascriptFile('assets/js/custom/quality_benchmark/export.js');
        return view('admin.quality_bench.qb_export.qb_action_point');
    }
    public function getexportqb(Request $request){
      
        $visit_staff_name = $request->visit_staff_name;
        $date_visit = $request->date_visit;
        $accompanied_by = $request->accompanied_by;
        $type_of_visit = $request->type_of_visit;
        $province = $request->province;
        $district = $request->district;
        $project_type = $request->project_type;
        $project_name = $request->project_name;
        $data = [
                    'date_visit'        => $date_visit,
                    'accompanied_by'    => $accompanied_by,
                    'type_of_visit'     => $type_of_visit,
                    'province'          => $province,
                    'district'          => $district,
                    'project_type'      => $project_type,
                    'project_name'      => $project_name,
               
                ];
        $fileName = 'qb_' .'('. now()->format('d-m-Y') .')'. '.csv';
        return Excel::download(new ExportQB($data),  $fileName);
        
    }
    public function getexportqbactionpoint(Request $request){
        $date_visit = $request->date_visit;
        $data = [
                    'date_visit'        => $date_visit,
                ];

      
        $fileName = 'qb_ActionPoints' .'('. now()->format('d-m-Y') .')'. '.csv';
        return Excel::download(new ActionPoint($data),  $fileName);
    }
  
}
