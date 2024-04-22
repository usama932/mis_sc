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
use Illuminate\Support\Facades\Storage;
use File;
use DateTime;
use DateInterval;
use DatePeriod;

use App\Repositories\Interfaces\DipActivityInterface;

class DipActivityController extends Controller
{
    private $dipactivityRepository;

    public function __construct(DipActivityInterface $dipactivityRepository)
    {
        $this->dipactivityRepository = $dipactivityRepository;
    }
    
    public function get_activity_dips(Request $request)
    {
        $dip_id = $request->dip_id;
        $columns = [
            1 => 'id',
            2 => 'project_id',
            3 => 'activity_detail',
        ];
    
        $totalData = DipActivity::when(!empty($dip_id), function ($query) use ($dip_id) {
            $query->where('project_id', $dip_id);
        })->count();
    
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
    
        $totalFiltered = DipActivity::when(!empty($dip_id), function ($query) use ($dip_id) {
            $query->where('project_id', $dip_id);
        })->count();
    
        $start = $request->input('start');
    
        $dipsQuery = DipActivity::when(!empty($dip_id), function ($query) use ($dip_id) {
            $query->where('project_id', $dip_id);
        });
    
        $dips = $dipsQuery->limit($limit)
            ->offset($start)
            ->orderBy($order, $dir)
            ->get()
            ->sortByDesc("date_visit");
    
        $data = [];
    
        if ($dips) {
            foreach ($dips as $r) {
                $show_url = route('activity_dips.show', $r->id);
                $edit_url = route('activity_dips.edit', $r->id);
                $progress_url = route('postprogress', $r->id);
                $text = $r->activity_title ?? "";
                $words = str_word_count($text, 1);
                $lines = array_chunk($words, 10);
                $finalText = implode("<br>", array_map(function ($line) {
                    return implode(" ", $line);
                }, $lines));
    
                $nestedData['activity_number'] = $finalText ?? '';
                $nestedData['activity'] = $r->activity_number ?? '';
                $nestedData['theme'] = $r->scitheme_name->name ?? '';
                $nestedData['sub_theme'] = $r->scisubtheme_name?->maintheme?->name .' - '.$r->scisubtheme_name?->name ?? '';
                $nestedData['project'] = $r->project->name ?? '';
                $nestedData['lop_target'] = $r->lop_target ?? '';
                $quarterTarget = '<ul style="list-style-type: none; padding: 0; margin: 0;">';
                foreach ($r->months as $month) {
                    if ($month->activity_id == $r->id && $month->project_id == $r->project_id) {
                        $quarterTarget .= '<li><strong>' . $month->quarter.'-'.$month->year . ':</strong> ' . $month->target . '</li>';
                    }
                }
                $quarterTarget .= '</ul>';
                $nestedData['quarter_target'] = $quarterTarget;
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('M d ,Y', strtotime($r->created_at)). '<br>'. date('h:iA', strtotime($r->created_at)) ?? '';
                $nestedData['update_progress'] = '<a  href="' . $progress_url . '"><span class="badge badge-success">Update Progress</span></a>';
    
                $nestedData['action'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1" href="' . $show_url . '" title="Show Activity" href="javascript:void(0)">
                                                <i class="fa fa-eye text-warning" aria-hidden="true"></i>
                                            </a>';
                                            if (!empty($request->url) && $request->url == 'quarter_progress') {
                                                $nestedData['action'] .= ' ';
                                            } else {
                                                $nestedData['action'] .= '
                                                <a class="btn-icon mx-1" href="' . $edit_url . '" title="Edit Activity" href="javascript:void(0)">
                                                    <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                                                </a>';
                                            }
    
                                            if (auth()->user()->user_type == 'admin') {
                                                $nestedData['action'] .= '
                                                                        <a class="btn-icon mx-1" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete Activity" href="javascript:void(0)">
                                                                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                                        </a>';
                                            }
    
                $nestedData['action'] .= '</td></div>';
    
                $data[] = $nestedData;
            }
        }
    
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];
    
        return response()->json($json_data);
    }
    
    public function get_activity_quarters(Request $request){
           
        $project_id = $request->project_id;
        $activity_id = $request->activity_id;
      
        $columns = array(
			1 => 'id',
			2 => 'project_id',
            3 => 'activity_detail',
		);
	
        $totalData = ActivityMonths::where('project_id',$project_id)->where('activity_id',$activity_id)->count();
        
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
       
        $totalFiltered = ActivityMonths::where('project_id',$project_id)->where('activity_id',$activity_id)->count();
      
		$start = $request->input('start');
		
        $quarters = ActivityMonths::where('project_id',$project_id)->where('activity_id',$activity_id);
        
        
        $quarters =$quarters->limit($limit)->offset($start)
                                    ->orderBy($order, $dir)->get()->sortByDesc("date_visit");
		$data = array();
		if($quarters){
			foreach($quarters as $r){
                $nestedData['quarter'] = $r->quarter.'-'.$r->year ?? ''; 
                $nestedData['activity_target'] = $r->target  ?? ''; 
                $nestedData['benefit_target'] = $r->beneficiary_target  ?? ''; 
                $nestedData['created_by'] = $r->user?->name  ?? ''; 
                $nestedData['action'] = '<div>
                                        <td>
                                            <a class="btn-icon mx-1" title="Edit Activity Quarter" data-bs-toggle="modal" data-bs-target="#editquarter_'.$r->id.'" href="javascript:void(0)">
                                                <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                                            </a>';
                                            if (auth()->user()->user_type == 'admin') {
                                                $nestedData['action'] .= '
                                                <a class="btn-icon mx-1" onclick="event.preventDefault();del('.$r->id.');" title="Delete Ac" href="javascript:void(0)">
                                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                </a>';
                                            }
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
      
        $activity_id    =   $request->activity_id;
        $activity       =  DipActivity::where('id',$activity_id)->first();
        $activity_id = $request->activity_id;
        $columns = array(
			1 => 'id',
			2 => 'project_id',
            3 => 'activity_detail',  
		);
		
		$totalData = ActivityMonths::with('progress')->where('activity_id',$activity_id)->where('project_id',$activity->project_id)->count();
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = ActivityMonths::with('progress')->where('activity_id',$activity_id)->where('project_id',$activity->project_id)->count();
		$start = $request->input('start');
        $quarters = ActivityMonths::with('progress')->where('activity_id',$activity_id)->where('project_id',$activity->project_id);
          
        $quarters =$quarters->limit($limit)->offset($start)
                                    ->orderBy($order, $dir)->get()->sortByDesc("date_visit");
		$data = array();
		if($quarters){
			foreach($quarters as $r){
                if($r->activity_id == $activity_id && $r->project_id == $activity->project_id ){
                    $nestedData['quarter'] = $r->quarter.'-'.$r->year ?? ''; 
                    $nestedData['activity_target'] = '<span style="style="background-color: grey"">'.$r->target  ?? ''.'</span>'; 
                    $nestedData['benefit_target'] = $r->beneficiary_target  ?? ''; 
                    $nestedData['women_target'] = $r->progress?->women_target ?? '0' ; 
                    $nestedData['men_target'] = $r->progress?->men_target  ?? '0'; 
                    $nestedData['girls_target'] = $r->progress?->girls_target ?? '0'; 
                    $nestedData['boys_target'] = $r->progress?->boys_target ?? '0'; 
                    $nestedData['pwd_target'] = $r->progress?->pwd_target ?? '0'; 
                    $nestedData['activity_acheive'] = $r->progress?->activity_target ?? '0';  
                    $nestedData['status'] = $r->status;
                    $nestedData['remarks'] = $r->progress?->remarks ?? '';
                    $nestedData['created_at'] = date('M d ,Y', strtotime($r->created_at )) ?? '';
                    $nestedData['created_by'] = $r->user?->remarks ?? '';
                    if(!empty($r->completion_date) && $r->completion_date != Null){
                        $nestedData['completion_date'] ='<span class="fs-9" style="font-size: 9px;">'.date('M d ,Y', strtotime($r->completion_date ?? '')).'</span>';
                    }else{
                        $nestedData['completion_date'] ='';
                    }
                    if(!empty($r->progress?->complete_date) && $r->progress?->complete_date != Null){
                        $nestedData['completed_date'] ='<span class="fs-9" style="font-size: 9px;">'.date('M d ,Y', strtotime($r->progress?->complete_date ?? '')).'</span>';
                    }else{
                        $nestedData['completed_date'] ='';
                    }
                    
                    if(!empty($r->progress?->image)){
                        $imagePathPwd = asset("storage/activity_progress/image/" .$r->progress?->image);                  
                        $nestedData['image'] = '<img src="' . $imagePathPwd . '" alt="Image"  style="width: 100px ; class="thumbnail " onclick="previewImage(this)">';
                    }
                    else{
                        $nestedData['image'] = '';
                    }

                   
                    if(!empty($r->progress?->attachment)){
                        $download_url =  route('download_progress_attachment',$r->progress?->attachment );
                        $nestedData['attachment'] = '<a title="Edit" class=""
                        href="'.$download_url.'" ><i class="fa fa-download text-dark" aria-hidden="true"></i></a>'; 
                    }else{
                        $nestedData['attachment'] = ''; 
                    }
                   
                    if(!empty($r->progress)){
                        if($r->status == 'Posted'){
                            $nestedData['action'] = '';
                        }
                        elseif($r->status == 'Returned'){

                            $nestedData['action'] = '<div>
                            <td><a class="" href="javascript:void(0)" title="Edit status"  onclick="event.preventDefault();edit_status('.$r->progress->quarter_id.');">
                                <span class="badge bg-success text-white">Edit</span>
                            </a></td></div>
                            ';
                        }
                       
                        else{
                            $nestedData['action'] = '<div>
                            <td><a class="" href="javascript:void(0)" title="Update status" onclick="event.preventDefault();update_status('.$r->progress->quarter_id.');">
                                <span class="badge bg-info btn-sm text-white">Update Status</span>
                            </a></td></div>
                            ';
                        }
                    }   
                    else{
                            $nestedData['action'] = '<div>
                            <td><a class="" title="Add Progress" onclick="event.preventDefault();add_progress('.$r->id.');"   href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_progress_'.$r->id.'" >
                                <span class="badge bg-primary  text-dark">Add Progress</span>
                            </a></td></div>
                            ';
                        
                    }
                  
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
          
        $project = Project::where()->with([ 'quarters' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->where('id', $dip->project_id)->first();
        addJavascriptFile('assets/js/custom/project/projectupdatetheme.js');
      
        return view('admin.dip.edit_dip_activity',compact('dip','project'));
    }
   
    public function create()
    {
        if(auth()->user()->user_type != 'admin'){
            $projects = Project::orWhere('focal_person' ,auth()->user()->id)->orWhereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            })->orderBy('name')->get();
        }else{
            $projects= Project::orderBy('name')->get();
        }
        
      
        addJavascriptFile('assets/js/custom/dip/dip_activity_validations.js');
        return view('admin.dip.activity.create',compact('projects'));
    }

    public function store(Request $request)
    {
        
        $collection = collect($request->activities);
        $duplicates = $collection->duplicates('quarter')->groupBy('quarter')->map(function ($items) {
            return $items->all();
        })->toArray();

      
        
        $data = $request->except('_token');
        $dip = DipActivity::orWhere('activity_title',$request->activity)->orWhere('activity_number',$request->activity_number)->where('subtheme_id',$request->sub_theme)->first();
        $editUrl = route('dips.edit',$request->project_id);
       
        if(empty($dip)){
            if($duplicates == []){
               
                $dip_activity = $this->dipactivityRepository->storedipactivity($data);
                $active = 'dip_activity';
                session(['dip_edit' => $active]);
                return response()->json([
                    'editUrl' => $editUrl,
                    'error'    => false,
                    'message' => "Activity Submitted",
                ]);
            }
            else{
                return response()->json([
                    'editUrl' => $editUrl,
                    'error' => true,
                    'message' => "Duplicate target enter",
                ]);
            }
        }
        else{
            return response()->json([
                'editUrl' => $editUrl,
                'error' => true,
                'message' => "Activity already Exist",
            ]);
           
        }   
      

    }

    public function show(string $id)
    {
        $dip_activity = DipActivity::where('id',$id)->with('months','project','project.themes','user','user1')->first();
  
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

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/dip/dipquarteroupdateValidation.js');
        addJavascriptFile('assets/js/custom/dip/dipquartereditValidation.js');
        //addJavascriptFile('assets/js/custom/dip/add_progress.js');
        $months = ActivityProgress::where('activity_id',$id)->where('project_id',$dip_activity->project_id)->get();
        $quarters = ActivityMonths::where('activity_id',$id)->where('project_id',$dip_activity->project_id)->get();
        return view('admin.dip.show_dip_activity',compact('dip_activity','districts','provinces','months','quarters'));
    }

    public function edit(string $id)
    {
       
        $dip = DipActivity::where('id',$id)->first();
        $project = Project::where('id',$dip->project_id)->first();
        $activty_quarters = ActivityMonths::where('activity_id',$id)->where('project_id',$dip->project_id)->get();
        $slugs = [];

        foreach ($dip->months as $month) {
            if (isset($month->slug->slug)) {
                $slugs[] = $month->slug->slug . '-' . $month->year;
            }
        }
        $start = new DateTime($project->start_date);
        $end = new DateTime($project->end_date);
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);
        
        $quarters = collect();
        
        foreach ($period as $date) {
            $quarters->push($date->format('M-Y'));
        }
        addJavascriptFile('assets/js/custom/dip/dip_activity_validations.js');
        return view('admin.dip.edit_dip_activity',compact('dip' ,'project','activty_quarters','slugs','quarters'));
    }


    public function update(Request $request, string $id)
    {
        $collection = collect($request->activities);
        $filteredCollection = $collection->reject(function ($item) {
            return !isset($item['quarter']) || $item['quarter'] === null;
        });
        
        $duplicates = $filteredCollection
            ->duplicates('quarter')
            ->groupBy('quarter')
            ->map(function ($items) {
                return $items->all();
            })
            ->toArray();
        
      
        $data = $request->except('_token');
        $editUrl = route('dips.edit',$request->project_id);
       
            if($duplicates == []){
               
                $data = $request->except('_token');
                $dip = DipActivity::where('id',$id)->first();
                $dip_activity = $this->dipactivityRepository->updatedipactivity($data ,$id);
                $active = 'dip_activity';
                session(['dip_edit' => $active]);
                return response()->json([
                    'editUrl' => $editUrl,
                    'error'    => false,
                    'message' => "Activity Updated",
                ]);
            }
            else{
                return response()->json([
                    'editUrl' => $editUrl,
                    'error' => true,
                    'message' => "Duplicate target enter",
                ]);
            }
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
        $project_id =  $dip->project_id;
        $active = 'dip_activity';
        session()->put(['dip_edit' => $active]);
        if(!empty($dip)){  
           
            if(!empty($dip->months)){
                $dip->months->each(function ($month) {
                    $month->progress?->delete();
                });
            }
            $dip->months->each?->delete();
            
            $dip->delete();
            
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function delete_progress( $id)
    {
        $activity_progress = ActivityProgress::find($id);
        if(!empty($activity_progress)){  
            $activity_progress->delete();
            
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function activity_progress(){
        
        if(auth()->user()->user_type != 'admin'){
            $projects = Project::orWhere('focal_person',auth()->user()->id)->orWhereHas('partners', function ($query) {
                                    $query->where('email', auth()->user()->email);
                                })->orderBy('name')->get();
        }else{
            $projects = Project::orderBy('name')->get();
        }
        addVendors(['datatables']);
        return view('admin.dip.activity_progress',compact('projects'));
    }

    public function postprogress($id){
        $activity = DipActivity::where('id',$id)->first();
        $progressMonths = $activity->months()->pluck('id')->toArray();
        
        $quarters = ActivityProgress::whereIn('quarter_id', $progressMonths)
                                    ->pluck('quarter_id')->toArray();
              
        addJavascriptFile('assets/js/custom/dip/update_progress.js');
       
        return view('admin.dip.update_progress',compact('activity','quarters'));
    }

    public function updateprogress(Request $request){
       
        $quarter = ActivityMonths::where('id',$request->quarter)->first();
        $editUrl = route('activity_dips.show',$quarter->activity_id);

        if($request->activity_target > $request->lop_target) {
            $editUrl = redirect()->back();
            return response()->json([
                'editUrl' => $editUrl,
                'error'   => true,
                'message' => "Quarterly Progress must less than Quarterly target"
            ]);
        }
        $beneficiary_target = $request->women_target + $request->men_target + $request->girls_target + $request->boys_target;

        if($beneficiary_target > intval($request->benefit_target)) {
            $editUrl = redirect()->back();
            return response()->json([
                'editUrl' => $editUrl,
                'error'   => true,
                'message' => "Beneficiaries progress must be less than or equal to Beneficiaries Target"
            ]);
        }
        
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
         
                    $path = storage_path("app/public/activity_progress/attachment" . $request->attachment);
                    
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
                    'complete_date' => $request->complete_date,
                    'image'         => $image,
                    'created_by'    => auth()->user()->id
                ]);
               
            }
            ActivityMonths::where('id',$request->quarter)->update([
                'status'   => "To be Reviewed",
            ]);
            return response()->json([
                'editUrl' => $editUrl,
                'error'   => false,
                'message' => "Quarter progress submitted successfully"
            ]);
           
        }
        else{
            $editUrl = redirect()->back();
            return response()->json([
                'editUrl' => $editUrl,
                'error'   => true,
                'message' => "Quarter not found"
            ]);
        }
       
    }

    public function quarterstatus_update(Request $request,$id){
       
        $quarter = ActivityMonths::where('id',$id)->update([
            'status' => $request->status,
          
        ]);
        return redirect()->back();
    }

    public function quarterstatus_edit(Request $request,$id){
      
        $quarters = ActivityProgress::where('id',$id)->first();
        $quarter = ActivityProgress::where('id',$id)->update([
                'activity_target'   => $request->activity_target,
                'women_target'      => $request->women_target,
                'men_target'        => $request->men_target,
                'girls_target'      => $request->girls_target,
                'boys_target'       => $request->boys_target,
                'pwd_target'        => $request->pwd_target,
                'remarks'           => $request->remarks,
        ]);
        ActivityMonths::where('id',$quarters->quarter_id)->update([
            'status'   => "To be Reviewed",
        ]);
        return response()->json(['error' => true,'quarter' => $quarter ]);
    }

    public function activtyquarter_update(Request $request,$id){
       
        $quarter = ActivityMonths::where('id',$id)->update([
            'target' => $request->target_quarter,
            'beneficiary_target' => $request->target_benefit,
        ]);
       
        return response()->json(['error' => false,'quarter' => $quarter ]);
    }

    public function fetchquartertarget(Request $request)
    {
       
        $quarterId = $request->quarter_id;
        $quarter = ActivityMonths::find($quarterId);
        $lopTarget = $quarter->target;
        $benefit_target = $quarter->beneficiary_target;
        $complete_date = $quarter->completion_date;
    
        return response()->json(['lop_target' => $lopTarget,'benefit_target' => $benefit_target ,'complete_date' => $complete_date]);
    }

    public function download_progress_attachment($filename)
    {
     
      
        $path = public_path("storage/activity_progress/attachment/" . $filename);

        if (!file_exists($path)) {
            // Output error or log it
            return response()->json(['error' => 'File not found'], 404);
        }
        
        return response()->download($path, $filename);
        
    }


    public function add_progress(Request $request){
        

        $quarter = ActivityMonths::where('id',$request->id)->first();
        addJavascriptFile('assets/js/custom/dip/add_progress.js');
        return view('admin.dip.activity.add_progress',compact('quarter'));
    }


    public function update_status(Request $request)
    {
        
       $activity =  ActivityMonths::where('id',$request->id)->first();
       $progress =  $activity->progress ?? '';
       return view('admin.dip.activity.update_progress',compact('progress'));
    }

    public function edit_progress(Request $request)
    {
        $activity =  ActivityMonths::where('id',$request->id)->first();
        $progress =  $activity->progress ?? '';
        return view('admin.dip.activity.edit_progress',compact('progress'));
    }
}
