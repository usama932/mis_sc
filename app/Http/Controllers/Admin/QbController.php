<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QualityBench;
use App\Models\Project;
use App\Models\Theme;
use App\Models\User;
use App\Http\Requests\CreateQbRequest;
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
        return view('admin.quality_bench.edit',compact('projects','themes','users','qb'));
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
