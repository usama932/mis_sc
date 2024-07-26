<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QualityBench;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Models\MonitorVisit;
use App\Models\Partner;
use App\Models\QBAttachement;
use App\Exports\QB\ExportQB;
use App\Models\ClosingRecord;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QB\ActionPoint;
use App\Models\OldQB;
use App\Models\District;
use App\Models\Province;
use App\Repositories\Interfaces\QbRepositoryInterface;
use Carbon\Carbon;

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
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->orwhere('user_type','R3')->get();

        addJavascriptFile('assets/js/custom/quality_benchmark/index_script.js');
        addVendors(['datatables']);

        if(auth()->user()->user_type == "province-wide"){
            $province = Province::where('province_id',auth()->user()->province)->first();
            $qb_last_month = QualityBench::where('province',auth()->user()->province)
                                        ->whereMonth('date_visit', Carbon::now()->subMonth()->month)
                                        ->whereYear('date_visit', Carbon::now()->subMonth()->year)->count();
            $qb_this_month = QualityBench::where('province',auth()->user()->province)->whereMonth('date_visit', Carbon::now()->month)
                                        ->whereYear('date_visit', Carbon::now()->year)->count();
            $total_qbs =  QualityBench::where('province',auth()->user()->province)->count();
            $old_totalqb = OldQB::where('province',$province)->count();
            $qb_last_days = QualityBench::where('province',auth()->user()->province)->where('created_at', '>=', Carbon::now()->subDays(10))->count();
        }
        elseif(auth()->user()->user_type == "district-wide"){
            $district = District::where('district_id',auth()->user()->district)->count();
            $qb_last_month = QualityBench::where('district',auth()->user()->district)->whereMonth('date_visit', Carbon::now()->subMonth()->month)
            ->whereYear('date_visit', Carbon::now()->subMonth()->year)->count();
            $qb_this_month = QualityBench::where('district',auth()->user()->district)->whereMonth('date_visit', Carbon::now()->month)
            ->whereYear('date_visit', Carbon::now()->year)->count();
            $total_qbs =  QualityBench::where('district',auth()->user()->district)->count();
            $old_totalqb = OldQB::where('district',$district)->count();
            $qb_last_10_days = QualityBench::where('district',auth()->user()->district)->where('created_at', '>=', Carbon::now()->subDays(10))->count();
        }
        else{
            $qb_last_month = QualityBench::whereMonth('date_visit', Carbon::now()->subMonth()->month)
            ->whereYear('date_visit', Carbon::now()->subMonth()->year)->count();
            $qb_this_month = QualityBench::whereMonth('date_visit', Carbon::now()->month)
            ->whereYear('date_visit', Carbon::now()->year)->count();
            $total_qbs =  QualityBench::count();
            $old_totalqb = OldQB::count();
            $qb_last_days = QualityBench::where('created_at', '>=', Carbon::now()->subDays(10))->count();
        }
      
        return view('admin.quality_bench.index',compact('projects','users','total_qbs','old_totalqb','qb_last_days','qb_this_month','qb_last_month'));
    }

    public function get_qbs(Request $request)
    {
        $id = $request->qb_id;

        $columns = [
            0 => 'id',
            1 => 'date_visit',
            2 => 'accompanied_by',
            3 => 'type_of_visit',
            4 => 'province',
            5 => 'district',
            6 => 'project_type',
            7 => 'project_name',
            8 => 'created_at',
        ];

        $qualit_benchs = QualityBench::latest();

        // Filtering logic
        $filters = [
            'district' => $request->kt_select2_district,
            'province' => $request->kt_select2_province,
            'assement_code' => $request->assesment_code,
            'accompanied_by' => $request->accompanied_by,
            'type_of_visit' => $request->visit_type,
            'project_type' => $request->project_type,
            'staff_organization' => $request->partner,
            'qb_filledby' => $request->visit_staff,
            'project_name' => $request->project_name,
        ];

        foreach ($filters as $field => $value) {
            if (!is_null($value) && $value !== 'None') {
                $qualit_benchs->where($field, $value);
            }
        }

        if (!is_null($request->attachement) && $request->attachement !== 'None') {
            $qualit_benchs->whereHas('qbattachement', function ($query) use ($request) {
                if ($request->attachement === "Yes") {
                    $query->whereNotNull('document');
                } elseif ($request->attachement === "No") {
                    $query->where('document',Null);
                }
            });
        }

        // Date filtering
        $dateParts = explode('to', $request->date_visit);
       
        $startdate = '';
        $enddate = '';
        if(!empty($request->date_visit)){
            $startdate = $dateParts[0] ?? '';
            $enddate = $dateParts[1] ?? '';
        }
        if($request->date_visit != null ){
            $qualit_benchs->whereBetween('date_visit',[$startdate ,$enddate]);
        }

        // User permissions
        $user = auth()->user();
        if ($user->permissions_level === 'province-wide') {
            $qualit_benchs->where('province', $user->province);
        } elseif ($user->permissions_level === 'district-wide') {
            $qualit_benchs->where('district', $user->district);
        }

        if ($user->hasRole("IP's")) {
            $qualit_benchs->where('created_by', $user->id);
        }

        // Pagination and sorting
        $totalData = $qualit_benchs->count();
        $limit = $request->input('length', -1);
        $orderIndex = $request->input('order.0.column');
        $order = $columns[$orderIndex] ?? 'id';
        $dir = $request->input('order.0.dir', 'desc');
        $start = $request->input('start', 0);

        $totalFiltered = $qualit_benchs->count();
        $qualit_benchs = ($limit == -1)
            ? $qualit_benchs->orderBy($order, $dir)->get()
            : $qualit_benchs->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = $qualit_benchs->map(function ($r) {
            $edit_url = route('quality-benchs.edit', $r->id);
            $view_url = route('quality-benchs.show', $r->id);
            if(!empty($r->qbattachement->document) && $r->qbattachement->document !== ''){
                $attachment_url = $r->qbattachement && $r->qbattachement->document 
                ? route('showPDF.qb_attachments', $r->qbattachement->id) 
                : '#';
            }
            else{
                $attachment_url ='#';
            }
          

            return [
                'id' => $r->id,
                'assement_code' => $r->assement_code ?? '',
                'project_name' => $r->project?->name ?? '',
                'partner' => $r->partners?->slug ?? '',
                'province' => $r->provinces?->province_name ?? '',
                'district' => $r->districts?->district_name ?? '',
                'theme' => $r->theme_name?->name ?? '',
                'activity_description' => $r->activity_description ?? '',
                'village' => $r->village ?? '',
                'date_visit' => date('d-M-Y', strtotime($r->date_visit)) ?? '',
                'qb_base' => $r->qb_base_monitoring ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-light">No</span>',
                'total_qbs' => $r->total_qbs ?? '0',
                'qbs_not_fully_met' => $r->qbs_not_fully_met ?? '',
                'qbs_fully_met' => $r->qbs_fully_met ?? '',
                'qb_not_applicable' => $r->qb_not_applicable ?? '',
                'staff_organization' => $r->staff_organization ?? '',
                'score_out' => $r->score_out.'%' ?? '',
                'qb_status' => match($r->qb_status) {
                    'Poor' => '<span class="badge bg-danger">'.$r->qb_status.'</span>',
                    'Average' => '<span class="badge bg-warning">'.$r->qb_status.'</span>',
                    'Good' => '<span class="badge bg-secondary">'.$r->qb_status.'</span>',
                    default => '<span class="badge bg-success">'.$r->qb_status.'</span>',
                },
                'attachment' => $attachment_url !== '#' 
                    ? '<a class="btn-icon mx-1" href="'.$attachment_url.'" target="_blank"><i class="fa fa-download text-warning" aria-hidden="true"></i></a>'
                    : '',
                'created_at' => date('d-M-Y', strtotime($r->created_at)) ?? '',
                'created_by' => $r->user?->name,
                'action' => auth()->check() && auth()->user()->can('edit quality benchmarks', 'delete quality benchmarks')
                    ? '<div><td><a class="btn-icon mx-1" href="'.$view_url.'" target="_blank"><i class="fa fa-eye text-warning" aria-hidden="true"></i></a><a title="Edit" class="btn-icon mx-1" href="'.$edit_url.'" target="_blank"><i class="fa fa-pencil text-info"></i></a><a class="btn-icon mx-1" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td></div>'
                    : '<div><td><a class="btn-icon mx-1" href="'.$view_url.'" target="_blank"><i class="fa fa-eye text-warning" aria-hidden="true"></i></a></td></div>',
            ];
        })->toArray();

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        return response()->json($json_data);

    }

    public function create()
    {
        $projects = Project::where('active','1')->latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->orWhere('user_type','R3')->get();
        $partners = Partner::orderBy('name')->get();  
        $record = ClosingRecord::latest()->first(); 

        addJavascriptFile('assets/js/custom/quality_benchmark/general.js');
        addJavascriptFile('assets/js/custom/quality_benchmark/qb.js');
        return view('admin.quality_bench.basic_information.create',compact('record','projects','themes','users','partners'));
    }

   
    public function store(Request $request)
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
        $qb = QualityBench::where('id',$id)->with('monitor_visit','action_point','qbattachement')->first();

        return view('admin.quality_bench.Qb_detail',compact('qb'));
    }

  
    public function edit(string $id)
    {
        $active               = 'basic_info';
        $title                = "Add QBs Details and Action Points Details";
        $projects             = Project::where('active','1')->latest()->get();
        $themes               = Theme::latest()->get();
        $users                = User::where('user_type','R2')->orwhere('user_type','R1')->orWhere('user_type','R3')->get();
        $qb                   = QualityBench::with('monitor_visit','action_point')->find($id);

        $partners             = Partner::orderBy('name')->get();  
        $count_monitor_visit  = MonitorVisit::where('quality_bench_id',$id)->where('activity_type', 'act')->count();
        $count_action_point   =   $qb->action_point->count();

        
        $monitor_visits = MonitorVisit::leftJoin('monitor_action_points', 'monitor_visits.id', '=', 'monitor_action_points.monitor_visits_id')
                                        ->where('monitor_visits.gap_issue', '!=', null)
                                        ->where('monitor_visits.quality_bench_id', $id)
                                        ->whereNull('monitor_action_points.id') // Filter for monitor visits without action points
                                        ->orderBy('monitor_visits.created_at')
                                        ->select('monitor_visits.id','gap_issue','monitor_visits.activity_number')
                                        ->get()
                                        ->sortBy('activity_type');
                                      
        $qb_attachment  = QBAttachement::where('quality_bench_id',$id)->first();

        
        if(session('active') == ''){
            session(['active' => $active]);
        }

        addJavascriptFile('assets/js/custom/quality_benchmark/edit.js');
        addJavascriptFile('assets/js/custom/quality_benchmark/qb.js');
        addVendors(['datatables']);
        return view('admin.quality_bench.edit',compact('projects','partners','themes','users','qb','monitor_visits','title','qb_attachment','count_monitor_visit','count_action_point'));
    }

  
    public function update(Request $request, string $id)
    {
        $qb = QualityBench::find($id);
        $data = $request->except('_token');
        $Qb = $this->QbRepository->updateQb($data,$id);
        $active = 'basic_info';
        if(session('active') == ''){
            session(['active' => $active]);
        }
        if($qb->qb_base == "Yes"){
            $editUrl = route('quality-benchs.edit',$id);
        }
        else{
            $editUrl = route('quality-benchs.index');
        }
        return response()->json([
            'editUrl' => $editUrl
        ]);
   
    
    }

 
    public function destroy(string $id)
    {
        $qb = QualityBench::find($id);
        if(!empty($qb)){
            $qb->monitor_visit?->each->delete();
            $qb->action_point?->each->delete();
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
