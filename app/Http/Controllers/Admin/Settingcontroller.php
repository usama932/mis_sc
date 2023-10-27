<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use File;


class Settingcontroller extends Controller
{
    
    public function index()
    {
        $settings = Setting::pluck('value','name')->all();
        $all_columns =array(
            array(
                'name'=>'frm_lock_date',
                'id'=>'frm_lock_date',
                'type'=>'text',
                'label'=>'FRM Lock Date',
                'place_holder'=>'Enter FRM Lock Date',
                'class'=>'form-control form-control-solid',
            ),
            array(
                'name'=>'qb_lock_date',
                'id'=>'qb_lock_date',
                'type'=>'text',
                'label'=>'QBs Lock Date',
                'place_holder'=>'Enter QBs Lock Date',
                'class'=>'form-control form-control-solid',
            )
        

        );
       
        return view('admin.settings.index', ['title' => 'Site Setting','settings'=>$settings,
            'all_columns'=>$all_columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
        //
    }
}
