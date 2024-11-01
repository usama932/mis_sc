<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\District;
use App\Models\Province;
use App\Models\BenficiaryAssessment;

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
        $validatedData = $request->validate([
            'project' => 'required|integer',
            'date' => 'required|date',
            'province' => 'required|integer',
            'district' => 'required|integer',
            'tehsil' => 'required|integer',
            'uc' => 'required|integer',
            'village' => 'required|string|max:255',
            'subvillage' => 'nullable|string|max:255',
            'name_of_beneficiary' => 'required|string|max:255',
            'guardian' => 'nullable|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'age' => 'required|integer|min:0',
            'beneficiary_contact' => 'required|string',
            'contact_number' => 'nullable|string|max:15',
            'hh_segregate' => 'required|string',
            'hh_girls' => 'nullable|integer|min:0',
            'hh_boys' => 'nullable|integer|min:0',
            'cnic_beneficiary' => 'nullable|string|max:15',
            'cnic_spouse' => 'nullable|string|max:15',
            'cnic_issuance' => 'nullable|date',
            'recieve_cash' => 'required|in:Yes,No',
            'recieve_cash_amount' => 'nullable|integer|min:0',
            'recieve_cash_source' => 'nullable|string|max:255',
            'hh_monthly_income' => 'nullable|integer|min:0',
            'hh_source_income' => 'nullable|string|max:255',
            'hh_person_earned' => 'nullable|integer|min:0',
            'hh_outstanding_debt' => 'nullable|integer|min:0',
            'house_demage' => 'nullable|string',
            'hh_minority' => 'required|in:yes,no',
            'reffered_tls' => 'required|in:yes,no',
            'hh_died_female' => 'nullable|integer|min:0',
            'hh_died_male' => 'nullable|integer|min:0',
            'hh_injured_female' => 'nullable|integer|min:0',
            'hh_injured_male' => 'nullable|integer|min:0',
            'hh_disabled_girls' => 'nullable|integer|min:0',
            'hh_disabled_boys' => 'nullable|integer|min:0',
            'hh_disabled_women' => 'nullable|integer|min:0',
            'hh_disabled_men' => 'nullable|integer|min:0',
            'large_animals' => 'nullable|integer|min:0',
            'small_animals' => 'nullable|integer|min:0',
            'orphan_girls' => 'nullable|integer|min:0',
            'orphan_boys' => 'nullable|integer|min:0',
            'land_destroyed' => 'nullable|integer|min:0',
            'widows_count' => 'nullable|integer|min:0',
            'pregnant_women' => 'nullable|integer|min:0',
            'meals_per_day' => 'nullable|integer|min:0',
            'cash_assistance' => 'required|in:yes,no',
            'assessment_officer' => 'nullable|string|max:255',
            'beneficiary_name' => 'nullable|string|max:255',
            'vc_representative' => 'nullable|string|max:255',
        ]);

        // Save the validated data to the database
        BenficiaryAssessment::create($validatedData);

        // Redirect or return a success response
        return redirect()->back()->with('success', 'Assessment saved successfully!');
    }
}
