<?php
namespace App\Repositories\Interfaces;

Interface ProjectRepositoryInterface{


    public function storeproject($data);
    public function updateproject($data, $id);

}
