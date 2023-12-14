<?php 
namespace WebUI\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Cake\ORM\TableRegistry;

class SectionHelper extends Helper
{
	
	public function getSection($section) {
		
		$Section = TableRegistry::get('Sections');
		$section = $Section->findBySection($section)->first()->contents;
		return $section;
	}
}
                                                                        
