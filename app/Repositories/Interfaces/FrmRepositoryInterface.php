<?php
namespace App\Repositories\Interfaces;

Interface FrmRepositoryInterface{


    public function storeFrm($data);
    public function updateFrm($data, $id);
    public function destroyFrm($id);
}
