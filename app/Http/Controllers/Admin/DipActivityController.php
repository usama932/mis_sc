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
			2 => 'project_id',
            3 => 'activity_detail',
           
            
		);
		
		$totalData = DipActivity::where('project_id',$dip_id)->count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = DipActivity::where('project_id',$dip_id)->count();
		$start = $request->input('start');
		
        $dips = DipActivity::where('project_id',$dip_id);
  

        
        $dips =$dips->limit($limit)->offset($start)
                                    ->orderBy($order, $dir)->get()->sortByDesc("date_visit");
		$data = array();
		if($dips){
			foreach($dips as $r){
			
                $show_url = route('activity_dips.show',$r->id);
				$nestedData['activity_number'] = $r->activity_number ?? ''; 
                $nestedData['detail'] = $r->activity_detail ?? '';
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
                $nestedData['action'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1" href="'.$show_url.'" target="_blank"  >
                                                <i class="fa fa-eye text-warning" aria-hidden="true" ></i>
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
    public function edit_activity_dips(Request $request){
        $dip = DipActivity::where('id',$request->id)->first();
      
        return view('admin.dip.edit_dip_activity',compact('dip'));
    }
   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       
        $data = $request->except('_token');
        $dip_activity = $this->dipactivityRepository->storedipactivity($data);
        $active = 'dip_activity';
        session(['active' => $active]);
        $editUrl = route('dips.edit',$dip_activity->project_id);
     
        return response()->json([
            'editUrl' => $editUrl
        ]);

    }


    public function show(string $id)
    {
        $dip_activity = DipActivity::where('id',$id)->with('months','project','user','user1')->first();
        return view('admin.dip.show_dip_activity',compact('dip_activity'));
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
      
        $data = $request->except('_token');
        $dip_id =  DipActivity::where('id',$id)->first();
        $dip_activity = $this->dipactivityRepository->updatedipactivity($data,$id);
        $active = 'dip_activity';
        session(['active' => $active]);
        $editUrl = route('dips.edit',$dip_id->dip_id);
        dd($editUrl);
        return response()->json([
            'editUrl' => $editUrl
        ]);
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
