<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonitorVisit;
use App\Models\Project;
use App\Models\Partner;


class QBAjaxController extends Controller
{
    public function getactivity(Request $request) {
        $activity_id = $request->activity_id;

        $data = MonitorVisit::where('id',$activity_id)->first();
       
        return ($data);
    }
    public function getproject_type(Request $request){

        $project_id = $request->project_name;
        $data = Project::where('id',$project_id)->first();
        return $data ;
    }
}
