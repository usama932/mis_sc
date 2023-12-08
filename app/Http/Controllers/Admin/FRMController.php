<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatefrmRequest;
use App\Http\Requests\UpdatefrmRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Frm;
use App\Models\FrmResponse;
use App\Exports\FrmExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\FeedbackChannel;
use App\Models\FeedbackCategory;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Repositories\Interfaces\FrmRepositoryInterface;
use Carbon\Carbon;

class FRMController extends Controller
{
    private $frmRepository;

    public function __construct(FrmRepositoryInterface $frmRepository)
    {
        $this->frmRepository = $frmRepository;
    }
    public function index()
    {
        if(auth()->user()->permissions_level == 'nation-wide')
        {
            $total_frm = Frm::count();
            $open_frm = Frm::where('status','Open')->count();
            $close_frm = Frm::where('status','Close')->count();
        }
        if(auth()->user()->permissions_level == 'province-wide')
        {
            $total_frm = Frm::where('province',auth()->user()->province)->count();
            $open_frm = Frm::where('province',auth()->user()->province)->where('status','Open')->count();
            $close_frm = Frm::where('province',auth()->user()->province)->where('status','Close')->count();
           
        }
        if(auth()->user()->permissions_level == 'district-wide')
        {
            $total_frm = Frm::where('district',auth()->user()->district)
                                ->where('name_of_registrar',auth()->user()->name)->count();
            $open_frm = Frm::where('district',auth()->user()->district)
                            ->where('name_of_registrar',auth()->user()->name)
                            ->where('status','Open')->count();
            $close_frm = Frm::where('district',auth()->user()->district)
                                ->where('name_of_registrar',auth()->user()->name)->where('status','Close')->count();
           
        }
        $feedbackchannels = FeedbackChannel::latest()->get();
        $feedbackcategories = FeedbackCategory::latest()->get();
        $projects = Project::where('active','1')->latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
     
        // $themes = Theme::latest()->get();
        return view('admin.frm.index' ,compact('feedbackchannels','feedbackcategories','projects','total_frm','open_frm','close_frm','users'));
    }
    public function getFrms(Request $request){

		$columns = array(
			0 => 'id',
			1 => 'response_id',
			2 => 'name_of_registrar',
            3 => 'date_received',
            4 => 'feedback_Channel',
            5 => 'name_of_client',
            6 => 'type_of_client',
            7 => 'gender',
            8 => 'age',
            9 => 'province',
            10 => 'district',
            11 => 'tehsil',
            12 => 'union_counsil',
            12 => 'village',
            13 => 'pwd_clwd',
            14 => 'client_contact',
            15 => 'feedback_category',
            16 => 'theme',
            17 => 'project_name',
            18 => 'date_ofreferral',
            19 => 'referral_name',
            20 => 'referral_position',
            21 => 'type_ofaction_taken',
            22 => 'status',
            23 => 'status'
           
		);

        $start = $request->input('start');
      
		if(empty($request->input('search.value'))){
			$frms = Frm::where('id','!=',-1);
			
		}
        
        if($request->name_of_registrar != null && $request->name_of_registrar != 'None'){
            $frms->where('name_of_registrar',$request->name_of_registrar);
        }
        
        if($request->response_id != null && $request->response_id != 'None'){
            $frms->where('response_id','LIKE','%'.$request->response_id.'%');
        }
       
        if($request->gender != null && $request->gender != 'None'){
            $frms->where('gender',$request->gender);
        }
        $dateParts = explode('to', $request->date_received);
       
           $startdate = '';
        $enddate = '';
        if(!empty($dateParts)){
            $startdate = $dateParts[0] ?? '';
            $enddate = $dateParts[1] ?? '';
        }
        if($request->date_received != null ){
            $frms->whereBetween('date_received',[$startdate ,$enddate]);
        }
        if($request->kt_select2_district != null){
            $frms->where('district',$request->kt_select2_district);
        }
        if($request->kt_select2_province != null){

            $frms->where('province',$request->kt_select2_province);
        }
        if(auth()->user()->permissions_level == 'province-wide')
        {
            $frms->where('province',auth()->user()->province);
        }
        if(auth()->user()->permissions_level == 'district-wide')
        {
            $frms->where('name_of_registrar',auth()->user()->name)->where('district',auth()->user()->district);
        }

        if($request->feedback_channel != null && $request->feedback_channel != 'None'){
            $frms->where('feedback_channel',$request->feedback_channel);
        }
        if($request->age_id != null && $request->age_id != 'None'){
            $frms->where('age',$request->age_id);
        }
        if($request->type_of_client != null && $request->type_of_client != 'None'){
            $frms->where('status',$request->type_of_client);
        }
        if($request->project_name != null && $request->project_name != 'None'){
            $frms->where('project_name',$request->project_name);
        }
        
        $totalData =$frms->count();
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $totalFiltered = $frms->count();
       
        $frm =$frms->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)->get()->sortByDesc("id");

        
		$data = array();

		if($frm){
			foreach($frm as $r){
				$edit_url = route('frm-managements.edit',$r->id);
                $show_url = route('frm-managements.show',$r->id);
                $update_response_url = route('frm-update-response',$r->id);
                $delete_url = route('frm-managements.destroy',$r->id);
				$nestedData['id'] = $r->id + 1000;
                $nestedData['response_id'] = $r->response_id;
				$nestedData['name_of_registrar'] = $r->name_of_registrar;
                $nestedData['date_received'] = date('d-M-Y', strtotime($r->date_received));
                $nestedData['feedback_channel'] = $r->channel->name ?? "NA";
                $nestedData['name_of_client'] = $r->name_of_client;
                $nestedData['type_of_client'] = $r->type_of_client;
                $nestedData['gender'] = $r->gender;
                $nestedData['age'] = $r->age;
                $nestedData['province'] = $r->provinces->province_name ?? '';
                $nestedData['district'] = $r->districts->district_name  ?? '';
                $nestedData['tehsil'] = $r->tehsils->tehsil_name  ?? '';
                // $nestedData['uc'] =$r->uc?->uc_name  ?? '';
                // $nestedData['village'] = $r->village;
                // $nestedData['pwd_clwd'] = $r->pwd_clwd;
                $nestedData['client_contact'] =$r->client_contact ?? "NA";
                $nestedData['feedback_category'] = $r->category->name ?? '';
                $nestedData['theme'] = $r->theme_name->name ?? '';
                $nestedData['project_name'] = $r->project->name ?? 'NA';
                if($r->date_ofreferral != ""){
                    $nestedData['date_ofreferral'] = date('d-M-Y', strtotime($r->date_ofreferral)) ?? "NA";
                }
                else{
                    $nestedData['date_ofreferral'] = "NA";
                }
                $nestedData['referral_name'] = $r->referral_name ?? 'NA';
                $nestedData['referral_position'] =$r->referral_position ?? "NA";
                $nestedData['type_ofaction_taken'] =$r->type_ofaction_taken ?? "NA";
                if($r->status == "Close")
                    $nestedData['status'] = '<span class="badge badge-success">'.$r->status.'</span>';
                elseif($r->status == "Open"){
                    $nestedData['status'] = '<span class="badge badge-warning">'.$r->status.'</span>';
                }
                // $nestedData['feedback_summary'] =$r->feedback_summary  ?? "NA";
                $view='';
                $edit ='';
                $delete ='';
               
                if($r->feedback_referredorshared == "No" && $r->status == "Open"){
                  
                    $nestedData['update_response'] ='NA';
                }
                elseif($r->feedback_referredorshared == "Yes" && $r->status == "Open"){
               
                 
                    $nestedData['update_response'] ='<div><td><a class=""" title="View" href="'.$update_response_url.'"><span class="badge badge-primary">'
                                                    .'Update Response'.
                                                    '</span></a></td></div>';
                }
                elseif($r->feedback_referredorshared == "Yes" && $r->status == "Close"){
                    $view   = '<a class="btn   btn-clean btn-icon"" title="View" href="'.$show_url.'">
                                <i class="fa fa-eye"></i>
                                </a>';
                    $edit   = '';
                    $delete = '';
                    $nestedData['update_response'] ='<div><td><span class="badge badge-success">'
                                                    .'Status Closed'.
                                                    '</span></td></div>';
                }
                elseif($r->feedback_referredorshared == "No" && $r->status == "Close"){
                    $nestedData['update_response'] ='<div><td><span class="badge badge-success">'
                                                    .'Status Closed'.
                                                    '</span></td></div>';
                }

                if(auth()->user()->permissions_level == 'nation-wide')
                {
                    if(auth()->user()->user_type == 'admin'){
                        $view   = '<a class="btn   btn-clean btn-icon"" title="View" target="_blank"  href="'.$show_url.'">
                                    <i class="fa fa-eye"></i>
                                    </a>';
                        $edit   ='<a title="Edit" target="_blank" class="btn   btn-clean btn-icon"
                                    href="'.$edit_url.'">
                                    <i class="fa fa-pencil"></i></a>';
                        $delete ='<a class="btn   btn-clean btn-icon" title="Delete" href="'.$delete_url.'">
                                    <i class="fa fa-trash"></i>
                                    </a>';
                    }
                    elseif(auth()->user()->user_type == 'R3'){
                        $view   = '<a class="btn   btn-clean btn-icon"" title="View" target="_blank" href="'.$show_url.'">
                                    <i class="fa fa-eye"></i>
                                    </a>';
                        $edit   = '';
                        $delete = '';
                    }
                    elseif(auth()->user()->user_type == 'R2' ){
                        $view   = '<a class="btn   btn-clean btn-icon"" title="View" target="_blank" href="'.$show_url.'">
                                    <i class="fa fa-eye"></i>
                                    </a>';
                        if($r->name_of_registrar == auth()->user()->name){
                            if($r->status == 'Open'){
                                $edit   = '<a title="Edit" target="_blank" class="btn   btn-clean btn-icon"
                                href="'.$edit_url.'">
                                <i class="fa fa-pencil"></i></a>';
                            }else{
                                $edit   = '';
                            }
                           
                        }
                        else{
                            $edit   = '';
                        }
                        $delete = '';
                    }
                    else{
                        $view   = '<a class="btn   btn-clean btn-icon"" title="View" target="_blank" href="'.$show_url.'">
                        <i class="fa fa-eye"></i>
                        </a>';
                        $edit   ='';
                        $delete = '';
                    }
                }
                if(auth()->user()->permissions_level == 'province-wide')
                {
                    if(auth()->user()->user_type == 'R1' && auth()->user()->province == $r->province){
                        $view   = '<a class="btn   btn-clean btn-icon"" title="View"  target="_blank" href="'.$show_url.'">
                                    <i class="fa fa-eye"></i>
                                    </a>';
                        
                        if($r->status != 'Close'){
                            $edit   = '<a title="Edit" target="_blank" class="btn   btn-clean btn-icon"
                                        href="'.$edit_url.'">
                                        <i class="fa fa-pencil"></i></a>';
                        }else{
                            $edit   = '';
                        }
                    
                       
                        $delete = '';
                    }
                    elseif(auth()->user()->user_type == 'R2' && auth()->user()->province == $r->province){
                        $view   = '<a class="btn   btn-clean btn-icon"" title="View" target="_blank" href="'.$show_url.'">
                                    <i class="fa fa-eye"></i>
                                    </a>';
                        if($r->status != 'Close'){
                            $edit   ='<a title="Edit" target="_blank" class="btn   btn-clean btn-icon"
                            href="'.$edit_url.'">
                            <i class="fa fa-pencil"></i></a>';
                        }else{
                            $edit = '';
                        }
                        
                        $delete = '';
                    }
                    else{
                        $view   = '';
                        $edit   ='';
                        $delete = '';
                    }
                   
                }
                if(auth()->user()->permissions_level == 'district-wide')
                {
                    if(auth()->user()->user_type == 'R1' && auth()->user()->district == $r->district){
                        $view   = '<a class="btn   btn-clean btn-icon"" title="View" target="_blank" href="'.$show_url.'">
                                    <i class="fa fa-eye"></i>
                                    </a>';
                        if($r->name_of_registrar == auth()->user()->name && $r->status != 'Close'){
                            
                            $edit   = '<a title="Edit" target="_blank" class="btn   btn-clean btn-icon"
                                        href="'.$edit_url.'" >
                                        <i class="fa fa-pencil"></i></a>';
                        }
                        else{
                            $edit   = '';
                        }
                       
                        $delete = '';
                    }
                }

				$nestedData['action'] ='<div>
                                        <td>'. $view  .$edit.$delete .'</td>
                                        </div>';
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
        $last_record = Frm::latest()->first();
        $id = $last_record->id;
        $record = $id + 1;
        $response_id = $record.'-'.time();
       
        $feedbackchannels = FeedbackChannel::get();
        $feedbackcategories = FeedbackCategory::get();
        $projects = Project::where('active','1')->latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        
        addJavascriptFile('assets/js/custom/frm/general.js');
        addJavascriptFile('assets/js/custom/frm/frm.js');
        return view('admin.frm.create',compact('feedbackchannels','feedbackcategories','projects','themes','response_id','users'));
    }
    public function getUpdate_response($id)
    {
        $frm        = Frm::find($id);
        $responses  = FrmResponse::where('fbreg_id',$id)->get();
          
        addJavascriptFile('assets/js/custom/frm/update_response.js');
        // addJavascriptFile('assets/js/custom/frm/frm.js');
        return view('admin.frm.update_response',compact('frm','responses'));
    }


    public function store(CreatefrmRequest $request)
    {
     
        $frm  = Frm::where('name_of_client', $request->name_of_client)
                    ->where('date_received', $request->date_received)
                    ->where('province', $request->province)
                    ->where('district', $request->district)
                    ->where('tehsil', $request->tehsil)
                    ->where('theme', $request->theme)->get();
     
        if(!empty($frm) && $frm->count() > 0){ 
            return response()->json([
                'error' => 'Record already Exist'
            ]);
        }
        else{
            $data = $request->except('_token');
            $this->frmRepository->storeFrm($data);
           
            return response()->json([
                'success' => 'FRM Created Succesfully'
            ]);
        }

       
    }


    public function show(string $id)
    {
        $frm =Frm::find($id);
        $responses  = FrmResponse::where('fbreg_id',$id)->get();
        if(!empty($frm))
        {
            return view('admin.frm.show',compact('frm','responses'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $frm =Frm::find($id);
        $feedbackchannels = FeedbackChannel::latest()->get();
        $feedbackcategories = FeedbackCategory::latest()->get();
        $projects = Project::where('active','1')->latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        addJavascriptFile('assets/js/custom/frm/edit.js');
        addJavascriptFile('assets/js/custom/frm/frm.js');
        $title =  'Edit Feedback/Complaint #' .$frm->response_id;
        if(!empty($frm))
        {
            return view('admin.frm.edit',compact('frm','feedbackchannels','feedbackcategories','projects','themes','users','title'));
        }
    }


    public function update(UpdatefrmRequest $request, string $id)
    {
        // $frm  = Frm::where('name_of_client', $request->name_of_client)
        //             ->where('date_received', $request->date_received)
        //             ->where('province', $request->province)
        //             ->where('district', $request->district)
        //             ->where('tehsil', $request->tehsil)
        //             ->where('theme', $request->theme)
        //             ->where('id','!=', $id)->get();
        
        // if(!empty($frm) && $frm->count() > 0){
        // return redirect()->back()->with('danger','Record already Exist');;
        // }
        
        if($request->date_feedback_referred == "Yes"){
            $validatedData = $request->validate([
                'refferal_position' => ['required','string'],
                'refferal_name' => ['required','string'],
                'feedback_summary' => ['required','string'],
            ]);
        }

        if($request->date_feedback_referred == "No"){
            $validatedData = $request->validate([
                'status' => ['required'],
            ]);
        }


        $data = $request->except('_token');
        $this->frmRepository->updateFrm($data,$id);
        return redirect()->route('frm-managements.index');
    }

    public function postUpdate_response(Request $request){

        $validatedData = $request->validate([
            'status' => ['required'],
            'date_feedback_referred' => ['required'],
            'feedback_response' => ['required'],
        ]);
        
        $frm =Frm::where('id',$request->frm_id)->first();
        if($request->status == "Close"){
            
            $statis = $request->actiontaken;
            $date  = $request->date_feedback_referred;
            $date1 =Carbon::parse($frm->date_received);
            $date2 = Carbon::parse($date)->format('Y-m-d');
            $num_of_days =  $date1->diffInDays($date);
            
        }
        else{
            $statis = 'NA';
            $date  = $frm->date_of_respbackgiven;
            $num_of_days = "";
        }
     
        $frm = Frm::where('id',$request->frm_id)->update([
            'status'                => $request->status,
            'response_summary'      => $request->feedback_response,
            'date_of_respbackgiven' => $date,
            'type_ofaction_taken'   => $statis,
        ]);
        $frm = FrmResponse::create([
            'follow_up_date'    => $request->date_feedback_referred,
            'response_summary'  => $request->feedback_response,
            'fbreg_id'          => $request->frm_id,
            'status'            => $request->status,
            'created_by'        => auth()->user()->id,
        ]);
        return redirect()->route('frm-managements.show', $request->frm_id);

    }
    public function destroy(string $id)
    {
        $frm =Frm::find($id);
        if(!empty($frm))
        {
            $frm->delete();
            return redirect()->route('frm-managements.index');
        }
    }
    public function getexportform(Request $request){

        $feedbackchannels = FeedbackChannel::latest()->get();
        $projects = Project::where('active','1')->latest()->get();
        
        addJavascriptFile('assets/js/custom/frm/export.js');
        return view('admin.frm.frm_export.export',compact('feedbackchannels','projects'));
    }
    public function getexportfrm(Request $request){
      
        $name_of_registrar = $request->name_of_registrar;
        $date_received = $request->date_received;
        $feedback_channel = $request->feedback_channel;
        $age = $request->age;
        $province = $request->kt_select2_province;
        $district = $request->district;
        $type_of_client = $request->type_of_client;
        $project_name = $request->project_name;
        $status = $request->status;
      
        $data = ['name_of_registrar'=> $name_of_registrar,
                'date_received'=>$date_received,
                'feedback_channel'=>$feedback_channel,
                'age'=> $age,
                'province'=> $province,
                'district'=> $district,
                'type_of_client'=>$type_of_client,
                'project_name'=>$project_name,
                'status'=>$status,
                 ];
                 
                 
        $fileName = 'FRM_Tracker'.'('. now()->format('d-m-Y') .')'. '.csv';
                 
        return Excel::download(new FrmExport($data),  $fileName);
    }
}
