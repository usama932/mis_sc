<?php
namespace App\Repositories;

use App\Repositories\Interfaces\DipRepositoryInterface;
use App\Models\Dip;
use File;

class DipRepository implements DipRepositoryInterface
{
    public function storedip($data)
    {
        return Dip::create([
            'project'               => $data['project'],
            'created_by'            => auth()->user()->id,
        ]);
    }

    public function updatedip($data, $id)
    {
      
    }
   

}
