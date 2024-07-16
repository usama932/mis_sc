<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QBAttachement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\QualityBench;
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
                $download_url = route('download.qb_attachments',$r->id);
				$nestedData['id'] = $r->id;
				$nestedData['comments'] = $r->comments;
                $nestedData['document'] = '<a class="btn   btn-clean btn-icon" title="Download Attachment" href=""'.$download_url.'"">
                                            Download</a>';
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
        $qb_id = $request->quality_bench_id;
        $qb = QualityBench::where('id', $qb_id)->first();
        
        if ($request->hasFile('document')) {
            $province_paths = [
                1 => 'punjab',
                2 => 'kp',
                3 => 'baluchistan',
                4 => 'sindh',
                5 => 'gilgit',
                6 => 'kashmir',
                7 => 'federal',
            ];
        
            $path_suffix = $province_paths[$qb->province] ?? 'miscellaneous';
            $path = storage_path("app/public/qbattachment/{$path_suffix}/" . $request->document);
        
            if (File::exists($path)) {
                File::delete($path);
            }
        
            $file = $request->file('document');
            $filename = $file->getClientOriginalName();
            $file->storeAs("public/qbattachment/{$path_suffix}", $filename);
        }


        if($request->id == ''){
            $qbattachment = QBAttachement::create([
                'document'                  => $filename ?? '',
                'comments'                  => $request->comments ?? '',
                'created_by'                => auth()->user()->id,
                'quality_bench_id'          => $request->quality_bench_id,
                'generating_observation'    => $request->generating_observation
            ]);
        }
        else{
            $qb_attach = QBAttachement::where('id',$request->id)->first();
            $qbattachment = QBAttachement::where('id',$request->id)->update([
                'document'                  => $filename ?? $qb_attach->document,
                'comments'                  => $request->comments,
                'created_by'                => auth()->user()->id,
                'quality_bench_id'          => $request->quality_bench_id,
            ]);
        }

        $qb         = QualityBench::where('id',$request->quality_bench_id)->first();
        if($qb->theme == '5'){
            $actiontheme = 6;
        }else{
            $actiontheme = $qb->theme;
        }
        $qb_theme   = User::where('theme_id',$actiontheme)->first();
        
        // if(!empty($qb_theme ) && !empty($qb->action_point)){
        //     if($qb->action_point->count() >= 1){
        //         $email = $qb_theme->email;
           
        //         $bccEmails = [ 'walid.malik@savethechildren.org','usama.qayyum@savethechildren.org'];
        //         $details = [
        //             'id'            => $qb->id,
        //             'village'       => $qb->village,
        //             'activity'      => $qb->activity_description,
        //             'response_id'   => $qb->assement_code,
        //             'action_point'  => $qb->action_point,
        //             'date_visit'    => $qb->date_visit,
        //         ];
        //         $subject = "[Quality Benchmark] ". $qb->activity_description ." in ". $qb->village ;
        //         Mail::to($email)
        //         ->bcc($bccEmails)
        //         ->send(new \App\Mail\QBMail($details,$subject));
        //     }
            
        // }
        session(['active' => $active]);
        $editUrl = route('quality-benchs.edit',$request->quality_bench_id);
     
        return response()->json([
            'editUrl' => $editUrl
        ]);
    }

    public function download_attachment($id){

        $qb_attachment = QBAttachement::find($id);
        $qb_id = $qb_attachment->quality_bench_id;
        $qb = QualityBench::where('id', $qb_id)->first();
        $province_paths = [
            1 => 'punjab',
            2 => 'kp',
            3 => 'baluchistan',
            4 => 'sindh',
            5 => 'gilgit',
            6 => 'kashmir',
            7 => 'federal',
        ];
        
        $path_suffix = $province_paths[$qb->province] ?? 'miscellaneous';
       
	    if(!empty($qb_attachment)){
            $path = storage_path("app/public/qbattachment/{$path_suffix}/" . $qb_attachment->document); 
            if(File::exists($path)){   
            }
            else{
                Session::flash('success_message', 'Something Went Wrong!');
                return redirect()->back();
            }
		   
	    }

	    return redirect()->back();
    }
   
   
    
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
    public function showPDF($id)
    {
    
        $qb_attachment = QBAttachement::find($id);
        $qb_id = $qb_attachment->quality_bench_id;
        
        $qb = QualityBench::where('id', $qb_id)->first();
        $province_paths = [
            1 => 'punjab',
            2 => 'kp',
            3 => 'baluchistan',
            4 => 'sindh',
            5 => 'gilgit',
            6 => 'kashmir',
            7 => 'federal',
        ];
        
        $path_suffix = $province_paths[$qb->province] ?? 'miscellaneous';
      
        $path = storage_path("app/public/qbattachment/{$path_suffix}/" . $qb_attachment->document);
       
        $file = Storage::get("public/qbattachment/{$path_suffix}/" . $qb_attachment->document);
        
        $response = response($file, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename= $qb_attachment->document.".pdf"',
        ]);

        return $response;
    }
}