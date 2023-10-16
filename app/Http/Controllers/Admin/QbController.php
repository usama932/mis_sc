<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QualityBench;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Http\Requests\CreateQbRequest;
use App\Http\Requests\UpdateQbRequest;
use Illuminate\Support\Facades\Session;
use App\Repositories\Interfaces\QbRepositoryInterface;

class QbController extends Controller
{
    private $QbRepository;

    public function __construct(QbRepositoryInterface $QbRepository)
    {
        $this->QbRepository = $QbRepository;
    }
    public function index()
    {
        //
    }

   
    public function create()
    {
        $projects = Project::latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        return view('admin.quality_bench.create',compact('projects','themes','users'));
    }

   
    public function store(CreateQbRequest $request)
    {
        $data = $request->except('_token');
        $Qb = $this->QbRepository->storeQb($data);
        
        return redirect()->route('quality-benchs.edit',$Qb->id);
        
    }


    public function show(string $id)
    {
        //
    }

  
    public function edit(string $id)
    {
        $projects = Project::latest()->get();
        $themes = Theme::latest()->get();
        $users = User::where('user_type','R2')->orwhere('user_type','R1')->get();
        $qb = QualityBench::find($id);
        $active = 'basic_info';
        if(session('active') == ''){
            session(['active' => $active]);
        }
        
        return view('admin.quality_bench.edit',compact('projects','themes','users','qb'));
    }

  
    public function update(UpdateQbRequest $request, string $id)
    {
        $data = $request->except('_token');
        $Qb = $this->QbRepository->updateQb($data,$id);
        return redirect()->back()->with('success','Quality Bench Updated');
    }

 
    public function destroy(string $id)
    {
        //
    }
    public function monitor_visits(Request $request){
        dd($request->all());
    }
    public function action_points(Request $request){
        dd($request->all());
    }
    public function attachments(Request $request){
        dd($request->all());
    }
}
