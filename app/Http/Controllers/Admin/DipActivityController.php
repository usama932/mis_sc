<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DipActivity;
use Carbon\Carbon; 
use App\Models\District;
use App\Models\ActivityMonths;
use App\Models\Province;
use App\Models\Project;
use App\Models\ActivityProgress;
use File;

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
                $edit_url = route('activity_dips.edit',$r->id);
                $progress_url = route('postprogress',$r->id);
				$nestedData['activity_number'] = $r->activity_title ?? ''; 
              
                $nestedData['lop_target'] = $r->lop_target ?? '';
                $quarterTarget = '';
                foreach ($r->months as $month) {
                    if($month->activity_id == $r->id && $month->project_id == $r->project_id) {
                        $quarterTarget .= '<span class="fs-9"><br>'.$month->slug?->slug.'-'.$month->year.' = ' . $month->target.',</span>';
                    }
                    
                }
                $nestedData['quarter_target'] = $quarterTarget;
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
                $nestedData['update_progress'] = '<a  href="'.$progress_url.'" target="_blank"  ><span class="badge badge-success">Update Progress</span> </a>';
                $nestedData['action'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1" href="'.$show_url.'" target="_blank"  >
                                                <i class="fa fa-eye text-warning" aria-hidden="true" ></i>
                                            </a>
                                            ';
                                            if (auth()->user()->user_type == 'admin') {
                                                $nestedData['action'] .= '
                                                <a class="btn-icon mx-1" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                </a>';
                                            }
                                            // <a class="btn-icon mx-1" href="'.$edit_url.'" target="_blank"  >
                                            // <i class="fa fa-pencil text-primary" aria-hidden="true" ></i>
                                            // </a>
                                            $nestedData['action'] .= '</td></div>';
				
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

    public function activityQuarters(Request $request){
        $activity_id    = $request->activity_id;
        $activity       =     DipActivity::where('id',$activity_id)->first();
        $activity_id = $request->activity_id;
        $columns = array(
			1 => 'id',
			2 => 'project_id',
            3 => 'activity_detail',  
		);
		
		$totalData = ActivityMonths::with('progress')->where('activity_id',$activity_id)->count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = ActivityMonths::with('progress')->where('activity_id',$activity_id)->count();
		$start = $request->input('start');
        $quarters = ActivityMonths::with('progress')->where('activity_id',$activity_id);
          
        $quarters =$quarters->limit($limit)->offset($start)
                                    ->orderBy($order, $dir)->get()->sortByDesc("date_visit");
		$data = array();
		if($quarters){
			foreach($quarters as $r){
                if($r->activity_id == $activity_id && $r->project_id == $activity->project_id ){
                    $nestedData['quarter'] = $r->slug?->slug.'-'.$r->year ?? ''; 
                    $nestedData['activity_target'] = $r->target  ?? ''; 
                    $nestedData['benefit_target'] = $r->beneficiary_target  ?? ''; 
                  
                    $nestedData['women_target'] = $r->progress?->women_target ?? '0' ; 
                    $nestedData['men_target'] = $r->progress?->men_target  ?? '0'; 
                    $nestedData['girls_target'] = $r->progress?->girls_target ?? '0'; 
                    $nestedData['boys_target'] = $r->progress?->boys_target ?? '0'; 
                
                    $nestedData['remarks'] = $r->progress?->remarks ?? '';
                  
                    
                    $data[] = $nestedData;
                }
			
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
        $active = 'basic_project';
        session(['dip' => $active]);
        $editUrl = route('dips.edit',$dip_activity->project_id);
        
        return response()->json([
            'editUrl' => $editUrl
        ]);

    }


    public function show(string $id)
    {
     
        $dip_activity = DipActivity::where('id',$id)->with('months','project','user','user1')->first();
  
        if(!empty($dip_activity->project->detail->province )){
            $province_dip = json_decode($dip_activity->project->detail->province , true);
            
            $provinces = Province::whereIn('province_id', $province_dip)->pluck('province_name');
            
        }
        else{
            $provinces =[];
        }
        if(!empty($dip_activity->project->detail->district )){
            $district_dip = json_decode($dip_activity->project->detail->district , true);
            $districts = District::whereIn('district_id', $district_dip)->pluck('district_name');
        }
        else{
            $districts = '';
        }
        
        addJavascriptFile('assets/js/custom/dip/dipquarteroupdateValidation.js');
        return view('admin.dip.show_dip_activity',compact('dip_activity','districts','provinces'));
    }

    public function edit(string $id)
    {
       
        $dip = DipActivity::where('id',$id)->first();
        $project = Project::with(['quarters' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->where('id',$dip->project_id)->first();
        $start_date = Carbon::parse($project->start_date);
        $end_date = Carbon::parse($project->end_date);

        return view('admin.dip.edit_dip_activity',compact('dip' ,'project'));
    }


    public function update(Request $request, string $id)
    {
       
        $data = $request->except('_token');
       
        $dip_activity = $this->dipactivityRepository->updatedipactivity($data ,$id);
        $active = 'dip_activity';
        session(['dip' => $active]);
        $editUrl = route('dips.edit',$dip_activity->project_id);
        
        return response()->json([
            'editUrl' => $editUrl
        ]);
   
       
    }


    public function delete_month(string $id)
    {
       
        $dip = ActivityMonths::find($id);
        
        if(!empty($dip)){  
            $dip->delete();
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function destroy(string $id)
    {
        
        $dip = DipActivity::find($id);
        $active = 'dip_activity';
        session(['dip' => $active]);
        if(!empty($dip)){  
            $dip->delete();
           
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function activity_progress(){
        
        if(auth()->user()->user_type != 'admin'){
            $projects = Project::where('focal_person',auth()->user()->id)->orderBy('name')->get();
        }else{
            $projects = Project::orderBy('name')->get();
        }
        addVendors(['datatables']);
        return view('admin.dip.activity_progress',compact('projects'));
    }
    public function postprogress($id){

        $activity = DipActivity::where('id',$id)->first();
            
        addJavascriptFile('assets/js/custom/dip/update_progress.js');
       
        return view('admin.dip.update_progress',compact('activity'));
    }
    public function updateprogress(Request $request){
        $quarter = ActivityMonths::where('id',$request->quarter)->first();
      
        
        if(!empty($quarter)){
            $quarter_month = ActivityProgress::where('quarter_id',$request->quarter)
            ->where('project_id',$quarter->project_id)
            ->where('activity_id',$quarter->activity_id)
            ->first();
            if(!empty($quarter_month))
            {
                if($request->attachment){
         
                    $path = storage_path("app/public/activity_progress/attachment" .$request->attachment);
                    
                    if(File::exists($path)){
                        File::delete(storage_path('app/public/activity_progress/attachment'.$request->attachment));
                    }
                    
                    $file = $request->attachment;
                    $attachment = $file->getClientOriginalName();
                    $file->storeAs('public/activity_progress/attachment/',$attachment);
                   
                }
                if($request->image){
             
                    $path = storage_path("app/public/activity_progress/image" .$request->image);
                    
                    if(File::exists($path)){
                        File::delete(storage_path('app/public/activity_progress/image'.$request->image));
                    }
                    
                    $file = $request->image;
                    $image = $file->getClientOriginalName();
                    $file->storeAs('public/activity_progress/image/',$image);
                   
                }
                if(!empty($quarter)){
                    ActivityProgress::where('quarter_id',$request->quarter)->update([
                        'quarter_id'    => $request->quarter,
                        'project_id'    => $quarter->project_id,
                        'activity_id'   => $quarter->activity_id,
                        'women_target'  => $request->women_target,
                        'boys_target'   => $request->boys_target,
                        'girls_target'  => $request->girls_target,
                        'men_target'    => $request->men_target,
                        'remarks'       => $request->remarks,
                        'attachment'    => $attachment,
                        'image'         => $image,
                        'created_by'    => auth()->user()->id
                    ]);
                }
            }
            else{
                if($request->attachment){
         
                    $path = storage_path("app/public/activity_progress/attachment" .$request->attachment);
                    
                    if(File::exists($path)){
                        File::delete(storage_path('app/public/activity_progress/attachment'.$request->attachment));
                    }
                    
                    $file = $request->attachment;
                    $attachment = $file->getClientOriginalName();
                    $file->storeAs('public/activity_progress/attachment/',$attachment);
                   
                }
                if($request->image){
             
                    $path = storage_path("app/public/activity_progress/image" .$request->image);
                    
                    if(File::exists($path)){
                        File::delete(storage_path('app/public/activity_progress/image'.$request->image));
                    }
                    
                    $file = $request->image;
                    $image = $file->getClientOriginalName();
                    $file->storeAs('public/activity_progress/image/',$image);
                   
                }
                ActivityProgress::create([
                    'quarter_id'    => $request->quarter,
                    'project_id'    => $quarter->project_id,
                    'activity_id'   => $quarter->activity_id,
                    'women_target'  => $request->women_target,
                    'boys_target'   => $request->boys_target,
                    'girls_target'  => $request->girls_target,
                    'men_target'    => $request->men_target,
                    'remarks'       => $request->remarks,
                    'attachment'    => $attachment,
                    'image'         => $image,
                    'created_by'    => auth()->user()->id
                ]);
            }
            
            $editUrl = route('activity_dips.progress');
            return response()->json([
                'editUrl' => $editUrl
            ]);
        }
       
    }
   public function fetchquartertarget(Request $request)
    {
       
        $quarterId = $request->quarter_id;
        $quarter = ActivityMonths::find($quarterId);
        $lopTarget = $quarter->target;
        $benefit_target = $quarter->beneficiary_target;

        return response()->json(['lop_target' => $lopTarget,'benefit_target' => $benefit_target ]);
    }


}
