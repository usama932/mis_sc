<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Frm;

class FrmExport implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
      
        $frm = Frm::latest();
         
        if($this->data['name_of_registrar'] != null){
            $frm->where('name_of_registrar',$this->data['name_of_registrar']);
        }
        if($this->data['date_received'] != null){
            $frm->where('date_received',$this->data['date_received']);
        }
        if($this->data['feedback_channel'] != null){
            $frm->where('feedback_channel',$this->data['feedback_channel']);
        }
        if($this->data['age'] != null){
            $frm->where('age',$this->data['age']);
        }
        if($this->data['province'] != null){
            $frm->where('province',$this->data['province']);
        }
        if($this->data['district'] != null){
            $frm->where('district',$this->data['district']);
        }
        if($this->data['type_of_client'] != null){
            $frm->where('type_of_client',$this->data['type_of_client']);
        }
        if($this->data['project_name'] != null){
            $frm->where('project_name',$this->data['project_name']);
        }
       
        $frm->with('user','user1','districts','districts',
                    'tehsils','uc','category','theme_name','channel','project')->latest();
        $frms =  $frm->get(); 
       
        return view('admin.frm.frm_report', [
            'frms' => $frms
        ]);
    }

}