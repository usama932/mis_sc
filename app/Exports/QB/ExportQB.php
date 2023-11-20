<?php

namespace App\Exports\QB;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\QualityBench;

class ExportQB implements FromView
{
   
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view():View
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
        if($this->data['accompanied_by'] != null){
            $qb->where('accompanied_by',$this->data['accompanied_by']);
        }
        if($this->data['type_of_visit'] != null){
            $qb->where('type_of_visit',$this->data['type_of_visit']);
        }
        if($this->data['province'] != null){
            $qb->where('province',$this->data['province']);
        }
        if($this->data['district'] != null){
            $qb->where('district',$this->data['district']);
        }
        if($this->data['project_type'] != null){
            $qb->where('project_type',$this->data['project_type']);
        }
        if($this->data['project_name'] != null){
            $qb->where('project_name',$this->data['project_name']);
        }
        
        $qb->with('user','user1','districts','districts',
                    'tehsils','uc','project')->latest();
        $qbs =  $qb->get(); 
       
        return view('admin.quality_bench.qb_export.qb_report', [
            'qbs' => $qbs,
        ]);
    }
}
