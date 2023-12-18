<?php
namespace App\Repositories;

use App\Repositories\Interfaces\DipActivityInterface;
use App\Models\DipActivity;
use File;

class DipActivityRepository implements DipActivityInterface
{
    public function storedipactivity($data)
    {
        return DipActivity::create([
            'activity_number'       => $data['activity_number'],
            'start_date'               => $data['start_date'],
            'end_date'               => $data['end_date'],
            'detail'               => $data['detail'],
            'status'               => $data['status'],
            'dip_id'               => $data['dip_id'],
            'created_by'            => auth()->user()->id,
        ]);
    }

    public function updatedipactivity($data, $id)
    {
        $log = LearningLog::where('id',$id)->first();
        return DipActivity::where('id',$id)->update([
            'activity_number'       => $data['activity_number'],
            'start_date'               => $data['start_date'],
            'end_date'               => $data['end_date'],
            'detail'               => $data['detail'],
            'status'               => $data['status'],
            'dip_id'               => $data['dip_id'],
            'created_by'            => auth()->user()->id,
        ]);
    }

}
