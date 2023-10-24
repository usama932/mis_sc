<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Frm;
use App\Models\FrmResponse;

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
         
        if($this->data['name_of_registrar'] != null && $$this->data['feedback_channel']  != 'None'){
            $frm->where('name_of_registrar',$this->data['name_of_registrar']);
        }
        
      
        if($this->data['date_received'] != null){
            $dateParts = explode('to', $this->data['date_received']);
            $startdate = '';
            $enddate = '';
            if(!empty($dateParts)){
                $startdate = $dateParts[0];
                $enddate = $dateParts[1] ?? '';
            }
            $frm->whereBetween('date_received',[$startdate ,$enddate]);
        }
        if($this->data['feedback_channel'] != null  && $this->data['feedback_channel'] != 'None'){
            $frm->where('feedback_channel',$this->data['feedback_channel']);
        }
        if($this->data['age'] != null  && $this->data['age']  != 'None'){
            $frm->where('age',$this->data['age']);
        }
        if(auth()->user()->user_type == "admin" || auth()->user()->permissions_level == 'nation-wide'){
            if($this->data['province'] != null  && $this->data['province']  != 'None'){
                $frm->where('province',$this->data['province']);
            }
            if($this->data['district'] != null  && $this->data['district']  != 'None'){
                $frm->where('district',$this->data['district']);
            }
        }
        if(auth()->user()->user_type != "admin" && auth()->user()->permissions_level == 'province-wide'){
           
            $frm->where('province',auth()->user()->province);
          
            if($this->data['district'] != null  && $this->data['district']  != 'None'){
                $frm->where('district',$this->data['district']);
            }
        }
        if(auth()->user()->user_type != "admin" && auth()->user()->permissions_level == 'district-wide'){
         
           
                $frm->where('district',auth()->user()->district);
            
        }
       
        if($this->data['type_of_client'] != null  && $this->data['type_of_client']  != 'None'){
            $frm->where('type_of_client',$this->data['type_of_client']);
        }
        if($this->data['project_name'] != null  && $this->data['project_name']  != 'None'){
            $frm->where('project_name',$this->data['project_name']);
        }
        if($this->data['status'] != null  && $this->data['status']  != 'None'){
            $frm->where('status',$this->data['status']);
        }
       
        $frm->with('user','user1','districts','districts',
                    'tehsils','uc','category','theme_name','channel','project')->latest();
        $frms =  $frm->with('responses')->get(); 
        
        return view('admin.frm.frm_export.frm_report', [
            'frms' => $frms,
        ]);
    }
   

}
