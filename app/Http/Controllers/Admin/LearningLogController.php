<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LearningLog;

class LearningLogController extends Controller
{
   
    public function index()
    {
        return view('admin.learninglogs.index');
    }
    public function get_learninglogs(Request $request){

    }
    public function view_learninglog(Request $request){
        
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
