<?php
namespace App\Repositories\Interfaces;

Interface QbRepositoryInterface{
    
    public function storeQb($data);
    public function destroyQb($id);
}
