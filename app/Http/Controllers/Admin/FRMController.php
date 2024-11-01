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
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Models\FrmTag;
use App\Models\ClosingRecord;
use App\Models\ProjectPartner;
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
        $feedbackchannels   = FeedbackChannel::latest()->get();
        $feedbackcategories = FeedbackCategory::latest()->get()->sortBy('name');
        $projects           = Project::where('active','1')->get();
        if (auth()->user()->hasRole("partner")) {
            $projectId = ProjectPartner::where('email',auth()->user()->email)->first();
            $projects = Project::where('created_by',auth()->user()->id)->orderBy('name')->latest()->get();
        }
        else{
            $projects = Project::latest()->get();
        }
        $clients = Frm::orderBy('name_of_client')->pluck('name_of_client');
        
        $users = User::where('user_type','R2')->orWhere('user_type','R1')->orWhere('user_type','R3')->get();

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/frm/index.js');
        // $themes = Theme::latest()->get();
        return view('admin.frm.index' ,compact('feedbackchannels','feedbackcategories','projects','total_frm','open_frm','close_frm','users','clients'));
    }

    public function getBreifFrms()
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
        $feedbackchannels   = FeedbackChannel::latest()->get();
        $feedbackcategories = FeedbackCategory::latest()->get()->sortBy('name');
        $projects           = Project::where('active','1')->get();
        $clients            = Frm::orderBy('name_of_client')->pluck('name_of_client');
        
        $users = User::where('user_type','R2')->orWhere('user_type','R1')->orWhere('user_type','R3')->get();

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/frm/breifindex.js');
        // $themes = Theme::latest()->get();
        return view('admin.frm.breifFrmList' ,compact('feedbackchannels','feedbackcategories','projects','total_frm','open_frm','close_frm','users','clients'));
    }
    
    public function getFrms(Request $request)
    {
        $frms = Frm::query();

        // Apply filters only when necessary
        if ($request->name_of_registrar && $request->name_of_registrar != 'None') {
            $frms->where('name_of_registrar', $request->name_of_registrar);
        }

        if ($request->response_id && $request->response_id != 'None') {
            $frms->where('response_id', 'LIKE', '%' . $request->response_id . '%');
        }

        if ($request->gender && $request->gender != 'None') {
            $frms->where('gender', $request->gender);
        }

        // Handle date range filtering
        if ($request->date_received) {
            $dateParts = explode('to', $request->date_received);
            $startdate = trim($dateParts[0] ?? '');
            $enddate = trim($dateParts[1] ?? '');

            if ($startdate && $enddate) {
                $frms->whereBetween('date_received', [$startdate, $enddate]);
            }
        }

        if ($request->kt_select2_district) {
            $frms->where('district', $request->kt_select2_district);
        }

        if ($request->kt_select2_province) {
            $frms->where('province', $request->kt_select2_province);
        }

        if ($request->feedback_category) {
            $frms->where('feedback_category', $request->feedback_category);
        }


        if (auth()->user()->permissions_level == 'province-wide') {
            $frms->where('province', auth()->user()->province);
        }

        if (auth()->user()->permissions_level == 'district-wide') {
            $frms->where('name_of_registrar', auth()->user()->name)
                ->where('district', auth()->user()->district);
        }

        if ($request->feedback_channel && $request->feedback_channel != 'None') {
            $frms->where('feedback_channel', $request->feedback_channel);
        }

        if ($request->name_of_client && $request->name_of_client != 'None') {
            $frms->where('name_of_client', $request->name_of_client);
        }

        if ($request->type_of_client && $request->type_of_client != 'None') {
            $frms->where('status', $request->type_of_client);
        }

        if ($request->project_name && $request->project_name != 'None') {
            $frms->where('project_name', $request->project_name);
        }

        if (auth()->user()->hasRole("IP's")) {
            $frms->where('created_by', auth()->user()->id);
        }
        if (auth()->user()->hasRole("partner")) {
            $project = ProjectPartner::where('email',auth()->user()->email)->first();
            $frms->where('created_by', auth()->user()->id);
        }
        // Apply eager loading to reduce queries
        $frms = $frms->with(['channel', 'category', 'theme_name', 'project', 'provinces', 'districts', 'tehsils'])
                    ->latest();

        $totalData = $frms->count();

        // Pagination
        $limit = $request->input('length');
        $start = $request->input('start');
        $frms = $frms->skip($start)->take($limit)->get();

        $data = [];

        foreach ($frms as $r) {
            $nestedData = [];
            $text = $r->feedback_description ?? "";
            $words = str_word_count($text, 1);
            $lines = array_chunk($words, 10);
            $finalText = implode("<br>", array_map(fn($line) => implode(" ", $line), $lines));
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
            $nestedData['client_contact'] = $r->client_contact ?? "NA";
            $nestedData['feedback_category'] = $r->category->name ?? '';
            $nestedData['feedback_description'] = $finalText;
            $nestedData['theme'] = $r->theme_name->name ?? '';
            $nestedData['project_name'] = $r->project->name ?? 'NA';
            $nestedData['date_ofreferral'] = $r->date_ofreferral ? date('d-M-Y', strtotime($r->date_ofreferral)) : "NA";
            $nestedData['referral_name'] = $r->referral_name ?? 'NA';
            $nestedData['referral_position'] = $r->referral_position ?? "NA";
            $nestedData['type_ofaction_taken'] = $r->type_ofaction_taken ?? "NA";
            
            // Status formatting
            $nestedData['status'] = match($r->status) {
                "Close" => '<span class="badge badge-success">'.$r->status.'</span>',
                "Open" => '<span class="badge badge-warning">'.$r->status.'</span>',
                default => ''
            };

            // Action buttons
            $view_url = route('frm-managements.show', $r->id);
            $edit_url = route('frm-managements.edit', $r->id);
            $delete_url = route('frm-managements.destroy', $r->id);
            $update_response_url = route('frm-update-response', $r->id);
            $nestedData['update_response'] = $this->generateupdateButtons($r, $update_response_url);
            // Generate action buttons based on permissions
            $nestedData['action'] = $this->generateActionButtons($r, $view_url, $edit_url, $delete_url);

            $data[] = $nestedData;
        }

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data,
        ]);
    }

    private function generateupdateButtons($r, $update_response_url)
    {
        if ($r->feedback_referredorshared == "Yes" && $r->status == "Open") {
            $update_response = '<div><a class="badge badge-primary" title="Update Response" href="'.$update_response_url.'">Update Response</a></div>';
        } else {
            $update_response = '<span class="badge badge-success">Status Closed</span>';
        }
        return '<div>'.$update_response.'</div>';
    }

    private function generateActionButtons($r, $view_url, $edit_url, $delete_url)
    {
        $view = '<a class="btn btn-clean btn-icon" title="View" href="'.$view_url.'"><i class="fa fa-eye"></i></a>';
        $edit = '';
        $delete = '';

        // Permissions logic
        // Adjust the logic here based on your requirements
        // For example:
        if (auth()->user()->permissions_level == 'nation-wide') {
            // Logic for nation-wide permissions
        } elseif (auth()->user()->permissions_level == 'province-wide') {
            // Logic for province-wide permissions
        } elseif (auth()->user()->permissions_level == 'district-wide') {
            // Logic for district-wide permissions
        }

        return '<div>'.$view.$edit.$delete.'</div>';
    }

    public function create()
    {
        $last_record = Frm::latest()->first();
        $id = $last_record->id;
        $record = $id + 1;
        $response_id = $record.'-'.time();
       
        $feedbackchannels = FeedbackChannel::get();
        $feedbackcategories = FeedbackCategory::get();
       
        if (auth()->user()->hasRole("partner")) {
            $projectId = ProjectPartner::where('email',auth()->user()->email)->first();
           
            $projects = Project::where('id',$projectId->project_id)->where('active','1')->latest()->get();
        }else{
            $projects = Project::where('active','1')->latest()->get();
        }
        
        $themes = Theme::latest()->get();
        $users = User::orderBy('name')->get();
        $record = ClosingRecord::latest()->first(); 

        addJavascriptFile('assets/js/custom/frm/general.js');
        addJavascriptFile('assets/js/custom/frm/frm.js');
        return view('admin.frm.create',compact('record','feedbackchannels','feedbackcategories','projects','themes','response_id','users'));
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
        $tagged = json_decode($frm->tagged_by->tagged ?? '') ;
    
        if(!empty($frm))
        {
            return view('admin.frm.show',compact('frm','responses','tagged'));
        }
    }


    public function edit(string $id)
    {
        $frm =Frm::find($id);
        $feedbackchannels = FeedbackChannel::latest()->get();
        $feedbackcategories = FeedbackCategory::latest()->get();
        $projects = Project::where('active','1')->latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orWhere('user_type','R1')->orWhere('user_type','R3')->get();
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
    
    public function add_frmTag(Request $request){
        
        $frmTag = FrmTag::where('frm_id',$request->frm_id)->first();
        $frm = FRM::where('id',$request->frm_id)->first();
        if(empty($frmTag)){
            $frmTag = FrmTag::create([
                'tagged_by' => auth()->user()->id,
                'tagged'    => json_encode($request->tags),
                'frm_id'    => $request->frm_id,
            ]);
        }
        else{
            $frmTag = FrmTag::where('frm_id',$request->frm_id)->update([
                'tagged_by' => auth()->user()->id,
                'tagged'    => json_encode($request->tags),
                'frm_id'    => $request->frm_id,
            ]);
        }
        
        $email = $frm->user->email;
        $mealManagemail = User::where('province',$frm->province)->where('designation',5)->first();
        $bccEmails = [ 'usama.qayyum@savethechildren.org','irfan.majeed@savethechildren.org','walid.malik@savethechildren.org',$mealManagemail->email];
        $details = [
            'feedback_description'  => $frm->feedback_description,
            'feedback_category'     =>  $frm->category?->name.'-'.$frm->category?->description,
            'date_received'         => $frm->date_received,
            'response_id'           => $frm->response_id,
            'feedback_activity'     => $frm->feedback_activity,
            'village'               => $frm->village,
            'id'                    => $frm->id,
            'tag_by'                => $frm->tagged_by?->user?->desig?->designation_name ?? '',
            'tags'                  => $frmTag->tagged,
        ];
        $subject = "[FRM-Tag] ". $frm->feedback_activity ." in ". $frm->village ;
        Mail::to($email)
        ->cc($bccEmails)
        ->send(new \App\Mail\frmTagEmail($details,$subject));

        return redirect()->back();
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
        $feedbackcategories = FeedbackCategory::latest()->get()->sortBy('name');
        addJavascriptFile('assets/js/custom/frm/export.js');
        return view('admin.frm.frm_export.export',compact('feedbackchannels','projects','feedbackcategories'));
    }

    public function getexportfrm(Request $request){
       
        $name_of_registrar = $request->name_of_registrar;
        $date_received = $request->date_received;
        $feedback_channel = $request->feedback_channel;
        $feedback_category = $request->feedback_category;
        $age = $request->age;
        $province = $request->kt_select2_province;
        $district = $request->district;
        $type_of_client = $request->type_of_client;
        $project_name = $request->project_name;
        $status = $request->status;
      
        $data = [
                'name_of_registrar' => $name_of_registrar,
                'date_received'     =>$date_received,
                'feedback_channel'  =>$feedback_channel,
                'age'               => $age,
                'province'          => $province,
                'district'          => $district,
                'type_of_client'    =>$type_of_client,
                'project_name'      =>$project_name,
                'status'            =>$status,
                'feedback_category' => $feedback_category
                 ];
                 
                 
        $fileName = 'FRM_Tracker'.'('. now()->format('d-m-Y') .')'. '.csv';
                 
        return Excel::download(new FrmExport($data),  $fileName);
    }
}
