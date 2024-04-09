<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClosingRecord;


class CloseRecordController extends Controller
{
    
    public function index()
    {
        $record = ClosingRecord::latest()->first();
        return view('admin.settings.close_records',compact('record'));
    }

    
    public function create()
    {
        //
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
        $record = ClosingRecord::find($id);
        return view('admin.settings.edit_close_records',compact('record'));
    }


    public function update(Request $request, string $id)
    {
        
        $record = ClosingRecord::where('id',$id)->update([
            'frm_close_date' => $request->frm_close_date,
            'frm_close_upto' => $request->frm_close_upto,
            'qb_close_date' => $request->qb_close_date,
            'qb_close_upto' => $request->qb_close_upto,
        ]);
        return redirect()->route('close_records.index');
    }


    public function destroy(string $id)
    {
        //
    }
}
