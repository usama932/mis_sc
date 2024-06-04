<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\District;
use App\Models\Province;
use App\Models\ProjectActivityCategory;
use App\Models\ProjectActivityType;
use App\Models\User;
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
        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/project/projectlist.js');
        return view('admin.dip.index');
    }

    public function get_dips(Request $request)
    {
       
        $columns = [
            1 => 'id',
            2 => 'project',
            3 => 'partner',
            4 => 'theme',
            5 => 'province',
            6 => 'district',
            7 => 'project_start',
            8 => 'project_end',
            9 => 'project_submission',
            10 => 'attachment',
            11 => 'created_by',
            12 => 'created_at',
            13 => 'updated_by',
            14 => 'updated_at',
        ];
    
        $user = auth()->user();
        $userId =  $user->id.'';
        $is_admin = $user->user_type === 'admin';
      
        $totalData = $is_admin ? Project::count() : Project::where(function ($query) use ($user, $userId) {
            $query->orWhereJsonContains('focal_person', $userId)
                ->orWhereHas('partners', function ($query) use ($user) {
                    $query->where('email', $user->email);
                });
        })->count();
    
        $limit = $request->input('length');
        $orderIndex = $request->input('order.0.column');
        $order = isset($columns[$orderIndex]) ? $columns[$orderIndex] : 'id';
        $dir = $request->input('order.0.dir');
        
        $totalFiltered = $is_admin ? Project::count() : Project::orWhereJsonContains('focal_person', $userId)
            ->orWhereHas('partners', function ($query) use ($user) {
                $query->where('email', $user->email);
            })->count();
    
        $start = $request->input('start');
        $query = $is_admin ? Project::latest() : Project::where(function ($query) use ($user , $userId) {
            $query->orWhereJsonContains('focal_person', $userId)
                ->orWhereHas('partners', function ($query) use ($user) {
                    $query->where('email', $user->email);
                });
        });
        $project = Project::where(function ($query) use ($user ,$userId) {
            $query->orWhereJsonContains('focal_person', $userId)
                ->orWhereHas('partners', function ($query) use ($user) {
                    $query->where('email', $user->email);
                });
        })->get();
        
        $projects = $query->limit($limit)->offset($start)->orderBy($order, $dir)->get();
    
        $data = [];
        foreach ($projects as $project) {
            if (!empty($project->detail) && !empty($project->themes)) {
                $nestedData['id'] = $project->id;
                $nestedData['project'] = $project->name ?? '';
                $nestedData['type'] = $project->type ?? '';
                $nestedData['sof'] = $project->sof ?? '';
                $provinces = '';
                if ($project->detail && !empty($project->detail->province)) {
                    $province_dip = json_decode($project->detail->province, true);
                    $provinces = Province::whereIn('province_id', $province_dip)->pluck('province_name');
                }
                $nestedData['province'] = $provinces;
                $themes = $project->themes->pluck('scitheme_name.name')->unique()->implode(', ');
                $partners = $project->partners->pluck('partner_name.slug')->implode(', ');
                $nestedData['partners'] = $partners;
                $nestedData['themes'] = $themes;
                $districts = '';
                if ($project->detail && !empty($project->detail->district)) {
                    $district_dip = json_decode($project->detail->district, true);
                    $districts = District::whereIn('district_id', $district_dip)->pluck('district_name');
                }
                $nestedData['district'] = $districts;
                $nestedData['project_tenure'] = $project->start_date && $project->end_date ? date('M d ,Y', strtotime($project->start_date)) . ' To ' . date('M d ,Y', strtotime($project->end_date)) : '';  

                $data[] = $nestedData;
            }
        }
    
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];
    
        echo json_encode($json_data);
    }
    public function dip_create($id)
    {
        $ProjectActivityType = ProjectActivityType::latest()->get()->sortBy('name');
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
        return view('admin.dip.create',compact('project','themes','quarters','ProjectActivityType'));
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
        $focalperson = $project->focal_person;
        $budgetholder = $project->budget_holder;
        $focal_person = $focalperson ? implode("<br>", User::whereIn('id', json_decode($focalperson, true))->pluck('name')->toArray()) : '';
        $budgetholder = $budgetholder ? implode("<br>", User::whereIn('id', json_decode($budgetholder, true))->pluck('name')->toArray()) : '';
       
        return view('admin.dip.edit',compact('project','focal_person','budgetholder','provinces','districts'));
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
