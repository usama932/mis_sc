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
			1 => 'visit_staff_name',
			2 => 'date_visit',
            3 => 'accompanied_by',
            4 => 'type_of_visit',
            5 => 'province',
            6 => 'district',
            7 => 'project_type',
            8 => 'project_name',
            10 => 'created_at',

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
        if($request->visit_staff != null && $request->visit_staff != 'None'){

            $qualit_benchs->where('visit_staff_name',$request->visit_staff);
        }
      
        $dateParts = explode('to', $request->date_visit);
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
        $qualit_bench =$qualit_benchs->offset($start)
                                    ->limit($limit)
                                    ->orderBy($order, $dir)->get()->sortByDesc("id");
		$data = array();
		if($qualit_bench){
			foreach($qualit_bench as $r){
				$edit_url = route('quality-benchs.edit',$r->id);
				$nestedData['id'] = $r->id;
				$nestedData['visit_staff_name'] = $r->visit_staff_name ?? '';
                $nestedData['date_visit'] =date('d-M-Y', strtotime($r->date_visit)) ?? '';
                $nestedData['accompanied_by'] = $r->accompanied_by ?? '';
                $nestedData['type_of_visit'] = $r->type_of_visit ?? '';
                $nestedData['province'] = $r->provinces?->province_name ?? '';
                $nestedData['district'] = $r->districts?->district_name ?? '';
                $nestedData['project_type'] = $r->project_type ?? '';
                $nestedData['project_type'] = $r->project?->name ?? '';
                $nestedData['project_name'] = $r->project_type ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Quality Bench" href="javascript:void(0)">
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
    public function view_qb(Request $request){
        $qb = QualityBench::where('id',$request->id)->first();
      
        return view('admin.quality_bench.Qb_detail',compact('qb'));
    }
    public function create()
    {
        $projects = Project::where('active','1')->latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        addJavascriptFile('assets/js/custom/quality_benchmark/general.js');
        addJavascriptFile('assets/js/custom/frm/frm.js');
        return view('admin.quality_bench.basic_information.create',compact('projects','themes','users'));
    }

   
    public function store(CreateQbRequest $request)
    {
        $data = $request->except('_token');
        $Qb = $this->QbRepository->storeQb($data);
        $active = 'basic_info';
        session(['active' => $active]);
        $editUrl = route('quality-benchs.edit',$Qb->id);
     
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
        $projects = Project::latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        $qb = QualityBench::find($id);
        $active = 'basic_info';
        $monitor_visits = MonitorVisit::where('quality_bench_id',$id)->latest()->get();
        $title = "Edit Monitoring Quality Benchmarks";
        if(session('active') == ''){
            session(['active' => $active]);
        }
        addJavascriptFile('assets/js/custom/quality_benchmark/edit.js');
        addJavascriptFile('assets/js/custom/frm/frm.js');
        addVendors(['datatables']);
        return view('admin.quality_bench.edit',compact('projects','themes','users','qb','monitor_visits','title'));
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
        return view('admin.quality_bench.qb_export.qb_export',compact('projects','themes','users'));
    }
    public function getqbactionpointexportform(){
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
                    'visit_staff_name'  => $visit_staff_name,
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
