<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\District;
use App\Models\Province;
use App\Models\BenficiaryAssessment;
use File;

class BenficiaryAssessmentController extends Controller
{

    public function beneficiaryAssessmentlist(){

        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/benficaryAssessment/index.js');
        return view('admin.benificiaryAssessment.index');
    }

    public function beneficiaryAssessments(Request $request){
            // Initialize the query
            $query = BenficiaryAssessment::with(['project', 'user'])->latest();

            // Apply filters if present
            if ($request->filled('project')) {
                $query->where('project_id', $request->project);
            }
           
            // Get the filtered and total count
            $totalData = $query->count();
            $totalFiltered = $totalData; // Since the query is already filtered
            $benficiaryAssessments = $query->get();
          
            // Prepare data for DataTables
            $data = $benficiaryAssessments->map(function ($benficiaryAssessment) {

                return [
                    'id' => $benficiaryAssessment->id,
                    'form_no' => $benficiaryAssessment->form_no ?? '',
                    'project' => $benficiaryAssessment->project->name ?? '', 
                    'name_of_beneficiary' => $benficiaryAssessment->name_of_beneficiary ?? '',
                    'gender' => $benficiaryAssessment->gender ?? '',
                    'age' => $benficiaryAssessment->age ?? '',
                    'contact_number' => $benficiaryAssessment->contact_number ?? '',
                    'cash_assistance' => $benficiaryAssessment->cash_assistance ?? '',
                    'assessment_officer' => $benficiaryAssessment->assessment_officer ?? '',
                    'vc_representative_name' => $benficiaryAssessment->vc_representative_name ?? '',
                    'status'        => $benficiaryAssessment->status ?? '',
                    'created_by' => $benficiaryAssessment->user->name ?? '',
                    'created_at' => $benficiaryAssessment->created_at ? $benficiaryAssessment->created_at->format('M d, Y') : '',
                    'action' => '
                    <a href="' . route('benficiaryAssessment.show', $benficiaryAssessment->id) . '" title="Show">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="' . route('benficiaryAssessment.edit', $benficiaryAssessment->id) . '" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>'
                ];
            });
        
            // Return JSON response for DataTables
            return response()->json([
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data->toArray(),
            ]);
    }

    public function beneficiaryAssessmentForm(){

        $projects = Project::where('active',1)->orderBy('name')->get();
        $provinces = Province::orderBy('province_name')->get();
       
        addJavascriptFile('assets/js/custom/benficaryAssessment/create.js');
        addJavascriptFile('assets/js/custom/benficaryAssessment/general.js');
        return view('admin.benificiaryAssessment.create',compact('projects','provinces'));
    }

    public function submitBeneficiaryAssessmentForm(Request $request){
        //dd($request->all());
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
            'cash_assistance' => 'required',
            'assessment_officer' => 'nullable|string|max:255',
            'beneficiary_name' => 'nullable|string|max:255',
            'vc_representative' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('attachment')) {
            // Get the path to the old file to delete
            $path = storage_path("app/public/benficiary_assessment/" . $request->attachment);
            
            // Check if the file exists before deleting
            if (File::exists($path)) {
                File::delete($path);
            }
            
            // Handle the file upload
            $file = $request->file('attachment'); // corrected to use 'attachment' as in the `hasFile` check
            $filename = time() . '.' . $file->getClientOriginalExtension(); // corrected timestamps() to time()
            $file->storeAs("public/benficiary_assessment", $filename);
        }
        
        // Fetch the last record of BenficiaryAssessment and increment ID for UUID
        $beneficiary_last = BenficiaryAssessment::latest()->first();
        $next_id = $beneficiary_last ? $beneficiary_last->id + 1 : 1;

        $form_no = $next_id."-".time();

        $beneficiary = BenficiaryAssessment::create([
            'form_no' => $form_no,
            'project_id' => $request->project,
            'form_date' => $request->date,
            'gender' => $request->gender,
            'province' => $request->province,
            'district' => $request->district,
            'tehsil' => $request->tehsil,
            'uc' => $request->uc,
            'village' => $request->village,
            'name_of_beneficiary' => $request->name_of_beneficiary,
            'guardian' => $request->guardian,
            'age' => $request->age,
            'beneficiary_contact' => $request->beneficiary_contact,
            'contact_number' => $request->contact_number,
            'hh_girls' => $request->hh_girls,
            'cnic_beneficiary' => $request->cnic_beneficiary,
            'cnic_spouse' => $request->cnic_spouse,
            'cnic_issuance' => $request->cnic_issuance,
            'cnic_expiry' => $request->cnic_expiry,
            'recieve_cash' => $request->recieve_cash,
            'recieve_cash_amount' => $request->recieve_cash_amount,
            'recieve_cash_source' => $request->recieve_cash_source,
            'hh_boys' => $request->hh_boys,
            'hh_segregate' => $request->hh_segregate,
            'hh_monthly_income' => $request->hh_monthly_income,
            'hh_source_income' => $request->hh_source_income,
            'hh_person_earned' => $request->hh_person_earned,
            'hh_outstanding_debt' => $request->hh_outstanding_debt,
            'house_demage' => $request->house_demage,
            'hh_minority' => $request->hh_minority,
            'reffered_tls' => $request->reffered_tls,
            'hh_died_female' => $request->hh_died_female,
            'hh_died_male' => $request->hh_died_male,
            'hh_injured_female' => $request->hh_injured_female,
            'hh_injured_male' => $request->hh_injured_male,
            'hh_disabled_girls' => $request->hh_disabled_girls,
            'hh_disabled_boys' => $request->hh_disabled_boys,
            'hh_disabled_men' => $request->hh_disabled_men,
            'hh_disabled_women' => $request->hh_disabled_women,
            'large_animal_perished' => $request->large_animals,
            'small_animal_perished' => $request->small_animals,
            'hh_orphan_girls' => $request->orphan_girls,
            'hh_orphan_boys' => $request->orphan_boys,
            'land_destroyed' => $request->land_destroyed,
            'hh_widow' => $request->widows_count,
            'hh_pragnant' => $request->pregnant_women,
            'hh_meal_inday' => $request->meals_per_day,
            'cash_assistance' => $request->cash_assistance,
            'assessment_officer' => $request->assessment_officer,
            'beneficiary_name' => $request->beneficiary_name,
            'vc_representative_name' => $request->vc_representative,
            'attachment' =>  $filename,
            'status'  => 'waiting',
            'created_by' => auth()->user()->id,
        ]);


        return response()->json([
            "error" => false,
            'status' => 'success',
            'message' => 'Account successfully created!',
            'data' => $beneficiary
        ]);
    }
    
    public function Show($id){
        $benficiaryAssessment = BenficiaryAssessment::Find($id);
        return view('admin.benificiaryAssessment.show', compact('benficiaryAssessment'));
    }

    public function edit($id){

    }

    public function destroy($id){
        
    }
}
