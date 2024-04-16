<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProjectReview;

class ProjectReviewController extends Controller
{
   
    public function index()
    {
        //
    }

    public function createreview($id)
    {
        $persons = User::role('focal person')->get();
        $id  = $id;
       
        addJavascriptFile('assets/js/custom/project/reviewmeeting.js');
        return view('admin.projects.review.create',compact('persons','id'));
    }

    public function project_reviews(Request $request){
        $id = $request->qb_id;
        $columns = array(
			0 => 'id',
			1 => 'comments',
			2 => 'document',
            8 => 'created_by',
            9 => 'created_at',

		);
		
		$totalData = ProjectReview::where('project_id',$request->project_id)->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
	
        $reviews = ProjectReview::where('project_id',$request->project_id)->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        $totalFiltered = ProjectReview::where('project_id',$request->project_id)->count();
    
		
		
		$data = array();
		
		if($reviews){
			foreach($reviews as $r){
                $download_url = route('download.qb_attachments',$r->id);
				$nestedData['meeting_title'] = $r->meeting_title;
                $nestedData['review_date'] = date('M d ,Y', strtotime($r->created_at));
                $nestedData['responsible_person'] = $r->rp->name;
                $nestedData['action_agreed'] = $r->action_agreed;
                $nestedData['deadline'] = date('M d ,Y', strtotime($r->created_at)); 
                $nestedData['status'] = $r->status;
                $nestedData['id'] = $r->id;
				$nestedData['action'] = '
                                <div>
                                <td>
                                   
                                    <a class="btn   btn-clean btn-icon" onclick="event.preventDefault();view('.$r->id.');" title="View Monitor Visit" href="javascript:void(0)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn   btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
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
    public function create()
    {
     
    }


    public function store(Request $request)
    {
      
        $reviews = ProjectReview::create([
            'meeting_title'         => $request->title,
            'review_date'           => $request->review_date,
            'responsible_person'    => $request->responsible_person,
            'action_agreed'         => $request->action_agreed,
            'deadline'              => $request->deadline,
            'status'                => $request->status,
            'dip_identified'        => $request->dip_identified,
            'project_id'            => $request->project_id,
        ]);
        $editUrl = route('projectreviews.show',$request->project_id);
        return response()->json([
            'editUrl' => $editUrl
        ]);
    
    }


    public function show(string $id)
    {
        $id  = $id;
        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/project/reviewmeeting.js');
        return view('admin.projects.review.project_review',compact('id'));
    }

    public function view_review(Request $request){
        $id  = $request->id;
       
        $review = ProjectReview::find($id);
        return view('admin.projects.review.project_review_detail',compact('review'));
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
