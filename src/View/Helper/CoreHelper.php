<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Utility\Hash;
use Cake\ORM\TableRegistry;

/**
 * Core helper
 */
class CoreHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

	function getListingCategories() {
        $ListingCategories = TableRegistry::get('ListingCategories');
        $listingCategories = $ListingCategories->find()->where()->order(['listing_category'=>'ASC']);
		return $listingCategories;
    }
}
