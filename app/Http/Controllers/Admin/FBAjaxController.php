<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tehsil;
use App\Models\District;
use App\Models\Project;
use App\Models\UnionCounsil;
use App\Models\SciSubTheme; 

class FBAjaxController extends Controller
{
    //ajax districtdata
    public function getDistrict(Request $request) {
        $province_id = $request->province;
        if(auth()->user()->permissions_level == 'district-wide'){
           
            $data = District::where('provinces_id',$province_id)->where('district_id',auth()->user()->district)->select('district_id', 'district_name')->where('status',1)->get();
        }
        else{
         
            $data = District::where('provinces_id',$province_id)->select('district_id', 'district_name')->where('status',1)->get();
        }
        
        return ($data);
    }
    public function getlearningDistrict(Request $request) {
        $province_id = $request->province;
        
        if(auth()->user()->permissions_level == 'district-wide'){
           
            $data = District::whereIn('provinces_id',$province_id)->where('district_id',auth()->user())->get();
        }
        else{
         
            $data = District::whereIn('provinces_id',$province_id)->select('district_id', 'district_name')->get();
        }
        
        return ($data);
    }
    public function getprojectDistrict(Request $request) {
        $province_id = $request->province;
           
        $project   = Project::where('id', $request->project)->with('detail')->first();
        
        if(!empty($project->detail?->district)){
            $data   = District::where('provinces_id',$province_id)->whereIn('district_id', json_decode($project->detail->district))->select('district_id', 'district_name')->get();
           
        }
        else{
            $data   = [];
        }
       
        
        return ($data);
    }
    public function getuserDistrict(Request $request) {
        $province_id = $request->province;
        $data = District::where('provinces_id',$province_id)->select('district_id', 'district_name')->get();
        return ($data);
    }
    // ajax tehsil data
    public function getTehsil(Request $request) {

        $district_id = $request->district_id;

        $data = Tehsil::where('district_id',$district_id)->select('id', 'tehsil_name')->get();


        return ($data);
    }

    // ajax unioncouncil data
    public function getUnionCouncil(Request $request) {
        $tehsil_id = $request->tehsil_id;

        $data = UnionCounsil::where('tehsil_id', $tehsil_id)->select('union_id','uc_name')->get();

        return ($data);
    }
    public function update_province(Request $request){
        $id = auth()->user()->id;
        $user = User::find( $id);
        $user->province = $request->province;
        $user->save();
        return response()->json(['message' => 'Province updated successfully']);
    }
    public function getproject(Request $request){
        $projectId = $request->input('projectId');
        // Fetch project details based on $projectId
    
        // Example: Fetch project details from the database
        $project = Project::find($projectId);
    
        // Return the project details as JSON
        return response()->json($project);
    }

    public function getSubTheme(Request $request){
    
        $themeId = $request->input('theme_id');

        $themes = SciSubTheme::where('sci_theme_id',$themeId)->get();
       
        return response()->json($themes);
    }
}
