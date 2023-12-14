<?php
namespace WebUI\View\Helper;

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

	function getProductGroups() {
		$ProductGroups = TableRegistry::get('ProductGroups');
        $productGroups = $ProductGroups->find()->where(['is_hidden'=>false]);
		return $productGroups;
    }
       
    function getTopProducts() {
        $session = $this->request->getSession();
        $Products = TableRegistry::get('Products');

        $region_id = 1;
        if($session->check("Region.Region.id")) {
            $region_id = $session->read("Region.Region.id");
        }
        $variantIds = $Products->ProductRegions->find('all',[
            'fields'=>['ProductRegions.product_variant_id'],
            'conditions'=>[
				'ProductRegions.region_id'=>$region_id
			],
		]);
        $variantIds = Hash::extract($variantIds->toArray(),"{n}.product_variant_id");

		$variants = $Products->ProductVariants->find('all',[
			'conditions'=>[
				'ProductVariants.id IN'=>$variantIds,
			]
		]);
		$variantsRate = Hash::combine($variants->toArray(), '{n}.id', '{n}.rate');		

        $productIds = $Products->ProductRegions->find('all',[
            'fields'=>['ProductRegions.product_id', 'ProductRegions.product_variant_id'],
            'conditions'=>[
				'ProductRegions.region_id'=>$region_id
			],
		]);
        $productIds = Hash::extract($productIds->toArray(),"{n}.product_id");
		$products=$Products->find('all',[
			'conditions'=>[
                'Products.id IN'=>$productIds,
				'Products.top_product' => 1,
				'Products.is_hidden'=>false
          	],
			'contain'=>[
				'ProductVariants'=>function(\Cake\ORM\Query $q) use ($variantIds){
					return $q->select()->where(
						['id IN'=>$variantIds]
					);
				},
				'ProductGroups'
			]
        ]);

		$region_id = 1;
		if($session->check("Region.Region.id")) {
			$region_id = $session->read("Region.Region.id");
		} 

		$deliveryZone = null;
		if($session->check("Region.DeliveryZone")) {
			$deliveryZone = $session->read("Region.DeliveryZone");
		} else {
			$DeliveryZones = TableRegistry::get('DeliveryZones');            
			$deliveryZone = $DeliveryZones->get(1);
		}
		$products->contain(['ProductVariants'=> function ($q) use($region_id, $deliveryZone) {
			return $q->formatResults(function (\Cake\Collection\CollectionInterface $v) use($region_id, $deliveryZone) {
				return $v->map(function ($variant) use($region_id, $deliveryZone) {
					if($variant->depot_id != $deliveryZone->depot_id) {
						$d = new \DateTime();
						$d->add(new \DateInterval('P'.$deliveryZone->delivery_days.'D'));
					} else {
						if(!empty($deliveryZone->delivery_week_day)) {
							$d = new \DateTime();
							$d->add(new \DateInterval('P1D'));
							$d->modify('next ' . $deliveryZone->delivery_week_day);
						} else {
							$d = new \DateTime();
							$d->add(new \DateInterval('P'.$deliveryZone->delivery_days.'D'));
						}
					}
					$date = $d->format('D, M d');

					$variant['delivery'] = $date;
					return $variant;
				});
			});
		}]);        

        $deliveryDates =  [];
		$stockStatus = [];
		foreach($products as $product) {
			foreach($product->product_variants as $variant) { 
				$deliveryDates[$variant->id] = $variant->delivery;
				$stockStatus[$variant->id] = "In Stock";
				if(!$variant->skip_inventory && $variant->closing_qty <= $variant->minimum_level) {
					$stockStatus[$variant->id] = "Not In Stock";
				}
			}
		}

        return [
            'products'=>$products,
            'variantsRate'=>$variantsRate,
            'deliveryDates'=>$deliveryDates,
            'stockStatus'=>$stockStatus,
         ] ;
    }

    /*
    function getTopVariantsRate() {
        $session = $this->request->getSession();
        $region_id = 1;
        if($session->check("Region.Region.id")) {
            $region_id = $session->read("Region.Region.id");
        }

        $Products = TableRegistry::get('Products');
        $variantIds = $Products->ProductRegions->find('all',[
            'fields'=>['ProductRegions.product_variant_id'],
            'conditions'=>[
				'ProductRegions.region_id'=>$region_id
			],
		]);
		$variantIds = Hash::extract($variantIds->toArray(),"{n}.product_variant_id");

		$variants = $Products->ProductVariants->find('all',[
			'conditions'=>[
				'ProductVariants.id IN'=>$variantIds,
			]
		]);
        $variantsRate = Hash::combine($variants->toArray(), '{n}.id', '{n}.rate');
        return $variantsRate;
    } 
    */  
}
