<?php
namespace App\Repositories\Interfaces;

Interface LearningLogRepositoryInterface{


    public function storelearninglog($data);
    public function updatelearninglog($data, $id);

}
