<?php 
namespace WebUI\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Cake\ORM\TableRegistry;

class CityHelper extends Helper
{
    public function getCities(){
        $Cities = TableRegistry::get('Cities');
        $cities = $Cities->find('list');      
        return $cities;
    }
}