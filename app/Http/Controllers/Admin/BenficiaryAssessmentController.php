<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\District;
use App\Models\Province;

class BenficiaryAssessmentController extends Controller
{
    public function beneficiaryAssessmentForm(){

        $projects = Project::where('active',1)->orderBy('name')->get();
        $provinces = Province::orderBy('province_name')->get();
       
        addJavascriptFile('assets/js/custom/benficaryAssessment/create.js');
        addJavascriptFile('assets/js/custom/benficaryAssessment/general.js');
        return view('admin.benificiaryAssessment.create',compact('projects','provinces'));
    }

    public function submitBeneficiaryAssessmentForm(Request $request){
        dd($request->all());
    }
}
