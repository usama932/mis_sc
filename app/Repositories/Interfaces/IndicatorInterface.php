<?php 
namespace App\Repositories\Interfaces;

interface IndicatorInterface
{
    public function createIndicator(array $data);
    public function createIndicatorActivity(array $data);
    
}
