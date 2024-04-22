<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProjectReview;
use App\Models\Review_ActionPoint;
use Illuminate\Support\Facades\Validator;

class ProjectReviewController extends Controller
{
   
    public function index()
    {
        //
    }

    public function createreview($id)
    {
        $persons = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['focal person', 'budget holder','awards','partner','']);
        })->get();
        $id  = $id;
        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/project/reviewmeeting.js');
        return view('admin.projects.review.create',compact('persons','id'));
    }

    public function project_reviews_actionpoint(Request $request){
        $id = $request->review_id;
        $columns = array(
			0 => 'id',
			1 => 'comments',
			2 => 'document',
            8 => 'created_by',
            9 => 'created_at',

		);
		
		$totalData = Review_ActionPoint::where('review_id',$request->review_id)->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
	
        $reviews = Review_ActionPoint::where('review_id',$request->review_id)->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        $totalFiltered = Review_ActionPoint::where('review_id',$request->review_id)->count();	
		$data = array();
		
		if($reviews){
			foreach($reviews as $r){
             
                $show_url =  route('projectreviews.edit',$r->id);
				$nestedData['action_point'] = $r->action_point;
                $responsible_person_logs = json_decode($r->responsible_person , true);
                $responsible_person  = User::whereIn('id', $responsible_person_logs)
                ->pluck('name')
                ->toArray();
                $persons = implode(', ', $responsible_person);
                $nestedData['responsible_person'] = $persons ?? '';
                $nestedData['agreed_action'] = $r->agreed_action ?? '';
                $nestedData['deadline'] = $r->deadline;
                $nestedData['status'] = $r->status;
                $nestedData['id'] = $r->id;
				$nestedData['action'] = '
                                <div>
                                <td>
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
                $show_url =  route('projectreviews.edit',$r->id);
				$nestedData['meeting_title'] = $r->meeting_title;
                $nestedData['review_date'] = date('M d ,Y', strtotime($r->created_at));
                $nestedData['project'] = $r->project?->name ?? '';
                $nestedData['id'] = $r->id;
				$nestedData['action'] = '
                                <div>
                                <td>
                                   
                                    <a class="mx-1" title="View Monitor Visit" href="'.$show_url.'">
                                    <i class="fa fa-eye text-success" aria-hidden="true"></i>
                                    </a>
                                    <a class="mx-1 " onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
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
       
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'review_date' => 'required|date',
            'addmore.*.action_point' => 'required|string|max:255',
            'addmore.*.responsible_person' => 'required',
            'addmore.*.action_agreed' => 'required',
            'addmore.*.deadline' => 'required',
            'addmore.*.status' => 'required',
        ]);
    
        $editUrl = route('projectreviews.show',$request->project_id);
        if ($validator->fails()) {
            return response()->json([
                'editUrl' => $editUrl,
                'message' => $validator,
                'error'   => true
            ]);
        }
        $reviews = ProjectReview::create([
            'meeting_title'         => $request->title,
            'review_date'           => $request->review_date,
            'project_id'            => $request->project_id,
        ]);
        foreach($request->input('addmore') as $key => $value) {       
            Review_ActionPoint::create([
                'responsible_person' =>  json_encode($value['responsible_person']),
                'agreed_action' =>$value['action_agreed'],
                'deadline' =>$value['deadline'],
                'status'=>$value['status'],
                'action_point' =>$value['action_point'],
                'project_id' =>$request->project_id,
                'review_id' =>$reviews->id,
            ]);
          
        }
       
        
        return response()->json([
            'editUrl' => $editUrl,
            'message' => 'Review Submitted',
            'error'   => false
        ]);
        return redirect()->route('projectreviews.show',$request->project_id);
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
       
        $id  = $id;
        $review = ProjectReview::find($id);
        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/project/reviewmeeting.js');
        return view('admin.projects.review.project_review_action_point',compact('id','review'));
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $review = ProjectReview::find($id);
        $review->action_point?->each?->delete();
        $review->delete();
        return redirect()->back();
    }
}
