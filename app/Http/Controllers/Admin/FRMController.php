<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatefrmRequest;
use App\Http\Requests\UpdatefrmRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Frm;
use App\Repositories\Interfaces\FrmRepositoryInterface;

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
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Frm::count();
		}else{
			$search = $request->input('search.value');
			$frms = Frm::offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Frm::count();
		}


		$data = array();

		if($frms){
			foreach($frms as $r){
				$edit_url = route('frm-managements.edit',$r->id);
                $show_url = route('frm-managements.show',$r->id);
                $delete_url = route('frm-managements.destroy',$r->id);
				$nestedData['id'] = $r->id + 1000;
				$nestedData['name_of_registrar'] = $r->name_of_registrar;
                $nestedData['date_received'] = $r->date_received;
                $nestedData['feedback_channel'] = $r->feedback_channel;
                $nestedData['name_of_client'] = $r->name_of_client;
                $nestedData['type_of_client'] = $r->type_of_client;
                $nestedData['gender'] = $r->gender;
                $nestedData['age'] = $r->age;
                $nestedData['province'] = $r->name_of_registrar;
                $nestedData['district'] = $r->district;
                $nestedData['tehsil'] = $r->tehsil;
                $nestedData['uc'] ='&nbsp'.$r->union_counsil;
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
                $nestedData['status'] = $r->status;
                $nestedData['feedback_summary'] =$r->feedback_summary  ?? "NA";
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon"" title="View Client" href="'.$show_url.'">
                                    <i class="fa fa-eye"></i>
                                    </a>
                                    <a title="Edit Client" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" title="Delete Client" href="'.$delete_url.'">
                                    <i class="fa fa-trash"></i>
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
        return view('admin.frm.create');
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
        if(!empty($frm))
        {
            return view('admin.frm.show',compact('frm'));
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


    public function destroy(string $id)
    {
        $frm =Frm::find($id);
        if(!empty($frm))
        {
            return redirect()->route('frm-managements.index');
        }
    }
}
