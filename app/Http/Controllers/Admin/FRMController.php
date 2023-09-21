<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatefrmRequest;
use App\Http\Requests\UpdatefrmRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Frm;
use App\Models\FrmResponse;
use Rap2hpoutre\FastExcel\FastExcel;
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
        return view('admin.frm.index');
    }
    public function getFrms(Request $request){

		$columns = array(
			0 => 'id',
			1 => 'name_of_registrar',
			4 => 'created_at',
			5 => 'action'
		);

		$totalData = Frm::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if(empty($request->input('search.value'))){
			$frms = Frm::offset($start)
				->limit($limit)
				->orderBy($order,$dir);
			$totalFiltered = Frm::count();
		}else{
			$search = $request->input('search.value');
			$frms = Frm::offset($start)
				->limit($limit)
				->orderBy($order, $dir);
			$totalFiltered = Frm::count();
		}

        if($request->name_of_registrar != null){
            $frms->where('name_of_registrar',$request->name_of_registrar);
        }
        if($request->date_received != null){
            $date = Carbon::parse($request->date_received)->format("Y-m-d");
            $frms->where('date_received',$request->date_received);
        }
        if($request->kt_select2_district != null){
            $frms->where('date_received',$request->kt_select2_district);
        }
        if($request->kt_select2_province != null){

            $frms->where('date_received',$request->kt_select2_province);
        }
        if(auth()->user()->permissions_level == 'nation-wide')
        {

        }
        if(auth()->user()->permissions_level == 'province-wide')
        {
            $frms->where('province',$auth()->user()->province);
        }
        if(auth()->user()->permissions_level == 'district-wide')
        {
            $frms->where('district',$auth()->user()->district);
        }

        if($request->feedback_channel != null){
            $frms->where('feedback_channel',$request->feedback_channel);
        }
        if($request->age_id != null){
            $frms->where('age',$request->age_id);
        }
        if($request->type_of_client != null){
            $frms->where('type_of_client',$request->type_of_client);
        }
        if($request->project_name != null){
            $frms->where('project_name',$request->project_name);
        }

        $frm =$frms->get();


		$data = array();

		if($frm){
			foreach($frm as $r){
				$edit_url = route('frm-managements.edit',$r->id);
                $show_url = route('frm-managements.show',$r->id);
                $update_response_url = route('frm-update-response',$r->id);
                $delete_url = route('frm-managements.destroy',$r->id);
				$nestedData['id'] = $r->id + 1000;
				$nestedData['name_of_registrar'] = $r->name_of_registrar;
                $nestedData['date_received'] = $r->date_received;
                $nestedData['feedback_channel'] = $r->feedback_channel;
                $nestedData['name_of_client'] = $r->name_of_client;
                $nestedData['type_of_client'] = $r->type_of_client;
                $nestedData['gender'] = $r->gender;
                $nestedData['age'] = $r->age;
                $nestedData['province'] = $r->provinces->name ?? '';
                $nestedData['district'] = $r->districts->district_name  ?? '';
                $nestedData['tehsil'] = $r->tehsils->tehsil_name  ?? '';
                $nestedData['uc'] ='&nbsp'.$r->uc?->uc_name  ?? '';
                $nestedData['village'] = $r->village;
                $nestedData['pwd_clwd'] = $r->pwd_clwd;
                $nestedData['contact_number'] =$r->client_contact ?? "NA";
                $nestedData['feedback_category'] = '&nbsp'.$r->	feedback_category;
                $nestedData['theme'] = $r->theme;
                $nestedData['project_name'] = $r->project_name;
                $nestedData['date_ofreferral'] =$r->date_ofreferral ?? "NA";
                $nestedData['referral_name'] = '&nbsp'.$r->referral_name ?? 'NA';
                $nestedData['referral_position'] =$r->referral_position ?? "NA";
                $nestedData['type_ofaction_taken'] =$r->type_ofaction_taken ?? "NA";
                if($r->status == "Close")
                    $nestedData['status'] = '<span class="badge badge-success">'.$r->status.'</span>';
                elseif($r->status == "Open"){
                    $nestedData['status'] = '<span class="badge badge-warning">'.$r->status.'</span>';
                }
                $nestedData['feedback_summary'] =$r->feedback_summary  ?? "NA";

                if($r->feedback_referredorshared == "No" && $r->status == "Open"){
                    $view   ='<a class="btn btn-sm btn-clean btn-icon"" title="View" href="'.$show_url.'">
                                <i class="fa fa-eye"></i>
                                </a>';
                    $edit   ='<a title="Edit" class="btn btn-sm btn-clean btn-icon"
                                href="'.$edit_url.'">
                                <i class="fa fa-pencil"></i></a>';
                    $delete ='<a class="btn btn-sm btn-clean btn-icon" title="Delete" href="'.$delete_url.'">
                                <i class="fa fa-trash"></i>
                                </a>';
                    $nestedData['update_response'] ='NA';
                }
                elseif($r->feedback_referredorshared == "Yes" && $r->status == "Open"){
                    $view   ='<a class="btn btn-sm btn-clean btn-icon"" title="View" href="'.$show_url.'">
                                <i class="fa fa-eye"></i>
                                </a>';
                    $edit   ='<a title="Edit" class="btn btn-sm btn-clean btn-icon"
                                href="'.$edit_url.'">
                                <i class="fa fa-pencil"></i></a>';
                    $delete ='<a class="btn btn-sm btn-clean btn-icon" title="Delete" href="'.$delete_url.'">
                                <i class="fa fa-trash"></i>
                                </a>';
                    $nestedData['update_response'] ='<div><td><a class=""" title="View" href="'.$update_response_url.'"><span class="badge badge-primary">'
                                                    .'Update Response'.
                                                    '</span></a></td></div>';
                }
                elseif($r->feedback_referredorshared == "Yes" && $r->status == "Close"){
                    $view   = '<a class="btn btn-sm btn-clean btn-icon"" title="View" href="'.$show_url.'">
                                <i class="fa fa-eye"></i>
                                </a>';
                    $edit   = '';
                    $delete = '';
                    $nestedData['update_response'] ='<div><td><span class="badge badge-success">'
                                                    .'Status Closed'.
                                                    '</span></td></div>';
                }



				$nestedData['action'] ='<div>
                                        <td>'. $view  .$edit.  $delete


                                        .'</td>
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
        return view('admin.frm.create');
    }
    public function getUpdate_response($id)
    {
        $frm        = Frm::find($id);
        $responses  = FrmResponse::where('fbreg_id',$id)->get();
        return view('admin.frm.update_response',compact('frm','responses'));
    }


    public function store(CreatefrmRequest $request)
    {

        if($request->allow_contact == "Yes"){
            $validator = $request->validate([
                'contact_number' => 'required|numeric|min:11',
            ]);

        }

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

        if($request->status == "Close"){
            $validatedData = $request->validate([
                'actiontaken' => ['required'],
            ]);
        }

        $data = $request->except('_token');
        $this->frmRepository->storeFrm($data);
        return redirect()->route('frm-managements.index');
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
        if(!empty($frm))
        {
            return view('admin.frm.edit',compact('frm'));
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
        }
        else{
            $statis = 'NA';
        }
        $frm = Frm::where('id',$request->frm_id)->update([
            'status'                => $request->status,
            'response_summary'      => $request->feedback_response,
            'type_ofaction_taken'   => $statis
        ]);
        $frm = FrmResponse::create([
            'follow_up_date'    => $request->date_feedback_referred,
            'response_summary'  => $request->feedback_response,
            'fbreg_id'          => $request->frm_id,
        ]);
        return redirect()->route('frm-managements.show', $request->frm_id);

    }
    public function destroy(string $id)
    {
        $frm =Frm::find($id);
        if(!empty($frm))
        {
            return redirect()->route('frm-managements.index');
        }
    }
    public function getexportform(Request $request){
        return view('admin.frm.export');
    }
    public function getexportfrm(Request $request){
        // Load users
        $users = Frm::all();
        (new FastExcel($users))->export('file.xlsx');
    }
}
