<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DipActivity;
use Illuminate\Support\Facades\Auth;
use App\Models\District;
use App\Models\ActivityMonths;
use App\Models\Province;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectActivityType;
use Illuminate\Support\Facades\Mail;
use App\Models\ActivityProgress;
use App\Models\SCITheme;
use App\Models\SciSubTheme;
use File;
use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use App\Repositories\Interfaces\DipActivityInterface;

class   DipActivityController extends Controller
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
     
        $dir = $request->input('order.0.dir');
    
        $start = $request->input('start');
    
        $dipsQuery = DipActivity::when(!empty($dip_id), function ($query) use ($dip_id) {
            $query->where('project_id', $dip_id);
        });
        $userType = auth()->user()->user_type;
        $user_id = auth()->user()->id;

        $userRole =  $role = Auth::user()->getRoleNames()->first();
     
        if($userRole == "focal person"){
            $role = 'f_p';
        }
        elseif($userRole == "partner"){
            $role = 'partner';
        }else{
            $role = "all";
        }

        //projects 
        $user_id = auth()->user()->id;
        $user = $user_id.'';
       
        if ($role == 'f_p') {
            $dipsQuery->whereHas('project', function ($query) use ($user) {
                $query->whereJsonContains('focal_person', $user);
            });
        }
        
        elseif($role == 'partner'){
            $dipsQuery->whereHas('project', function ($query) {
                $query->whereHas('partners', function ($partnersQuery) {
                    $partnersQuery->where('email', auth()->user()->email);
                });
            });
        }
        else{
         
            $dipsQuery;
        }
        if(!empty($request->subtheme_id) &&  $request->subtheme_id != null){
            $dipsQuery->where('subtheme_id',$request->subtheme_id);
        }
        $totalFiltered =  $dipsQuery->count();
        $dips = $dipsQuery
            ->orderByActivityNumber()
            ->get();
   
        $data = [];
        
        if ($dips) {
            foreach ($dips as $r) {
                $show_url = route('activity_dips.show', $r->id);
                $edit_url = route('activity_dips.edit', $r->id);
                $progress_url = route('postprogress', $r->id);
                $text = $r->activity_title ?? "";
                $words = str_word_count($text, 1);
                $lines = array_chunk($words, 5);
                $finalText = implode("<br>", array_map(function ($line) {
                    return implode(" ", $line);
                }, $lines));
    
                $nestedData['activity_number'] = $finalText ?? '';
                $nestedData['activity'] = $r->activity_number ?? '';
                $nestedData['theme'] = $r->scisubtheme_name?->maintheme?->name ?? '';
                $nestedData['sub_theme'] =  $r->scisubtheme_name?->name ?? '';
                $nestedData['activity_type'] = $r->activity_type?->activity_type?->name 
                             ? ($r->activity_type?->activity_type?->name . ' (' . $r->activity_type?->name . ')') 
                             : '';
                $nestedData['project'] = $r->project->name ?? '';
                $nestedData['lop_target'] = $r->lop_target ?? '';
                $quarterTarget = '<ul style="list-style-type: none; padding: 0; margin: 0;">';
                foreach ($r->months as $month) {
                    if ($month->activity_id == $r->id && $month->project_id == $r->project_id) {
                        $quarterTarget .= '<li><strong>' . $month->quarter.'-'.$month->year . ':</strong> ' . $month->target . ', </li>';
                    }
                }
                $quarterTarget .= '</ul>';
                $nestedData['quarter_target'] = $quarterTarget;
                $nestedData['created_by'] = $r->user->name ?? '';
                $nestedData['created_at'] = date('M d, Y', strtotime($r->created_at)). '<br>'. date('h:iA', strtotime($r->created_at)) ?? '';
                
                $nestedData['update_progress'] = '<a href="' . $progress_url . '"><span class="badge badge-success">Update Progress</span></a>';
                
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

    public function get_complete_activity(Request $request)
    {   
        
        $dipId = $request->dip_id;
        $user_idd = $request->user;
        $subtheme = $request->subtheme;
        $user = auth()->user();
        $userId =   $user->id.'';
        $userRole = $user->getRoleNames()->first();
    
        $dipsQuery = ActivityMonths::when($dipId, function ($query) use ($dipId) {
            $query->where('project_id', $dipId);
        });
        if(!empty($user_idd) && $user_idd == null){
            $dipsQuery = ActivityMonths::when($user_idd, function ($query) use ($user_idd) {
                $query->where('created_by', $user_idd);
            });
        }
        if(!empty($subtheme) && $subtheme == null){
            $dipsQuery = ActivityMonths::whereHas('activity', function ($query) use ($subtheme) {
                $query->where('subtheme_id', $subtheme);
            });
        }
        switch ($userRole) {
            case 'focal person':
                $dipsQuery->whereHas('project', function ($query) use ($userId) {
                    $query->whereJsonContains('focal_person', $userId);
                });
                break;
            case 'partner':
                $dipsQuery->whereHas('project', function ($query) use ($user) {
                    $query->whereHas('partners', function ($partnersQuery) use ($user) {
                        $partnersQuery->where('email', $user->email);
                    });
                });
            break;
        }

        if ($request->status) {
            $dipsQuery->where('status', $request->status)->whereHas('progress');
        
        } else {
            $dipsQuery->whereIn('status', ['To be Reviewed', 'Returned', 'Posted'])->whereHas('progress');
        }
        $totalFiltered = $dipsQuery->count();
        $totalData = $dipsQuery->count();
        $dips = $dipsQuery->with(['activity' => function ($query) {
                            return $query->orderByRaw("REPLACE(activity_number, '.', '') + 0");
                        }])
                        ->get();
    
        // Sort the results by activity_number of the related activity
        $sortedDips = $dips->sortBy(function ($dip) {
            return $dip->activity ? $dip->activity->activity_number : '';
        }, SORT_NATURAL);
        
        $data = [];
        foreach ($dips as $completemonth) {
            $show_url = route('activity_dips.show', $completemonth->activity->id);
            $deleteUrl = route('indicatorActivityDelete', $completemonth->activity->id);
    
            $progressUrl = route('postprogress', $completemonth->activity->id);
            $text = $completemonth->activity->activity_title ?? "";
            $words = str_word_count($text, 1);
            $lines = array_chunk($words, 5  );
            $finalText = implode("<br>", array_map(fn($line) => implode(" ", $line), $lines));

            $remarks = $completemonth->remarks ?? "";
            $remarkwords = str_word_count($remarks, 1);
            $remarklines = array_chunk($remarkwords, 5  );
            $finalRemarks = implode("<br>", array_map(fn($line) => implode(" ", $line),  $remarklines));
            $update_status = ''; // Default status

            // Define role-based conditions
            $roleConditions = [
                'To be Reviewed' => ['partner', 'focal person', 'administrator'],
                'Reviewed' => ['Meal Manager','Meal Coordinator', 'administrator'],
                'Posted' => ['administrator'],
                'Returned' => ['partner', 'focal person', 'administrator'],
            ];

            // Define status-based labels
            $statusLabels = [
                'To be Reviewed' => 'Update Progress',
                'Reviewed' => 'Update Progress',
                'Posted' => 'Update Progress',
                'Returned' => 'Edit Progress',
            ];

            // Check if the current status exists in role conditions and user has the required role
            if (isset($roleConditions[$completemonth->status]) && auth()->user()->hasAnyRole($roleConditions[$completemonth->status])) {
                $label = $statusLabels[$completemonth->status] ?? 'Update Progress'; // Default to 'Update Progress' if label is not set
                
                if (auth()->user()->hasRole('partner') && $completemonth->status == 'Returned' ) {
                    $update_status = '<td><a class="" href="javascript:void(0)" title="Edit status" onclick="event.preventDefault();edit_status(' . $completemonth->id . ');"><i class="fa fa-pencil text-info" aria-hidden="true"></i></a></td>';  
                } elseif (auth()->user()->hasRole('focal person') && $completemonth->status == 'To be Reviewed' && $completemonth->progress()->exists()) {
                    $update_status = '<td><a class="mx-3" href="javascript:void(0)" title="Update status" onclick="event.preventDefault();update_status(' . $completemonth->id . ');"><i class="far fa-compass text-primary"></i></a></td>';
                } 
                else if (auth()->user()->hasRole('Meal Manager') || auth()->user()->hasRole('Meal Coordinator')  && $completemonth->status == 'Reviewed' ){
                    $update_status = '<td><a class="mx-3" href="javascript:void(0)" title="Update status" onclick="event.preventDefault();update_status(' . $completemonth->id . ');"><i class="far fa-compass text-primary"></i></a></td>';
                }
                else if (auth()->user()->hasRole('administrator') || auth()->user()->hasRole('Meal Coordinator')  && $completemonth->status == 'Reviewed' ){
                    $update_status = '<td><a class="mx-3" href="javascript:void(0)" title="Edit status" onclick="event.preventDefault();edit_status(' . $completemonth->id . ');"><i class="fa fa-pencil text-info" aria-hidden="true"></i></a></td><td><a class="" href="javascript:void(0)" title="Update status" onclick="event.preventDefault();update_status(' . $completemonth->id . ');"><i class="far fa-compass text-primary"></i></a></td>';
                }
            }
            $nestedData = [
                'activity_title'            => $completemonth->activity->activity_number.'  '.$finalText,
                'project'                   => $completemonth->project->name ?? '',
                'beneficiary_target'        => $completemonth->beneficiary_target ?? '',
                'activity_lop_target'       => $completemonth->target ?? '',
                'expected_completion_date'  => date('M d, Y', strtotime($completemonth->completion_date)),
                'quarter_target'            => $completemonth->quarter . '-' . $completemonth->year,
                'status'                    => $completemonth->status ?? "Wait For Progress",
                'remarks'                   => $finalRemarks ?? "",
                'image'                     => !empty($completemonth->progress->image)
                                                ? '<img src="' . asset("storage/activity_progress/image/{$completemonth->project->sof}/" . $completemonth->progress->image) . '" 
                                                    alt="Image" style="width: 100px; cursor: pointer;" class="thumbnail" onclick="openImageInNewTab(\'' . asset("storage/activity_progress/image/{$completemonth->project->sof}/" . $completemonth->progress->image) . '\')">'
                                                : '',
                'attachment'                => !empty($completemonth->progress->attachment) ? '<a title="Edit" class="" href="'.route('download_progress_attachment', $completemonth->progress->id).'"><i class="fa fa-download text-dark" aria-hidden="true"></i></a>' : '',
                'action'                    => '<div class="d-flex justify-content-between"><td>'.$update_status.'<div><td><a class="" href="' . $show_url . '" target="_blank" title="Show Activity" href="javascript:void(0)"><i class="fa fa-eye text-success mx-3" aria-hidden="true"></i></a></td></div><div><td>',  
                // 'action'                 => '<div><td><a class="badge badge-primary" href="' . $show_url . '" title="Show Activity" href="javascript:void(0)">Show Activity</a></td></div>',
            ];
    
            $data[] = $nestedData;           
        }
    
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ]);
    }

    public function getActivityDue(Request $request)
    {   
  
        $dipId = $request->dip_id;
        $user = auth()->user();
        $user_idd = $request->user;
        $subtheme = $request->subtheme;
        $userId = $user->id . '';
        $userRole = $user->getRoleNames()->first();
        $dipsQuery = ActivityMonths::query();
        if(!empty($dipId) && $dipId != null){
           
            $dipsQuery = ActivityMonths::when($dipId, function ($query) use ($dipId) {
                $query->where('project_id', $dipId);
            });
        }
        if(!empty($user_idd) && $user_idd != null){
          
            $dipsQuery = ActivityMonths::when($user_idd, function ($query) use ($user_idd) {
                $query->where('created_by', $user_idd);
            });
        }
        if(!empty($subtheme) && $subtheme != null){
            
            $dipsQuery = ActivityMonths::whereHas('activity', function ($query) use ($subtheme) {
                $query->where('subtheme_id', $subtheme);
            });
        }
    
        switch ($userRole) {
            case 'focal person':
                $dipsQuery = $dipsQuery->whereHas('project', function ($query) use ($userId) {
                    $query->whereJsonContains('focal_person', $userId);
                });
                break;
            case 'partner':
                $dipsQuery = $dipsQuery->whereHas('project', function ($query) use ($user) {
                    $query->whereHas('partners', function ($partnersQuery) use ($user) {
                        $partnersQuery->where('email', $user->email);
                    });
                });
                break;
        }
    
        $dipsMonths = $dipsQuery->doesntHave('progress')->whereDate('completion_date', '<', Carbon::now()->toDateString());
    
        $totalFiltered = $dipsMonths->count();
        $totalData = $dipsMonths->count();
        $dips = $dipsMonths
            ->with(['activity' => function ($query) {
                return $query->orderByRaw("REPLACE(activity_number, '.', '') + 0");
            }])
            ->orderByRaw("CAST(completion_date AS DATE) ASC") 
            ->get();
    
        $data = [];
        foreach ($dips as $dipmonth) {
            $show_url = route('activity_dips.show', $dipmonth->activity->id);
            $editUrl = route('activity_dips.edit', $dipmonth->activity->id);
    
            $progressUrl = route('postprogress', $dipmonth->activity->id);
            $text = $dipmonth->activity->activity_title ?? "";
            $words = str_word_count($text, 1);
            $lines = array_chunk($words, 5  );
            $finalText = implode("<br>", array_map(fn($line) => implode(" ", $line), $lines));
    
            $nestedData = [
                'activity_title'            => $dipmonth->activity->activity_number.'  '.$finalText,
                'project'                   => $dipmonth->project->name ?? '',
                'beneficiary_target'        => $dipmonth->beneficiary_target ?? '',
                'activity_lop_target'       => $dipmonth->target ?? '',
                'expected_completion_date'  => date('M d, Y', strtotime($dipmonth->completion_date)),
                'quarter_target'            => $dipmonth->quarter . '-' . $dipmonth->year,
                'created_by'                => $dipmonth->user->name ?? '',
                'created_at'                => date('M d, Y', strtotime($dipmonth->created_at)) . '<br>' . date('h:iA', strtotime($dipmonth->created_at)),
                'update_progress'           => '<a href="' . $progressUrl . '"><span class="badge badge-success">Update Progress</span></a>',
                'action'                    => '<div><td><a class="badge badge-primary mx-1" href="' . $show_url . '" title="Show Activity" href="javascript:void(0)">Show Activity</a></td></div>',
            ];
    
            $data[] = $nestedData;
        }
    
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ]);
    }

    public function get_activity_quarters(Request $request){
           
        $project_id = $request->project_id;
        $activity_id = $request->activity_id;
      
        $columns = array(
			1 => 'id',
			2 => 'project_id',
            3 => 'activity_detail',
		);
	
      
        
		$limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
       
      
		$start = $request->input('start');
		
        $quarters = ActivityMonths::where('project_id',$project_id)->where('activity_id',$activity_id);
        
        $totalData = $quarters->count();
        
        $totalFiltered = $quarters->count();
        $quarters =$quarters->limit($limit)->offset($start)
                                    ->orderBy('$order, $dir')->get();
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

    public function activityQuarters(Request $request)
    {
        $activity_id = $request->activity_id;
        $activity = DipActivity::where('id', $activity_id)->first();
        
        $columns = [
            1 => 'id',
            2 => 'project_id',
            3 => 'activity_detail',
        ];
        
        $limit = $request->input('length');
        $start = $request->input('start');
        
        $quartersQuery = ActivityMonths::with('progress')
            ->where('activity_id', $activity_id)
            ->where('project_id', $activity->project_id);
        
        $totalFiltered = $quartersQuery->count();
        $totalData = $quartersQuery->count();
        $quarters = $quartersQuery->orderBy('completion_date')->offset($start)->limit($limit)->get();
        
        $data = [];
        if ($quarters) {
            foreach ($quarters as $quarter) {
                $project = Project::where('id',$quarter->project_id)->first();
                if ($quarter->activity_id == $activity_id && $quarter->project_id == $activity->project_id) {
                    $nestedData = [
                        'quarter'           => $quarter->quarter . '-' . $quarter->year ?? '',
                        'activity_target'   => '<span  class="p-2 badeg badge-warning text-dark">' . ($quarter->target ?? '') . '</span>',
                        'benefit_target'    => '<span  class="p-2 badeg badge-warning text-dark">' .($quarter->beneficiary_target ?? '') . '</span>',
                        'women_target'      => $quarter->progress ? $quarter->progress->women_target ?? '0' : '0',
                        'men_target'        => $quarter->progress ? $quarter->progress->men_target ?? '0' : '0',
                        'girls_target'      => $quarter->progress ? $quarter->progress->girls_target ?? '0' : '0',
                        'boys_target'       => $quarter->progress ? $quarter->progress->boys_target ?? '0' : '0',
                        'pwd_target'        => $quarter->progress ? $quarter->progress->pwd_target ?? '0' : '0',
                        'activity_acheive'  => $quarter->progress ? $quarter->progress->activity_target ?? '0' : '0',
                        'status'            => $quarter->progress ? $quarter->status ?? $quarter->status : '',
                        'remarks'           => $quarter->progress ? $quarter->progress->remarks ?? '' : '',
                        'created_at'        => $quarter->created_at ? date('M d, Y', strtotime($quarter->created_at)) : '',
                        'created_by'        => $quarter->user ? $quarter->user->name  ?? '' : '',
                        'updated_by'        => $quarter->user1 ? $quarter->user1->name ?? '' : '',
                        'updated_at'        => $quarter->updated_at ? date('M d, Y', strtotime($quarter->updated_at)) : '',
                        'completion_date'   => !empty($quarter->completion_date) ? '<span class="fs-9">' . date('M d, Y', strtotime($quarter->completion_date)) . '</span>' : '',
                        'completed_date'    => $quarter->progress && !empty($quarter->progress->complete_date) ? '<span class="fs-9">' . date('M d, Y', strtotime($quarter->progress->complete_date)) . '</span>': '',
                        'image'             => !empty($quarter->progress->image) ? '<img src="'.asset("storage/activity_progress/image/{$project->sof}/".$quarter->progress->image).'" alt="Image" style="width: 100px;" class="thumbnail" onclick="previewImage(this)">' : '',
                        'attachment'        => !empty($quarter->progress->attachment) ? '<a title="Edit" class="" href="'.route('download_progress_attachment', $quarter->progress->id).'"><i class="fa fa-download text-dark" aria-hidden="true"></i></a>' : '',
                        'action'            => '',
                    ];
                    $twoMonthsFromNow = Carbon::now()->addMonths(0);
                    if ($quarter->status == 'Returned' ) {
                        $nestedData['action'] = '<div><td><a class="" href="javascript:void(0)" title="Edit status" onclick="event.preventDefault();edit_status(' . $quarter->progress?->quarter_id . ');"><span class="badge bg-success text-white">Edit</span></a></td></div>';
                    } elseif (!auth()->user()->hasRole('partner') && $quarter->status == 'To be Reviewed' && $quarter->progress()->exists()) {
                        $nestedData['action'] = '<div><td><a class="" href="javascript:void(0)" title="Update status" onclick="event.preventDefault();update_status(' . $quarter->progress?->quarter_id . ');"><span class="badge bg-info btn-sm text-white">Update Status</span></a></td></div>';
                    } elseif (!$quarter->progress()->exists() && $quarter->completion_date <= $twoMonthsFromNow) {
                        $nestedData['action'] = '<div><td><a class="" title="Add Progress" onclick="event.preventDefault();add_progress(' . $quarter->id . ');" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_progress_' . $quarter->id . '"><span class="badge bg-primary text-dark">Add Progress</span></a></td></div>';
                    }
        
                    $data[] = $nestedData;
                }
            }
        }
        
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        ];
       
        echo json_encode($json_data);
        
    }

    public function edit_activity_dips(Request $request){
        
        $dip = DipActivity::where('id',$request->id)->first();
          
        $project = Project::where('id', $dip->project_id)->first();
        addJavascriptFile('assets/js/custom/project/projectupdatetheme.js');
      
        return view('admin.dip.edit_dip_activity',compact('dip','project'));
    }
   
    public function create()
    {
        $user_id = auth()->user()->id;
        $user = $user_id.'';
     
        if(auth()->user()->user_type != 'admin'){
            
            $projects = Project::orWhereJsonContains('focal_person' ,$user)->orWhereHas('partners', function ($query) {
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
        $dip = DipActivity::where('activity_title',$request->activity)->where('subtheme_id',$request->sub_theme)->where('project_id',$request->project_id)->first();
        $dips = DipActivity::where('activity_number',$request->activity_number)->where('subtheme_id',$request->sub_theme)->where('project_id',$request->project_id)->first();
        $editUrl = route('dips.edit',$request->project_id);
       
        if(empty($dip) && empty($dips)){
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
        $dip_activity               = DipActivity::where('id',$id)->with('months','project','project.themes','user','user1')->first();
        
        $dip_activity_complete      = $dip_activity->with(['months' => function($query) {
                                        $query->has('progress');
                                        }])->find($id);

        $monthsWithpostedCount      = ActivityMonths::where('activity_id', $id)->whereHas('progress')->count();
        $monthsWithoutProgressCount = ActivityMonths::where('activity_id', $id)->whereDate('completion_date', '<', Carbon::now()->toDateString())->whereDoesntHave('progress')->count();
        $monthspending              = ActivityMonths::where('activity_id', $id)->whereDate('completion_date', '>', Carbon::now()->toDateString())->whereDoesntHave('progress')->count();
        $monthstobreviewCount       = ActivityMonths::where('activity_id', $id)->where('activity_id', $id)->whereHas('progress')->where('status',"To be Reviewed")->count();
        $monthsWithreturnCount      = ActivityMonths::where('activity_id', $id)->whereHas('progress')->where('status',"Returned")->count();
        $totalMonths                = $dip_activity->months->count();
        $completedMonths            = $monthsWithpostedCount;
        $progress                   = $totalMonths > 0 ? ($completedMonths / $totalMonths) * 100 : 0;

        $monthsWithProgressCount    = $dip_activity_complete->months->count() ?? '0';

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
        
        $months = ActivityProgress::where('activity_id',$id)->where('project_id',$dip_activity->project_id)->get();
        $quarters = ActivityMonths::where('activity_id',$id)->where('project_id',$dip_activity->project_id)->get();

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/dip/dipquarteroupdateValidation.js');
        addJavascriptFile('assets/js/custom/dip/dipquartereditValidation.js');
        //addJavascriptFile('assets/js/custom/dip/add_progress.js');
       
        return view('admin.dip.show_dip_activity',compact('dip_activity','progress','monthsWithreturnCount','monthspending','monthstobreviewCount','monthsWithpostedCount','monthsWithoutProgressCount','monthsWithProgressCount','districts','provinces','months','quarters'));
    }

    public function edit(string $id)
    {
        $ProjectActivityType = ProjectActivityType::latest()->get()->sortBy('name');
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
        return view('admin.dip.edit_dip_activity',compact('dip','ProjectActivityType','project','activty_quarters','slugs','quarters'));
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
        $editUrl = route('activity_dips.show',$id);
       
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
      
        if(auth()->user()->hasRole('partner')){
            $projects = Project::whereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            })->orderBy('name')->get();
        }
        elseif(auth()->user()->hasRole('focal person')){
            $projects = Project::whereJsonContains('focal_person',auth()->user()->id)->orderBy('name')->get();
        }else{
            $projects = Project::wherehas('detail')->orderBy('name')->get();
        
        
        }

        $themes = SCITheme::all()->sortBy('name');

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/dip/manage_activities.js');
        return view('admin.dip.activity_progress',compact('projects','themes'));
    }

    public function activity_complete()
    {
        $users = User::whereIn('id', function($query) {
                        $query->select('created_by')->from('dip_activity');
                    })
                    ->orWhereIn('id', function($query) {
                        $query->select('created_by')->from('dip_activity_months');
                    })
                    ->orWhereIn('id', function($query) {
                        $query->select('created_by')->from('dip_activity_progress');
                    })
                    ->get();
        $subthemes = SciSubTheme::orderBy('name')->get();
        if(auth()->user()->hasRole('partner')){
            $projects = Project::whereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            })->orderBy('name')->get();
        }
        elseif(auth()->user()->hasRole('focal_person')){
            $projects = Project::whereJsonContains('focal_person',auth()->user()->id)->orderBy('name')->get();
        }else{

            $projects = Project::orderBy('name')->get();
        }
        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/dip/complete_activities.js');
        return view('admin.dip.activity_complete',compact('projects','users','subthemes'));
    }

    public function activity_due(){
      
        $users = User::whereIn('id', function($query) {
            $query->select('created_by')->from('dip_activity');
        })
        ->orWhereIn('id', function($query) {
            $query->select('created_by')->from('dip_activity_months');
        })
        ->orWhereIn('id', function($query) {
            $query->select('created_by')->from('dip_activity_progress');
        })
        ->get();
        $subthemes = SciSubTheme::orderBy('name')->get();
        if(auth()->user()->hasRole('partner')){
          
            $projects = Project::whereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            })->orderBy('name')->get();
        }
        elseif(auth()->user()->hasRole('focal_person')){
            $projects = Project::whereJsonContains('focal_person',auth()->user()->id)->orderBy('name')->get();
        }else{
            $projects = Project::orderBy('name')->get();
        }
        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/dip/complete_due.js');
        return view('admin.dip.activity_due',compact('projects','users','subthemes'));
    }

    public function postprogress($id){
        $activity = DipActivity::where('id',$id)->first();
        $progressMonths = $activity->months()->pluck('id')->toArray();
        
        $quarters = ActivityProgress::whereIn('quarter_id', $progressMonths)
                                    ->pluck('quarter_id')->toArray();
              
        addJavascriptFile('assets/js/custom/dip/update_progress.js');
       
        return view('admin.dip.update_progress',compact('activity','quarters'));
    }

    public function updateprogress(Request $request)
    {
        $quarter = ActivityMonths::where('id',$request->quarter)->first();
        $editUrl = route('activity_dips.show',$quarter->activity_id);
        $validatedData = $request->validate([
            'attachment' => 'required|file|mimes:pdf,docx,doc|max:10240',
            'image' => 'required|file|mimes:jpeg,jpg,png|max:10240',
    
        ]);
        // if($request->activity_target > $request->lop_target) {
        //     $editUrl = redirect()->back();
        //     return response()->json([
        //         'editUrl' => $editUrl,
        //         'error'   => true,
        //         'message' => "Quarterly Progress must less than Quarterly target"
        //     ]);
        // }
        // $beneficiary_target = $request->women_target + $request->men_target + $request->girls_target + $request->boys_target;

        // if($beneficiary_target > intval($request->benefit_target)) {
        //     $editUrl = redirect()->back();
        //     return response()->json([
        //         'editUrl' => $editUrl,
        //         'error'   => true,
        //         'message' => "Beneficiaries progress must be less than or equal to Beneficiaries Target"
        //     ]);
        // }
        if(!empty($data['double_count']) && $data['double_count'] == 'on'){
            $double_count = 1;
            
        }else{
            $double_count = 0;
        }
        $project = Project::where('id',$quarter->project_id)->first();
        $sof = $project->sof;
        if(!empty($quarter)){
            $quarter_month = ActivityProgress::where('quarter_id',$request->quarter)
            ->where('project_id',$quarter->project_id)
            ->where('activity_id',$quarter->activity_id)
            ->first();
            if(!empty($quarter_month))
            {
                if($request->attachment){
                    $path = storage_path("app/public/activity_progress/attachment/{$sof}/" .$request->attachment);
                    if(File::exists($path)){
                        File::delete(storage_path("app/public/activity_progress/attachment/{$sof}/".$request->attachment));
                    }
                    $file = $request->attachment;
                    $timestamp = now()->timestamp;  // Get the current timestamp
                    $attachment = $timestamp.'_'.$file->getClientOriginalName();
                    $file->storeAs("public/activity_progress/attachment/{$sof}/",$attachment);
                }

                if($request->image){
                    $path = storage_path("app/public/activity_progress/image/{$sof}/" .$request->image);
                    if(File::exists($path)){
                        File::delete(storage_path("app/public/activity_progress/image/{$sof}/".$request->image));
                    }
                    $file = $request->image;
                    $timestamp = now()->timestamp;  // Get the current timestamp
                    $image = $timestamp.'_'.$file->getClientOriginalName();
                  
                    $file->storeAs("public/activity_progress/image/{$sof}/",$image);
                }

               
                if(!empty($quarter)){
                    ActivityProgress::where('quarter_id',$request->quarter)->update([
                        'quarter_id'        => $request->quarter,
                        'activity_target'   => $request->activity_target,
                        'project_id'        => $quarter->project_id,
                        'activity_id'       => $quarter->activity_id,
                        'women_target'      => $request->women_target,
                        'boys_target'       => $request->boys_target,
                        'girls_target'      => $request->girls_target,
                        'men_target'        => $request->men_target,
                        'remarks'           => $request->remarks,
                        'attachment'        => $attachment,
                        'image'             => $image,
                        'double_count'      => $double_count,
                        'created_by'        => auth()->user()->id
                    ]);
                }
              
            }
            else{
                if($request->attachment){
         
                    $path = storage_path("app/public/activity_progress/attachment/{$sof}/" . $request->attachment);
                    
                    if(File::exists($path)){
                        File::delete(storage_path("app/public/activity_progress/attachment/{$sof}/".$request->attachment));
                    }
                    
                    $file = $request->attachment;
                    $timestamp = now()->timestamp;  // Get the current timestamp
                    $attachment = $timestamp.'_'.$file->getClientOriginalName();
                    $file->storeAs("public/activity_progress/attachment/{$sof}/",$attachment);
                   
                }
                if($request->image){
             
                    $path = storage_path("app/public/activity_progress/image/{$sof}/" .$request->image);
                    
                    if(File::exists($path)){
                        File::delete(storage_path("app/public/activity_progress/image/{$sof}/".$request->image));
                    }
                    
                    $file = $request->image;
                    $timestamp = now()->timestamp;  // Get the current timestamp
                    $image = $timestamp.'_'.$file->getClientOriginalName();
                    $file->storeAs("public/activity_progress/image/{$sof}/",$image);
                   
                }
                ActivityProgress::create([
                    'quarter_id'        => $request->quarter,
                    'project_id'        => $quarter->project_id,
                    'activity_target'   => $request->activity_target,
                    'activity_id'       => $quarter->activity_id,
                    'women_target'      => $request->women_target,
                    'boys_target'       => $request->boys_target,
                    'girls_target'      => $request->girls_target,
                    'men_target'        => $request->men_target,
                    'remarks'           => $request->remarks,
                    'attachment'        => $attachment,
                    'complete_date'     => $request->complete_date,
                    'double_count'      => $double_count,
                    'image'             => $image,
                    'created_by'        => auth()->user()->id
                ]);
               
            }
            ActivityMonths::where('id',$request->quarter)->update([
                'status'        => "To be Reviewed",
                'updated_by'    => auth()->user()->id,
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

    public function quarterstatus_update(Request $request,$id)
    {
        ActivityMonths::where('id', $id)->update([
            'status'        => $request->status,
            'remarks'       => $request->remarks,
            'updated_by'    => auth()->user()->id,
        ]);
        $quarter = ActivityMonths::find($id);

        $activity = DipActivity::find($quarter->activity_id);
        $project  = Project::find($quarter->project_id);

        $partnerEmails = $project->partners()
            ->whereHas('partnertheme', function ($query) use ($activity) {
                $query->where('theme_id', $activity->subtheme_id);
            })->pluck('email')->toArray();

        $focalPerson = json_decode($project->focal_person, true);
        $fpEmails = User::whereIn('id', $focalPerson)->pluck('email')->toArray();

        $allEmails = array_merge($partnerEmails, $fpEmails);

        if (!empty($allEmails)) {
            $bccEmails = ['walid.malik@savethechildren.org', 'usama.qayyum@savethechildren.org'];
            $details = [
                'remarks'         => $quarter->remarks,
                'activity_id'     => $quarter->activity_id,
                'activity'        => $activity->activity_title,
                'status'          => $quarter->status,
                'activity_number' => $activity->activity_number,
            ];
            $subject = "Project Activity Progress:" . $activity->activity_title;
        }

        return redirect()->back();
    }

    public function quarterstatus_edit(Request $request,$id)
    {
        $quarters = ActivityProgress::where('id',$id)->first();
        if(!empty($data['double_count']) && $data['double_count'] == 'on'){
            $double_count = 1;
            
        }else{
            $double_count = 0;
        }
        $project = Project::where('id',$quarters->project_id)->first();
        $attachment =  $quarters->attachment;
        $image =  $quarters->image;
        if($request->attachment){
         
            $path = storage_path("app/public/activity_progress/attachment/{$project->sof}/" .$request->attachment);
            if(File::exists($path)){
                File::delete(storage_path("app/public/activity_progress/attachment/{$project->sof}/".$request->attachment));
            }
            $file = $request->attachment;
           
            $timestamp = now()->timestamp;  // Get the current timestamp
            $attachment = $timestamp.$file->getClientOriginalExtension();
            $file->storeAs("public/activity_progress/attachment/{$project->sof}",$attachment);
        }

        if($request->image){
            $path = storage_path("app/public/activity_progress/image/{$project->sof}/" .$request->image);
            if(File::exists($path)){
                File::delete(storage_path("app/public/activity_progress/image/{$project->sof}/".$request->image));
            }
            $file = $request->image;
            $timestamp = now()->timestamp;  // Get the current timestamp
            $image = $timestamp.'_'.$file->getClientOriginalName();
            $file->storeAs("public/activity_progress/image/{$project->sof}",$image);
        }
        $quarter = ActivityProgress::where('id',$id)->update([
                'activity_target'   => $request->activity_target,
                'women_target'      => $request->women_target,
                'men_target'        => $request->men_target,
                'girls_target'      => $request->girls_target,
                'boys_target'       => $request->boys_target,
                'pwd_target'        => $request->pwd_target,
                'attachment'        => $attachment,
                'image'             => $image,
                'double_count'      => $double_count,
                'remarks'           => $request->remarks,
                'updated_by'        => auth()->user()->id,
        ]);
        ActivityMonths::where('id',$quarters->quarter_id)->update([
            'status'   => "To be Reviewed",
        ]);
        $quarter = ActivityProgress::find($id);

        $activity = DipActivity::find($quarter->activity_id);
        $project  = Project::find($quarter->project_id);

        $partnerEmails = $project->partners()
            ->whereHas('partnertheme', function ($query) use ($activity) {
                $query->where('theme_id', $activity->subtheme_id);
            })->pluck('email')->toArray();

        $focalPerson = json_decode($project->focal_person, true);
        $fpEmails = User::whereIn('id', $focalPerson)->pluck('email')->toArray();

        $allEmails = array_merge($partnerEmails, $fpEmails);
        $bccEmails  = ['walid.malik@savethechildren.org', 'usama.qayyum@savethechildren.org'];
      
        if (!empty($allEmails)) {
            $bccEmails = ['walid.malik@savethechildren.org', 'usama.qayyum@savethechildren.org'];
            $details = [
                'remarks'         => $quarter->remarks,
                'activity_id'     => $quarter->activity_id,
                'activity'        => $activity->activity_title,
                'status'          => $quarter->status,
                'activity_number' => $activity->activity_number,
            ];
            $subject = "Project Activity Progress:" . $activity->activity_title;
        }
        Mail::to($allEmails)->bcc($bccEmails)->send(new \App\Mail\partnerMail($details, $subject));
        return response()->json(['error' => true,'quarter' => $quarter ]);
    }

    public function activtyquarter_update(Request $request,$id)
    {
        $quarter = ActivityMonths::where('id',$id)->update([
            'target'                => $request->target_quarter,
            'beneficiary_target'    => $request->target_benefit,
            'updated_by'            => auth()->user()->id,
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
        $progress = ActivityProgress::where('id', $filename)->first();
        $project = Project::where('id', $progress->project_id)->first();
        $originalFilename = $progress->attachment; // Original filename with extension
        $path = public_path("storage/activity_progress/attachment/{$project->sof}/" . $originalFilename);

        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Use the original filename in the download response
        return response()->download($path, $originalFilename);
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
     
        $project_sof = Project::where('id',$activity->project_id)->first();
        return view('admin.dip.activity.edit_progress',compact('progress','activity','project_sof'));
    }

    public function getActivityCounts(Request $request)
    {
        $counts = [
            'allCount'          => ActivityMonths::wherehas('progress')->count(),
            'toBeReviewedCount' => ActivityMonths::where('status', 'To be Reviewed')->wherehas('progress')->count(),
            'returnedCount'     => ActivityMonths::where('status', 'Returned')->wherehas('progress')->count(),
            'reviewedCount'     => ActivityMonths::where('status', 'Reviewed')->wherehas('progress')->count(),
            'postedCount'       => ActivityMonths::where('status', 'Posted')->wherehas('progress')->count(),
            'pendingCount'      => ActivityMonths::whereDoesntHave('progress')->count(),
        ];

        return response()->json($counts);
    }
}
