<?php

namespace App\Exports\QB;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\QualityBench;


class ActionPoint implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        
        $qb = QualityBench::latest();
        $dateParts = explode('to', $this->data['date_visit']);
        $startdate = '';
        $enddate = '';
        if(!empty($dateParts)){
            $startdate = $dateParts[0];
            $enddate = $dateParts[1] ?? '';
        }
        if($this->data['date_visit'] != null){
            $qb->whereBetween('date_visit',[$startdate ,$enddate]);
        }

        $qb->with('action_point','user','user1','districts','districts',
                    'tehsils','uc','project')->latest();
        $qbs =  $qb->get(); 

       
        return view('admin.quality_bench.qb_export.qb_actionpoint_report', [
            'qbs' => $qbs,

        ]);
    }
   
}