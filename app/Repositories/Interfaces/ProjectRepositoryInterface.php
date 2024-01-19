<?php
namespace App\Repositories\Interfaces;

Interface ProjectRepositoryInterface{


    public function storeproject($data);
    public function updateproject($data);
    public function updatebasicproject($data,$id);

}
