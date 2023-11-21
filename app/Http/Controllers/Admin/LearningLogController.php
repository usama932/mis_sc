<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LearningLog;

class LearningLogController extends Controller
{
   
    public function index()
    {
        addVendors(['datatables']);
        return view('admin.learninglogs.index');
    }
    public function get_learninglogs(Request $request){
        $id = $request->qb_id;
        $columns = array(
			0 => 'id',
			1 => 'title',
			2 => 'project',
            2 => 'project_type',
            2 => 'research_type',
            2 => 'thumbnail',
            8 => 'created_by',
           

		);
		
		$totalData = LearningLog::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		
        $logs = LearningLog::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        $totalFiltered = LearningLog::count();
	
		
		$data = array();
		
		if($logs){
			foreach($logs as $r){
                $download_url = route('download.qb_attachments',$r->id);
				
                $nestedData['title'] = $r->title;
                $nestedData['project'] = $r->project;
                $nestedData['project_type'] = $r->project_type;
                $nestedData['research_type'] = '';
                $nestedData['thumbnail'] = 'thumbnail';
                $nestedData['created_by'] = $r->created_by;
				$nestedData['action'] = '
                                <div>
                                <td>
                                   
                                    <a class="btn   btn-clean btn-icon" onclick="event.preventDefault();qb_attachmentviewInfo('.$r->id.');" title="View Monitor Visit" href="javascript:void(0)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn   btn-clean btn-icon" onclick="event.preventDefault();qb_attachmentdel('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
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
    public function view_learninglog(Request $request){
        
    }
    public function create()
    {
        return view('admin.learninglogs.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

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
