<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tehsil;
use App\Models\District;
use App\Models\UnionCounsil;

class FBAjaxController extends Controller
{
    //ajax districtdata
    public function getDistrict(Request $request) {
        $province_id = $request->province;
        $data = District::where('provinces_id',$province_id)->select('district_id', 'district_name')->where('status',1)->get();
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
}
