<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatefrmRequest;
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
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['name_of_registrar'] = $r->name_of_registrar;


				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Client" href="javascript:void(0)">
                                    <i class="fa fa-eye"></i>
                                    </a>
                                    <a title="Edit Client" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Client" href="javascript:void(0)">
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
