<?php 
namespace WebUI\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Cake\ORM\TableRegistry;

class ListingHelper extends Helper
{
	
	public function getListing($limit = 12) {
		$Listing = TableRegistry::get('Listings');
		if(!empty($data['listing'])){
			$listings = $Listing->find('all',['conditions'=>['Listings.active'=>true,'Listings.popular'=>true]])->contain(['Categories'])->order(['RAND()'])->limit($limit);
		}else{
			$listings = $Listing->find('all',['conditions'=>['Listings.active'=>true,'Listings.popular'=>true]])->contain(['Categories'])->order(['RAND()'])->limit($limit);
		}
		return $listings;
	}	

	public function getListings() {
		$Listing = TableRegistry::get('Listings');
		$listings = $Listing->find('list');
	
		return $listings;
	}	
}
                                                                        
