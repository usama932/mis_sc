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
        return view('admin.quality_bench.index');
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
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
        $qualit_benchs = QualityBench::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        $totalFiltered = QualityBench::count();
		$data = array();
		if($qualit_benchs){
			foreach($qualit_benchs as $r){
				$edit_url = route('quality-benchs.edit',$r->id);
				$nestedData['id'] = $r->id;
				$nestedData['visit_staff_name'] = $r->visit_staff_name;
                $nestedData['date_visit'] = $r->date_visit;
                $nestedData['accompanied_by'] = $r->accompanied_by;
                $nestedData['type_of_visit'] = $r->type_of_visit;
                $nestedData['province'] = $r->province;
                $nestedData['district'] = $r->district;
                $nestedData['project_type'] = $r->project_type;
                $nestedData['project_type'] = $r->project_type;
                $nestedData['project_name'] = $r->project_type;
                $nestedData['created_at'] = $r->created_at;
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Monitor Visit" href="javascript:void(0)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
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
        $qb_attachment = QBAttachement::where('id',$request->id)->first();
        return view('admin.quality_bench.qb_attachment.detail',compact('qb_attachment'));
    }
    public function create()
    {
        $projects = Project::latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        return view('admin.quality_bench.basic_information.create',compact('projects','themes','users'));
    }

   
    public function store(CreateQbRequest $request)
    {
        $data = $request->except('_token');
        $Qb = $this->QbRepository->storeQb($data);
        
        return redirect()->route('quality-benchs.edit',$Qb->id);
        
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
        if(session('active') == ''){
            session(['active' => $active]);
        }
        
        return view('admin.quality_bench.edit',compact('projects','themes','users','qb','monitor_visits'));
    }

  
    public function update(UpdateQbRequest $request, string $id)
    {
        $data = $request->except('_token');
        $Qb = $this->QbRepository->updateQb($data,$id);
        return redirect()->back()->with('success','Quality Bench Updated');
    }

 
    public function destroy(string $id)
    {
        //
    }
    public function monitor_visits(Request $request){
        dd($request->all());
    }
    public function action_points(Request $request){
        dd($request->all());
    }
    public function attachments(Request $request){
        dd($request->all());
    }
}
