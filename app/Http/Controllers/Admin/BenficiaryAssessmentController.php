<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\District;
use App\Models\Province;
use App\Models\BenficiaryAssessment;
use App\Models\BatchNumber;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Jobs\ProcessBeneficiaryAction;
use File;

class BenficiaryAssessmentController extends Controller
{

    public function beneficiaryAssessmentlist(){

        $projects   = Project::where('active',1)->orderBy('name')->get();
        $provinces  = Province::orderBy('province_name')->get();
      
        $form_nums  = BenficiaryAssessment::latest()->pluck('form_no','id');
        $contacts   = BenficiaryAssessment::latest()->pluck('beneficiary_contact','id');
        $cnics      = BenficiaryAssessment::latest()->pluck('cnic_beneficiary','id');
       // dd($form_nums);
        addVendors(['datatables']);
        addJavascriptFile('assets/js/custom/benficaryAssessment/index.js');
        //  return view('admin.benificiaryAssessment.criteria',compact('projects','provinces','form_nums','contacts','cnics'));
        return view('admin.benificiaryAssessment.index',compact('projects','provinces','form_nums','contacts','cnics'));
    }

    public function beneficiaryAssessments(Request $request)
    {
        $query = BenficiaryAssessment::query();
        
        if ($request->project) {
            $query->where('project_id', $request->project);
        }
        if ($request->province) {
            $query->where('province', $request->province);
        }
        if ($request->district) {
            $query->where('district', $request->district);
        }
        if ($request->tehsil) {
            $query->where('tehsil', $request->tehsil);
        }
        if ($request->uc) {
            $query->where('uc', $request->uc);
        }
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }
        if ($request->age_min) {
           
            $query->where('age', '>=', $request->age_min);
        }
        if ($request->age_max) {
            $query->where('age', '<=', $request->age_max);
        }
        if ($request->recieve_cash) {
            $query->where('recieve_cash', $request->recieve_cash);
        }
        if ($request->average_monthly_income_min) {
            $query->where('hh_monthly_income', '>=', $request->average_monthly_income_min);
        }
        if ($request->average_monthly_income_max) {
            $query->where('hh_monthly_income', '<=', $request->average_monthly_income_max);
        }
    
        $filters = [
            'hh_under5_girls' => ['min' => $request->hh_under5_girls_min, 'max' => $request->hh_under5_girls_max],
            'hh_under5_boys' => ['min' => $request->hh_under5_boys_min, 'max' => $request->hh_under5_boys_max],
            'hh_under5_7_girls' => ['min' => $request->hh_under5_7_girls_min, 'max' => $request->hh_under5_7_girls_max],
            'hh_under5_7_boys' => ['min' => $request->hh_under5_7_boys_min, 'max' => $request->hh_under5_7_boys_max],
            'hh_above18_girls' => ['min' => $request->hh_above18_girls_min, 'max' => $request->hh_above18_girls_max],
            'hh_above18_boys' => ['min' => $request->hh_above18_boys_min, 'max' => $request->hh_above18_boys_max],
        ];
        
        foreach ($filters as $column => $range) {
            if (!empty($range['min']) && !empty($range['max'])) {
                $query->whereBetween($column, [$range['min'], $range['max']]);
            } elseif (!empty($range['min'])) {
                $query->where($column, '>=', $range['min']);
            } elseif (!empty($range['max'])) {
                $query->where($column, '<=', $range['max']);
            }
        }
        
    
        $query = $query->with([
                'project:id,name', 
                'user:id,name', 
                'batchs:id,batch_number'
            ])
            ->select(
                'id', 'form_no', 'gender','assessment_cat', 'project_id', 
                'hh_under5_girls', 'hh_under5_boys', 'hh_under5_7_girls', 
                'hh_under5_7_boys', 'hh_above18_girls', 'hh_above18_boys',
                'name_of_beneficiary', 'gender', 'age', 'hh_monthly_income', 
                'house_demage', 'beneficiary_contact', 'cash_assistance', 
                'assessment_officer', 'vc_representative_name', 
                'status', 'created_by', 'created_at'
            )
            ->latest();
    
        // Apply filters if present
        if ($request->filled('project')) {
            $query->where('project_id', $request->project);
        }
    
        // Count total and filtered records
        $totalData = $query->count();
        $benficiaryAssessments = $query->paginate($request->length);
    
        // Prepare data for DataTables
        $data = $benficiaryAssessments->map(function ($benficiaryAssessment) {
            return [
                'id' => '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="beneficiries[]" value="'.$benficiaryAssessment->id.'"><span></span></label></td>',
                
                'form_no' => $benficiaryAssessment->form_no ?? '',
                'assessment' => $benficiaryAssessment->assessment_cat ?? '',
                'project' => $benficiaryAssessment->project?->name ?? '', 
                'gender' => $benficiaryAssessment->gender ?? '', 
                'hh_under5_girls' => $benficiaryAssessment->hh_under5_girls ?? '',
                'hh_under5_boys' => $benficiaryAssessment->hh_under5_boys ?? '',
                'hh_under5_7_girls' => $benficiaryAssessment->hh_under5_7_girls ?? '',
                'hh_under5_7_boys' => $benficiaryAssessment->hh_under5_7_boys ?? '',
                'hh_above18_girls' => $benficiaryAssessment->hh_above18_girls ?? '',
                'hh_above18_boys' => $benficiaryAssessment->hh_above18_boys ?? '',
                'name_of_beneficiary' => $benficiaryAssessment->name_of_beneficiary ?? '',
                'age' => $benficiaryAssessment->age ?? '',
                'hh_monthly_income' => $benficiaryAssessment->hh_monthly_income ?? '',
                'house_demage' => $benficiaryAssessment->house_demage ?? '',
                'contact_number' => $benficiaryAssessment->beneficiary_contact ?? '',
                'cash_assistance' => $benficiaryAssessment->cash_assistance ?? '',
                'assessment_officer' => $benficiaryAssessment->assessment_officer ?? '',
                'vc_representative_name' => $benficiaryAssessment->vc_representative_name ?? '',
                'status' => $benficiaryAssessment->status ?? '',
                'created_by' => $benficiaryAssessment->user->name ?? '',
                'created_at' => $benficiaryAssessment->created_at ? $benficiaryAssessment->created_at->format('M d, Y') : '',
                'action' => '<a href="' . route('benficiaryAssessment.show', $benficiaryAssessment->id) . '" title="Show">
                                <i class="fa fa-eye"></i>
                             </a>
                             <a href="' . route('benficiaryAssessment.edit', $benficiaryAssessment->id) . '" title="Edit">
                                <i class="fa fa-edit"></i>
                             </a>'
            ];
        });
    
        // Return JSON response
        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data,
        ]);
    }
    
    public function beneficiaryAssessmentForm(){

        $projects   = Project::where('active',1)->orderBy('name')->get();
        $provinces  = Province::orderBy('province_name')->get();
        $provinces  = Province::orderBy('province_name')->get();
        $batches    = BatchNumber::latest()->get();

        addJavascriptFile('assets/js/custom/benficaryAssessment/create.js');
        addJavascriptFile('assets/js/custom/benficaryAssessment/general.js');
        return view('admin.benificiaryAssessment.create',compact('projects','provinces','batches'));
    }

    public function submitBeneficiaryAssessmentForm(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        $filename = $this->handleFileUpload($request);

        // Generate a unique form number
        $form_no = $this->generateFormNumber();

        // Create beneficiary record
        $beneficiary = BenficiaryAssessment::create([
            'assessment_cat' => $request->assessment_cat,
            'project_id'    => $request->project,
            'date'          => $request->date,
            'province'      => $request->province,
            'district'      => $request->district,
            'tehsil'        => $request->tehsil,
            'uc'            => $request->uc,
            'village'       => $request->village,
            'subvillage'    => $request->subvillage,
            'guardian'      => $request->guardian,
            'gender'        => $request->gender,
            'age'           => $request->age,
            'batch_id'          => $request->batch_number,
            'name_of_beneficiary'   => $request->name_of_beneficiary,
            'beneficiary_contact'   => $request->beneficiary_contact,
            'relative_contact_number'=> $request->relative_contact_number,
            'hh_under5_girls'       => $request->hh_under5_girls,
            'hh_under5_boys'        => $request->hh_under5_boys,
            'hh_under5_7_girls'     => $request->hh_under5_7_girls,
            'hh_under5_7_boys'      => $request->hh_under5_7_boys,
            'hh_above18_girls'      => $request->hh_above18_girls,
            'hh_above18_boys'       => $request->hh_above18_boys,
            'cnic_beneficiary'      => $request->cnic_beneficiary,
            'cnic_spouse'           => $request->cnic_spouse,
            'cnic_issuance'         => $request->cnic_issuance,
            'cnic_expiry'           => $request->cnic_expiry,
            'recieve_cash'          => $request->recieve_cash,
            'recieve_cash_amount'   => $request->recieve_cash_amount,
            'recieve_cash_source'   => $request->recieve_cash_source,
            'hh_monthly_income'     => $request->hh_monthly_income,
            'hh_source_income'      => $request->hh_source_income,
            'hh_person_earned'      => $request->hh_person_earned,
            'hh_outstanding_debt'   => $request->hh_outstanding_debt,
            'house_demage'          => $request->house_demage,
            'hh_minority'           => $request->hh_minority,
            'reffered_tls'          => $request->reffered_tls,
            'hh_died_female'        => $request->hh_died_female,
            'hh_died_male'          => $request->hh_died_male,
            'hh_injured_female'     => $request->hh_injured_female,
            'hh_injured_male'       => $request->hh_injured_male,
            'hh_disabled_girls'     => $request->hh_disabled_girls,
            'hh_disabled_boys'      => $request->hh_disabled_boys,
            'hh_disabled_women'     => $request->hh_disabled_women,
            'hh_disabled_men'       => $request->hh_disabled_men,
            'large_animal_perished' => $request->large_animals,
            'small_animal_perished' => $request->small_animals,
            'hh_orphan_girls'       => $request->orphan_girls,
            'hh_orphan_boys'        => $request->orphan_boys,
            'land_destroyed'        => $request->land_destroyed,
            'hh_widow'              => $request->widows_count,
            'hh_pragnant'           => $request->pregnant_women,
            'hh_meal_inday'         => $request->meals_per_day,
            'cash_assistance'       => $request->cash_assistance,
            'assessment_officer'    => $request->assessment_officer,
            'program_representative'=> $request->program_representative,
            'observation_comments'  => $request->observation_comments,
            'form_no'               => $form_no,
            'attachment'            => $filename,
            'status'                => 'Waiting',
            'created_by'            => auth()->user()->id,
            'vc_representative_name' => $request->vc_representative,
        ]);

        return response()->json([
            "error" => false,
            'status' => 'success',
            'message' => 'Account successfully created!',
            'data' => $beneficiary
        ]);
    }

    private function validateRequest($request)
    {
        return $request->validate([
            'project'   => 'required|integer',
            'date'      => 'required|date',
            'province' => 'required|integer',
            'district' => 'required|integer',
            'tehsil' => 'required|integer',
            'uc' => 'required|integer',
            'village' => 'required|string|max:255',
            'subvillage' => 'nullable|string|max:255',
            'batch_number' => 'required',
            'name_of_beneficiary' => 'required|string|max:255',
            'guardian' => 'nullable|string|max:255',
            'gender' => 'required|string|in:Male,Female,Transgender',
            'age' => 'required|integer|min:0',
            'beneficiary_contact' => 'required|string|max:15',
            'relative_contact_number' => 'required|string|max:15',
            'hh_under5_girls' => 'required|integer|min:0',
            'hh_under5_boys' => 'required|integer|min:0',
            'hh_under5_7_girls' => 'required|integer|min:0',
            'hh_under5_7_boys' => 'required|integer|min:0',
            'hh_above18_girls' => 'required|integer|min:0',
            'hh_above18_boys' => 'required|integer|min:0',
            'cnic_beneficiary' => 'required|string|max:15',
            'cnic_spouse' => 'required|string|max:15',
            'cnic_issuance' => 'required|date',
            'cnic_expiry'   =>'required|date',
            'recieve_cash' => 'required|in:Yes,No',
            'recieve_cash_amount' => 'required|integer|min:0',
            'recieve_cash_source' => 'nullable|string|max:255',
            'hh_monthly_income' => 'required|integer|min:0',
            'hh_source_income' => 'required|string|max:255',
            'hh_person_earned' => 'required|integer|min:0',
            'hh_outstanding_debt' => 'required|integer|min:0',
            'house_demage' => 'required|string',
            'hh_minority' => 'required|in:yes,no',
            'reffered_tls' => 'required|in:yes,no',
            'hh_died_female' => 'required|integer|min:0',
            'hh_died_male' => 'required|integer|min:0',
            'hh_injured_female' => 'required|integer|min:0',
            'hh_injured_male' => 'required|integer|min:0',
            'hh_disabled_girls' => 'required|integer|min:0',
            'hh_disabled_boys' => 'required|integer|min:0',
            'hh_disabled_women' => 'required|integer|min:0',
            'hh_disabled_men' => 'required|integer|min:0',
            'large_animals' => 'required|integer|min:0',
            'small_animals' => 'required|integer|min:0',
            'orphan_girls' => 'required|integer|min:0',
            'orphan_boys' => 'required|integer|min:0',
            'land_destroyed' => 'required|integer|min:0',
            'widows_count' => 'required|integer|min:0',
            'pregnant_women' => 'required|integer|min:0',
            'meals_per_day' => 'required|integer|min:0',
            'cash_assistance' => 'required',
            'assessment_officer' => 'required|string|max:255',
            'program_representative' => 'required|string|max:255',
            'vc_representative' => 'required|string|max:255',
            'attachment' => 'required|file|max:10240'
        ]);
    }

    private function handleFileUpload($request)
    {
        if ($request->hasFile('attachment')) {
            $path = storage_path("app/public/benficiary_assessment/" . $request->attachment);
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('attachment');
            return time() . '.' . $file->getClientOriginalExtension();
        }
        return null;
    }

    private function generateFormNumber()
    {
        $beneficiary_last = BenficiaryAssessment::latest()->first();
        $next_id = $beneficiary_last ? $beneficiary_last->id + 1 : 1;
        return $next_id . "-" . time();
    }

    public function Show($id){
        $benficiaryAssessment = BenficiaryAssessment::Find($id);
        return view('admin.benificiaryAssessment.show', compact('benficiaryAssessment'));
    }

    public function edit($id){

    }

    public function destroy($id){
        
    }


    public function checkCnicBeneficary(Request $request)
    {
        $cnic = $request->input('cnic');
        // Check if CNIC already exists in the database
        $exists = BenficiaryAssessment::orWhere('cnic_beneficiary', $cnic)->orWhere('cnic_spouse', $cnic)->exists();
     
        return response()->json(['unique' => !$exists]);
    }

    public function checkCnicSpouse(Request $request)
    {
        $cnic = $request->input('cnic');
        // Check if CNIC already exists in the database
        $exists = BenficiaryAssessment::orWhere('cnic_beneficiary', $cnic)->orWhere('cnic_spouse', $cnic)->exists();
        // Return response indicating uniqueness
        return response()->json(['unique' => !$exists]);
    }

    public function checkContactNumber(Request $request)
    {
        $contact_number = $request->input('contact_number');
       
        $exists = BenficiaryAssessment::where('beneficiary_contact', 'LIKE', '%'.$contact_number.'%')->exists();
     
        return response()->json(['unique' => !$exists]);
    }

    public function actionSelectedBeneficiary(Request $request)
    {
        $request->validate([
            'action_type' => 'required|in:accepted,verified,approved,rejected',
            'beneficiaries' => 'required|array|min:1',
            'beneficiaries.*' => 'integer|exists:beneficiaries,id',
        ]);

        $actionType = $request->input('action_type');
        $beneficiaryIds = $request->input('beneficiaries');

        try {
            // Dispatch a job to process the action
            ProcessBeneficiaryAction::dispatch($actionType, $beneficiaryIds, auth()->user());

            return response()->json(['message' => 'Action is being processed in the background.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to process the action.'], 500);
        }
    }
}
