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
      
        $qbs = QualityBench::latest();
      
        if($this->data['visit_staff_name'] != null){
            $frm->where('visit_staff_name',$this->data['visit_staff_name']);
        }
        if($this->data['date_visit'] != null){
            $frm->where('date_visit',$this->data['date_visit']);
        }
        if($this->data['accompanied_by'] != null){
            $frm->where('accompanied_by',$this->data['accompanied_by']);
        }
        if($this->data['type_of_visit'] != null){
            $frm->where('type_of_visit',$this->data['type_of_visit']);
        }
        if($this->data['province'] != null){
            $frm->where('province',$this->data['province']);
        }
        if($this->data['district'] != null){
            $frm->where('district',$this->data['district']);
        }
        if($this->data['project_type'] != null){
            $frm->where('project_type',$this->data['project_type']);
        }
        if($this->data['project_name'] != null){
            $frm->where('project_name',$this->data['project_name']);
        }
       
       
        $frm->with('user','user1','districts','districts',
                    'tehsils','uc','project')->latest();
        $frms =  $frm->with('responses')->get(); 
        
        return view('admin.quality_bench.qb_export.qb_report', [
            'qbs' => $qbs,
           

        ]);
    }
   
}
