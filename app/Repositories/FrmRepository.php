<?php
namespace App\Repositories;

use App\Repositories\Interfaces\FrmRepositoryInterface;
use App\Models\Frm;

class FrmRepository implements FrmRepositoryInterface
{
    public function storeFrm($data)
    {
        if($data['feedback_referredorshared'] == 'Yes'){
            $status ="Open";
            $actiontaken ="";
        }
        else{
            if($data['status'] == 'Close'){
                $actiontaken =$data['actiontaken'];
            }else{
                $actiontaken ="";
            }
            $status = $data['status'];
        }
        return Frm::create([
            'name_of_registrar'     => $data['name_of_registrar'],
            'date_received'         => $data['date_received'],
            'response_id'           => $data['response_id'],
            'feedback_channel'      => $data['feedback_channel'],
            'name_of_client'        => $data['name_of_client'],
            'type_of_client'        => $data['type_of_client'],
            'gender'                => $data['gender'],
            'age'                   => $data['age'],
            'province'              => $data['province'],
            'district'              => $data['district'],
            'tehsil'                => $data['tehsil'],
            'union_counsil'         => $data['union_counsil'],
            'village'               => $data['village'],
            'pwd_clwd'              => $data['pwd_clwd'],
            'allow_contact'         => $data['allow_contact'],
            'client_contact'        => $data['contact_number'],
            'feedback_description'  => $data['feedback_description'] ,
            'feedback_category'     => $data['feedback_category'],
            'datix_number'          => $data['datix_number'],
            'theme'                 => $data['theme'],
            'feedback_activity'     => $data['feedback_activity'],
            'project_name'          => $data['project_name'] ?? '',
            'date_ofreferral'       => $data['date_feedback_referred'],
            'referral_name'         => $data['refferal_name'],
            'referral_position'     => $data['refferal_position'],
            'feedback_summary'      => $data['feedback_summary'],
            'status'                => $status,
            'type_ofaction_taken'   => $actiontaken,
            'created_by'            => auth()->user()->id,
            'feedback_referredorshared' => $data['feedback_referredorshared'],


        ]);
    }

    public function findFrm($id)
    {
        return Frm::find($id);
    }

    public function updateFrm($data, $id)
    {
        if($data['feedback_referredorshared'] == 'Yes'){
            $status ="Open";
            $actiontaken ="";
        }
        else{
            $status = $data['status'];
            if($data['status'] == 'Close'){
                $actiontaken =$data['actiontaken'];
            }else{
                $actiontaken ="";
            }
        }
        $frm =Frm::where('id',$id)->find($id);
        if($data['feedback_referredorshared'] != null){
            $date = $data['date_feedback_referred'];
        }
        else{
            $date = $frm->date_ofreferral;
        }
        return Frm::where('id',$id)->update([
            'name_of_client'        => $data['name_of_client'],
            'feedback_channel'      => $data['feedback_channel'],
            'gender'                => $data['gender'],
            'age'                   => $data['age'],
            'province'              => $data['province'],
            'district'              => $data['district'],
            'tehsil'                => $data['tehsil'],
            'union_counsil'         => $data['union_counsil'],
            'village'               => $data['village'] ?? $frm->village,
            'client_contact'        => $data['contact_number'],
            'feedback_description'  => $data['feedback_description'] ,
            'theme'                 => $data['theme'],
            'feedback_activity'     => $data['feedback_activity'],
            'project_name'          => $data['project_name'] ?? $frm->project_name,
            'date_ofreferral'       => $date,
            'referral_name'         => $data['refferal_name'],
            'referral_position'     => $data['refferal_position'],
            'feedback_summary'      => $data['feedback_summary'],
            'status'                => $status,
            'type_ofaction_taken'   => $actiontaken,
            'feedback_referredorshared' => $data['feedback_referredorshared'],
            'updated_by'            => auth()->user()->id,
        ]);
    }

    public function destroyFrm($id)
    {
        $Frm = Frm::find($id);
        $Frm->delete();
    }
}
