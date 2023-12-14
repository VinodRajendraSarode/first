<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;


class Listing extends Entity
{ 
    protected $_accessible = [
        '*' => true,       
    ];

    protected $_virtual = ['avg_rating', 'count'];  

    protected function _getAvgRating(){
       $Comments = TableRegistry::get('Comments');
       $query = $Comments->find()
            ->select(['avg_rating'=>'AVG(rating)'])
            ->where([
                'listing_id' => $this->id
            ])->first();
            // debug($query); exit;
        return (!empty($query->avg_rating)) ? round($query->avg_rating) : 0;
    }

    protected function _getCount(){
        $Comments = TableRegistry::get('Comments');
        $query = $Comments->find()             
             ->where([
                'listing_id' => $this->id
             ]);
             // debug($query); exit;
         return $query->count();
     }
}
