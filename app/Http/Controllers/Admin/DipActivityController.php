<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dip;
use App\Models\DipActivity;
use App\Repositories\Interfaces\DipActivityInterface;

class DipActivityController extends Controller
{
    private $dipactivityRepository;

    public function __construct(DipActivityInterface $dipactivityRepository)
    {
        $this->dipactivityRepository = $dipactivityRepository;
    }
    public function index()
    {
       
      
    }
    public function get_activity_dips(Request $request){
        $dip_id = $request->dip_id;
        $columns = array(
			1 => 'id',
			2 => 'dip_id',
            3 => 'activity_number',
            4 => 'detail',
            5 => 'start_date',
            6 => 'end_date',
            7 => 'status',
            11 => 'created_by',
            12 => 'created_at',
            13 => 'updated_by',
            14 => 'updated_at',
            
		);
		
		$totalData = DipActivity::where('dip_id',$dip_id)->count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = DipActivity::where('dip_id',$dip_id)->count();
		$start = $request->input('start');
		
        $dips = DipActivity::where('dip_id',$dip_id);
  
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
			
              
                $edit_url = route('activity_dips.edit',$r->id);
                $show_url = route('activity_dips.show',$r->id);
				$nestedData['id'] = $r->id;
                $nestedData['activity_number'] = $r->activity_number?? '';
                $nestedData['start_date'] = $r->start_date ?? '';
                $nestedData['end_date'] = $r->end_date ?? '';
                $nestedData['status'] = $r->status ?? '';
                $nestedData['detail'] = $r->detail ?? '';
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
                $nestedData['action'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1" href="'. $edit_url.'" target="_blank">
                                                <i class="fa fa-pencil text-warning" aria-hidden="true" ></i>
                                            </a>
                                            <a class="btn-icon mx-1" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
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
      
        $data = $request->except('_token');
        $dip_activity = $this->dipactivityRepository->storedipactivity( $data);
        $active = 'dip_activity';
        session(['active' => $active]);
        $editUrl = route('dips.edit',$dip_activity->dip_id);
     
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
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $dip = DipActivity::find($id);
        if(!empty($dip)){  
            $dip->delete();
           
            return redirect()->back();
        }
        return redirect()->back();
    }
}
