<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\District;
use App\Models\Province;
use App\Models\SCITheme;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Repositories\Interfaces\DipRepositoryInterface;

class DipController extends Controller
{
    private $dipRepository;

    public function __construct(DipRepositoryInterface $dipRepository)
    {
        $this->dipRepository = $dipRepository;
    }
    public function index()
    {
        return view('admin.dip.index');
    }

    public function get_dips(Request $request)
    {
       
        $columns = array(
			1 => 'id',
			2 => 'project',
            3 => 'partner',
            4 => 'theme',
            5 => 'province',
            6 => 'district',
            7 => 'project_start',
            8 => 'project_end',
            9 => 'project_submition',
            10 => 'attachment',
            11 => 'created_by',
            12 => 'created_at',
            13 => 'updated_by',
            14 => 'updated_at',
            
		);
        $user_id = auth()->user()->id;
        $user = $user_id.'';
		if(auth()->user()->user_type != 'admin'){
            $totalData = Project::where(function ($query) use ($user) {
                $query->orWhereJsonContains('focal_person', $user)
                      ->orWhereHas('partners', function ($query) {
                          $query->where('email', auth()->user()->email);
                      });
            })->count();
        }else{
            $totalData = Project::count();
        }
		
       
		$limit = $request->input('length');
        $orderIndex = $request->input('order.0.column');
        if (isset($columns[$orderIndex])) {
            $order = $columns[$orderIndex];
        } else {
            
            $order = 'id'; // Or any other default column name
        }
        $dir = $request->input('order.0.dir');
        if(auth()->user()->user_type != 'admin'){
            
            $totalFiltered = Project::orWhereJsonContains('focal_person' ,$user)->orWhereHas('partners', function ($query) {
                $query->where('email', auth()->user()->email);
            })->count();
        }
        else{
            $totalFiltered = Project::count();
        }
       
		$start = $request->input('start');
		if(auth()->user()->user_type != 'admin'){
            $dips = Project::where(function ($query) use ($user) {
                $query->orWhereJsonContains('focal_person', $user)
                      ->orWhereHas('partners', function ($query) {
                          $query->where('email', auth()->user()->email);
                      });
            });
        }
        else{
            $dips = Project::query();
        }

        $dips =$dips->limit($limit)->offset($start)->orderBy($order, $dir)->get();
      
		$data = array();
		if($dips){
			foreach($dips as $r){
                if($r->detail?->count() > 0 && $r->themes?->count() > 0){
                    $edit_url = route('dips.edit',$r->id);
                    $show_url = route('dips.show',$r->id);
                    $nestedData['dip_add'] = '<div>
                                            <td>
                                                <a class="" title="Add Activity" href="'.$edit_url.'">
                                                <span class="badge badge-info"> Manage Activity Target</span>
                                                </a>
                                            </a>
                                            </td>
                                            </div>
                                            ';
                    $nestedData['id'] = $r->id;
                    $nestedData['project'] = $r->name ?? '';
                    $nestedData['type'] = $r->type ?? '';
                    $nestedData['sof'] = $r->sof ?? '';
                    if(!empty($r->detail->province )){
                        $province_dip = json_decode($r->detail->province , true);
                        $provinces = Province::whereIn('province_id', $province_dip)->pluck('province_name');
                    }
                    else{
                        $provinces = '';
                    }
                    $nestedData['province'] = $provinces ?? '';
                    $themes = [];
                    if (!empty($r->themes)) {
                        foreach ($r->themes as $theme) {
                            $themes[] = $theme->scitheme_name->name;
                        }
                        $themes = implode(', ', array_unique($themes)); // Combining themes with commas
                    } else {
                        $themes = ''; // If themes array is empty
                    }
                    $partners = [];
                    if (!empty($r->partners)) {
                        foreach ($r->partners as $partner) {
                            $partners[] = $partner->partner_name->slug;
                        }
                        $partners = implode(', ', $partners); // Combining themes with commas
                    } else {
                        $partners = ''; // If themes array is empty
                    }
                   
                    $nestedData['partners'] =  $partners  ?? '';
                    $nestedData['themes'] =$themes ?? '';
                    if(!empty($r->detail->district )){
                        $district_dip = json_decode($r->detail->district , true);
                        $districts = District::whereIn('district_id', $district_dip)->pluck('district_name');
                    }
                    else{
                        $districts = '';
                    }
                    $nestedData['district'] = $districts ?? '';
                  
                   
                    if($r->start_date != null && $r->end_date != null){
                        $nestedData['project_tenure'] = date('M d ,Y', strtotime($r->start_date)) .' To '.date('M d ,Y', strtotime($r->end_date));
                    }
                    else{
                        $nestedData['project_tenure'] ='' ;
                    }      
                    $nestedData['attachment'] = $r->detail->attachment ?? '';
                    $nestedData['created_by'] = $r->user->name ?? '';
                    $nestedData['created_at'] = date('d-M-Y', strtotime($r->created_at)) ?? '';
                           
                    $nestedData['action'] = '<div>
                                            <td>
                                               ';
                                            if (auth()->user()->user_type == 'admin') {
                                                $nestedData['action'] .= '
                                                <a class="btn-icon mx-1" title="Delete " onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                                </a>';
                                            }
                                            $nestedData['action'] .= '</td></div>';
                            
                    
                    $data[] = $nestedData;
                }
             
			}
		}
		
		$json_data = array(
			"draw"			    => intval($request->input('draw')),
			"recordsTotal"	    => intval($totalData),
			"recordsFiltered"   => intval($totalFiltered),
			"data"			    => $data
		);
		
		echo json_encode($json_data);
    }
    public function dip_create($id)
    {
     
        $project = Project::with('themes')->where('id', $id)->first();
      
        $start = new DateTime($project->start_date);
        $end = new DateTime($project->end_date);
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);
        
        $quarters = collect();
        
        foreach ($period as $date) {
            $quarters->push($date->format('M-Y'));
        }
        
        $themes = $project->themes->groupBy('theme_id')->map(function ($themes) {
            return $themes->first();
        })->values()->all();
      
        
        addJavascriptFile('assets/js/custom/dip/dip_activity_validations.js');
        return view('admin.dip.create',compact('project','themes','quarters'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
        $data = $request->except('_token');
        $dip = $this->dipRepository->storedip( $data);
        $dip = 'basic_info';
        session(['dip' => $dip]);
        $editUrl = route('dips.edit',$dip->id);
     
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }

    public function show(string $id)
    {
        $project = Project::with('detail','partners','themes','user','user1')->find($id);
        $provinces = [];
        $districts = "";
        if($project->detail?->district != null) {
            $district_project = json_decode($project->detail->district , true);
            $districts = District::whereIn('district_id', $district_project)->get();
        }
       
        if($project->detail?->province != null) {
            $province_project = json_decode($project->detail->province , true);
            $provinces = Province::whereIn('province_id', $province_project)->get();
        }

        return view('admin.dip.view_dip',compact('project','districts','provinces'));
    }

    public function edit(string $id)
    {

        $project = Project::find($id);

        $dip = 'basic_project';
        session(['dip' => $dip]);
        $provinces = [];
        $districts = "";
        if($project->detail?->district != null) {
            $district_project = json_decode($project->detail->district , true);
            $districts = District::whereIn('district_id', $district_project)->get();
        }
       
        if($project->detail?->province != null) {
            $province_project = json_decode($project->detail->province , true);
            $provinces = Province::whereIn('province_id', $province_project)->get();
        }

        addVendors(['datatables']);
        
        return view('admin.dip.edit',compact('project','provinces','districts'));
    }

    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    public function destroy(string $id)
    {
        $project = Project::with('themes','partners','detail')->find($id);
        if(!empty($project)){
            $project->themes->each?->delete();
            $project->partners?->each?->delete();
            if(!empty($project->partners)){
                $project->partners->each(function ($partner) {
                    $partner->partnertheme()->delete();
                });
                $project->partners->each(function ($partner) {
                    $partner->provincedistrict()->delete();
                });
            }
            $project->detail?->delete();
            $project->activities?->each?->delete();
            $project->activity_months?->each?->delete();
            $project->progress?->each?->delete();
            $project->profile?->each?->delete();
            $project->reviews()->each(function ($review) {
                $review->action_point()->delete();
            });
            $project->reviews?->each?->delete();
            return redirect()->route('get_project_index');
        }else{
            return redirect()->route('get_project_index');
        }
        
        
    }
}
