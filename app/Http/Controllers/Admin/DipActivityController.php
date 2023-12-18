<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dip;
use App\Models\DipActivity;
use App\Repositories\Interfaces\DipActivityInterface;

class DipActivityController extends Controller
{
    private $dipactivityRepository;

    public function __construct(DipActivityInterface $dipactivityRepository)
    {
        $this->dipactivityRepository = $dipactivityRepository;
    }
    public function index()
    {
        dd('as');
        return view('admin.dip.index');
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
      
        $data = $request->except('_token');
        $dip_activity = $this->dipactivityRepository->storedipactivity( $data);
        $active = 'dip_activity';
        $editUrl = route('dips.edit',$dip_activity->dip_id);
     
        return response()->json([
            'editUrl' => $editUrl
        ]);

        dd('ss');
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
