<?php
namespace WebUI\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Cake\ORM\TableRegistry;

class CategoryHelper extends Helper
{

	public function getCategory() {

		$Category = TableRegistry::get('Categories');
		$categories = $Category->find('list');

		return $categories;
	}

	public function getFCategory($limit = 5) {

		$Category = TableRegistry::get('Categories');
		$categories = $Category->find('all')->order(array('Categories.list_order'=>'ASC'))->limit($limit);

		return $categories;
	}

	public function getRandCategory($limit = 8) {

		$Category = TableRegistry::get('Categories');
		$categories = $Category->find('all',['conditions'=>['Categories.popular'=>true]])->order(['Categories.list_order'=>'ASC'])->limit($limit);

		return $categories;
	}

	public function getHomepageCategory($limit = 5) {
		$Category = TableRegistry::get('Categories');
		$categories = $Category->find('all',['conditions'=>['Categories.display_on_homepage'=>true]])->order(['Categories.list_order'=>'ASC'])->limit($limit);

		return $categories;
	}


}

