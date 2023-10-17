<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonitorVisit;

class QBAjaxController extends Controller
{
    public function getactivity(Request $request) {
        $activity_id = $request->activity_id;

        $data = MonitorVisit::where('id',$activity_id)->first();
       
        return ($data);
    }
}
