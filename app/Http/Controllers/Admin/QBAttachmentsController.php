<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QBAttachement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use File;

class QBAttachmentsController extends Controller
{
    
    public function index()
    {
        //
    }
    public function get_qb_attachments(Request $request)
    {
        $id = $request->qb_id;
        $columns = array(
			0 => 'id',
			1 => 'comments',
			2 => 'document',
            8 => 'created_by',
            9 => 'created_at',

		);
		
		$totalData = QBAttachement::where('quality_bench_id',$id)->count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$qbattachments = QBAttachement::where('quality_bench_id',$id)->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
			$totalFiltered = QBAttachement::where('quality_bench_id',$id)->count();
		}else{
			$search = $request->input('search.value');
			$qbattachments = QBAttachement::where('quality_bench_id',$id)->where('comments','like',"%{$search}%")
                                    ->offset($start)
                                    ->limit($limit)
                                    ->orderBy($order, $dir)
                                    ->get();
			$totalFiltered = QBAttachement::where('quality_bench_id',$id)->where('comments', 'like', "%{$search}%")
                                            ->orWhere('created_at','like',"%{$search}%")
                                            ->count();
            }
		
		
		$data = array();
		
		if($qbattachments){
			foreach($qbattachments as $r){
				$edit_url = route('monitor_visits.edit',$r->id);
                $download_url = route('download.qb_attachments',$r->id);
				$nestedData['id'] = $r->id;
				$nestedData['comments'] = $r->comments;
                $nestedData['document'] = '<a class="btn btn-sm btn-clean btn-icon" title="Download Attachment" href=""'.$download_url.'"">
                                            Download</a>';
                $nestedData['created_by'] = $r->created_by;
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();qb_attachmentviewInfo('.$r->id.');" title="View Monitor Visit" href="javascript:void(0)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();qb_attachmentdel('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
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
    public function view_qb_attachments(Request $request){
        $qb_attachment = QBAttachement::where('id',$request->id)->first();
        return view('admin.quality_bench.qb_attachment.detail',compact('qb_attachment'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $active = 'qbattachment';

        $validator = Validator::make($request->all(), [
        
            'comments'  => 'required',
            'document'  => 'mimes:doc,pdf,docx,jpeg,png,jpg,xlsx',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if($request->hasFile('document')){
            $file = $request->file('document');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/qbattachment/',$filename);
           
        }
        $qbattachment = QBAttachement::create([
            'document'     => $filename,
            'comments'     => $request->comments,
            'created_by'   => auth()->user()->id,
            'quality_bench_id'     => $request->quality_bench_id,
        ]);
        session(['active' => $active]);
        Session::flash('success_message', 'Attachment Successfully Created!');
        return redirect()->back();
    }

    public function download_attachment($id){
        $qb_attachment = QBAttachement::find($id);
        dd($qb_attachment);
	    if(!empty($qb_attachment)){
            $path = storage_path("app/public/qbattachment/" . $qb_attachment->document);
          
            if(File::exists($path)){
                dd($path);
           
                
            }
            else{
                Session::flash('success_message', 'Something Went Wrong!');
                return redirect()->back();
            }
		   
	    }
	    return redirect()->back();
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $qb_attachment = QBAttachement::find($id);
        $active = 'qbattachment';
	    if(!empty($qb_attachment)){
            $path = storage_path("app/public/qbattachment/" . $qb_attachment->document);
          
            if(File::exists($path)){
               
                File::delete(storage_path('app/public/qbattachment/'.$qb_attachment->document));
    
            }
		    $qb_attachment->delete();
		    Session::flash('success_message', 'QB Attachment successfully deleted!');
            session(['active' => $active]);
	    }
	    return redirect()->back();
    }
}