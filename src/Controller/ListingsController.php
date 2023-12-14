<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Core\Configure;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Utility\Hash;

class ListingsController extends AppController
{
	public function initialize() {
		parent::initialize();
		 $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
		$this->Auth->allow(['search','index','myListings','detail','contactMail','addFavourite', 'getsubCategories']);
	}


	public function search($category = null){

		$this->viewBuilder()->setLayout('listing');
		$conditions = [];

		if($this->request->is(['patch','post','put'])) {

		$data = $this->request->data['listing'];
		$word = explode(" ",$this->request->data['listing']);
		$city = $this->request->data['cities'];
		$categories = $this->request->data['category'];
		$this->set(compact('data', 'city'));
		foreach($word as $text){
			if(!empty($text)){
				$conditions['OR'] = [
					'Listings.listing_title LIKE'=> "%".$text."%",
					'Listings.description LIKE'=> "%".$text."%",
					'Categories.category LIKE'=> "%".$text."%",
					'SubCategories.sub_category LIKE'=> "%".$text."%",
					'Cities.city LIKE'=> "%".$text."%"
				];
			}

		}


		if(!empty($city)){
			$conditions['city_id'] = $city;
		}
		if(!empty($categories)){
			$conditions['Listings.category_id'] = $categories;
		}
		$listings = $this->Listings->find('all',['conditions'=>[$conditions]])
				->contain(['Categories','Cities','Countries','Users', 'SubCategories']);

		} else {
			if(!empty($category)){
				$conditions['Categories.slug'] = $category;
			}
		$listings = $this->Listings->find('all',['conditions'=>[$conditions]])
			->contain(['Categories','Cities','Countries','Users', 'SubCategories']);


		}

		 $this->paginate =['limit'=>'10'];
		 $this->set('listings', $this->paginate($listings));
		 $this->set(compact('listings'));
		 $this->render('index');
	}

	public function index($favourites = null) {
		$title = '';
		$conditions = [];
		if($this->request->is(['patch','post','put'])) {
			$data = $this->request->getData();
			// debug($data); exit;
			if(!empty($data['category_id'])){
				$conditions['Listings.category_id'] = $data['category_id'];
				$category_id = $data['category_id'];
				$this->set(compact('category_id'));
				// debug($conditions);
			}
			if(!empty($data['sub_category_id'])){
				$conditions['Listings.sub_category_id'] = $data['sub_category_id'];
				$sub_category_id = $data['sub_category_id'];
				$this->set(compact('sub_category_id'));
			}


			if(!empty($data['cities'])) {
				$conditions['Listings.city_id'] = $data['cities'];
			}

		} else {
			// debug($favourites); exit;
			if(!empty($favourites)) {
				$favourateListings = $this->Listings->Favourites->find('list', ['keyField'=>'listing_id','valueField'=>'listing_id'])->where(['Favourites.user_id'=>$this->Auth->user('id')]);
				$conditions['Listings.id IN'] = $favourateListings;
			}
		}
		$conditions['Listings.active'] = true;
		// debug($conditions); exit;
		$this->viewBuilder()->setLayout('listing');


		$favourateListings = $this->Listings->Favourites->find('list', ['keyField'=>'listing_id','valueField'=>'listing_id'])->where(['Favourites.user_id'=>$this->Auth->user('id')]);
		$favourateListings = implode(",", $favourateListings->toArray());

		if(!empty($favourateListings)){
			$listings = $this->Listings->find('all',[
			'fields' => ['Listings.id', 'Listings.listing_title', 'Listings.slug',  'Listings.address',  'Listings.description',  'Listings.hourly_rate',  'Listings.daily_rate',  'Cities.city',  'Categories.slug',  'Listings.banner',  'Listings.banner_dir',
							'list_order' => 'IF(Listings.id IN ('.$favourateListings.'), 0, 1)'],
			'conditions'=>$conditions
			])
			->contain(['Categories', 'SubCategories','Cities','Countries','Users', 'Favourites'])
			->order(['premium' => 'DESC', 'list_order' => 'ASC']);

		} else {
			$listings = $this->Listings->find('all',['conditions'=>[$conditions]])->contain(['Categories','Cities','Countries','Users',  'Favourites'])->order(['premium' => 'DESC']);

		}


		$this->set('title_for_layout', $title);
		$this->set('title', $title);
		$this->paginate =['limit'=>20, 'order'=>['Favourites.listing_id'=>'DESC']];
		$this->set('listings', $this->paginate($listings));
		$this->set(compact('listings'));
		$this->set('_serialize',['listings']);
	}

	public function myListings(){

		$this->viewBuilder()->setLayout('detail');

		$listings = $this->Listings->find('all')
				->where(['Listings.user_id' =>$this->Auth->user('id')])
				->contain(['Categories','Cities','Countries','Users']);

		$Users = TableRegistry::get('Users');
		$member = $Users->get($this->Auth->user('id'),['contain' => ['Subscriptions'=>['Packages']]]);



		$Listingcount = $this->Listings->find('all')
				->where(['Listings.user_id' =>$this->Auth->user('id')])
				->count();

		if(empty($Listingcount)){
			return $this->redirect(['action'=>'index']);
		}

		$Packages = TableRegistry::get('Packages');
		$packages = $Packages->find('all')
			->find('search', ['search' => $this->request->getQueryParams()]);


		$title = $member->name;
		$this->set('title_for_layout', $title);
		$this->set('title', $title);

		$this->paginate =['limit'=>'10'];
		$this->set('listings', $this->paginate($listings));
		$this->set(compact('listings','member','Listingcount', 'packages'));
		$this->set('_serialize',['listings']);
	}

	public function add(){

		$this->viewBuilder()->setLayout('detail');

		$this->set('title_for_layout', 'Add Listing');
		$this->Flash->success('It could take upto 24 hours for listing to be live ');

		if(empty($id)) {
			$listings=$this->Listings->newEntity();
			$this->set('title','Add Listings');
		}

		if($this->request->is(['patch','post','put'])) {
			$data = $this->request->getData();

			$business = [
				$data['day_1'] =>
					($data['closed_1'] == "No") ? [
						$data['from_1'],
						$data['to_1'] ]
						: "Closed",

				$data['day_2'] =>
					($data['closed_2'] == "No") ? [
						$data['from_2'],
						$data['to_2'] ]
						: "Closed",

				$data['day_3'] =>
					($data['closed_3'] == "No") ? [
						$data['from_3'],
						$data['to_3'] ]
						: "Closed",

				$data['day_4'] =>
					($data['closed_4'] == "No") ? [
						$data['from_4'],
						$data['to_4'] ]
						: "Closed",

				$data['day_5'] =>
					($data['closed_5'] == "No") ? [
						$data['from_5'],
						$data['to_5'] ]
						: "Closed",

				$data['day_6'] =>
					($data['closed_6'] == "No") ? [
						$data['from_6'],
						$data['to_6'] ]
						: "Closed",

				$data['day_7'] =>
					($data['closed_7'] == "No") ? [
						$data['from_7'],
						$data['to_7'] ]
						: "Closed"
			];

			$data['business_hours'] = json_encode($business);


			$searchWidth = "/(width=\")(.*?)(\")/";
			$searchHeight = "/(height=\")(.*?)(\")/";
			$replaceWidth = 'width="100%"';
			$replaceHeight = 'height="400"';

			$location = preg_replace($searchWidth, $replaceWidth, $data['google_location']);
			$location = preg_replace($searchHeight, $replaceHeight, $location);

			$data['google_location'] = $location;
			$data['active'] = false;


			$data['user_id'] = $this->Auth->user('id');
			$listings=$this->Listings->patchEntity($listings, $data);

			if($this->Listings->save($listings)) {

				$this->Flash->success('Listing Saved Successfully ');
				return $this->redirect(['action'=>'index']);
			}else {
				$this->Flash->error('The Listings could not be saved try again');
			}
		}

		$Users = TableRegistry::get('Users');
		$users = $Users->find('list');

		$Categories = TableRegistry::get('Categories');
		$categories = $Categories->find('list');

		$SubCategories = TableRegistry::get('SubCategories');
		$subCategories = $SubCategories->find('list');

		$Countries = TableRegistry::get('Countries');
		$countries = $Countries->find('list');

		$States = TableRegistry::get('States');
		$states = $States->find('list');

		$Cities = TableRegistry::get('Cities');
		$cities = $Cities->find('list');

		$currency = Configure::read("currency");

		$this->set(compact('listings','categories','subCategories','countries','cities','users','currency','states'));
	}

	public function edit($id=null){

		$this->viewBuilder()->setLayout('detail');
		$this->set('title_for_layout', 'Listing');
		$this->Flash->success('It could take upto 24 hours for listing to be live ');

		$listings=$this->Listings->get($id,['contain'=>['Categories','SubCategories','Cities','States','Countries']]);
		$this->set('title','Edit Listings');

		if($this->request->is(['patch','post','put'])) {
			$data = $this->request->getData();
			$business = [
				$data['day_1'] =>
					($data['closed_1'] == "No") ? [
						$data['from_1'],
						$data['to_1'] ]
						: "Closed",

				$data['day_2'] =>
					($data['closed_2'] == "No") ? [
						$data['from_2'],
						$data['to_2'] ]
						: "Closed",

				$data['day_3'] =>
					($data['closed_3'] == "No") ? [
						$data['from_3'],
						$data['to_3'] ]
						: "Closed",

				$data['day_4'] =>
					($data['closed_4'] == "No") ? [
						$data['from_4'],
						$data['to_4'] ]
						: "Closed",

				$data['day_5'] =>
					($data['closed_5'] == "No") ? [
						$data['from_5'],
						$data['to_5'] ]
						: "Closed",

				$data['day_6'] =>
					($data['closed_6'] == "No") ? [
						$data['from_6'],
						$data['to_6'] ]
						: "Closed",

				$data['day_7'] =>
					($data['closed_7'] == "No") ? [
						$data['from_7'],
						$data['to_7'] ]
						: "Closed"
			];

			$data['business_hours'] = json_encode($business);

			$searchWidth = "/(width=\")(.*?)(\")/";
			$searchHeight = "/(height=\")(.*?)(\")/";
			$replaceWidth = 'width="100%"';
			$replaceHeight = 'height="400"';

			$location = preg_replace($searchWidth, $replaceWidth, $data['google_location']);
			$location = preg_replace($searchHeight, $replaceHeight, $location);

			$data['google_location'] = $location;
			$data['active'] = false;



			$listings=$this->Listings->patchEntity($listings, $data);

			// debug($listings); exit;

			if($this->Listings->save($listings)) {
				$this->Flash->success('Listing Saved Successfully');
				return $this->redirect(['action'=>'my_listings']);
			}else {
				$this->Flash->error('Please submit required fields');
			}
		}

		$Users = TableRegistry::get('Users');
		$users = $Users->find('list');

		$Categories = TableRegistry::get('Categories');
		$categories = $Categories->find('list');

		$SubCategories = TableRegistry::get('SubCategories');
		$subCategories = $SubCategories->find('list');

		$Countries = TableRegistry::get('Countries');
		$countries = $Countries->find('list');

		$Cities = TableRegistry::get('Cities');
		$cities = $Cities->find('list');

		$this->set(compact('listings','users','categories','subCategories','countries','cities'));
	}

	public function delete($id=null) {

		$listings=$this->Listings->get($id);

		if($this->Listings->delete($listings)) {
			$this->Flash->success('The Listings has been deleted');
		}
		else {
			$this->Flash->error('The Listings could not be deleted try again');
		}
		return $this->redirect(['action'=>'index']);
	}

	public function detail($ListingId=null) {

		$this->viewBuilder()->setLayout('detail');

		$commentCount = $this->Listings->Comments->find('all')->where(['Comments.listing_id'=>$ListingId]);

		$commentCount = $commentCount->select([
			'rating' => 'rating',
			'count' => $commentCount->func()->count('rating')
		])->group('rating');

		$commentCount = $commentCount->toArray();

		$combine = Hash::combine($commentCount, '{n}.rating', '{n}.count');





		if($this->request->is(['patch', 'put', 'post'])) {
			$comments = $this->Listings->Comments->newEntity();
			$comment = $this->Listings->Comments->patchEntity($comments, $this->request->getData());
			$comment->listing_id = $ListingId;
			$comment->user_id = $this->Auth->user('id');
			$this->Listings->Comments->save($comment);
			return $this->redirect(['action'=>'detail', $ListingId]);

		}



		$listing = $this->Listings->find('all')
				->where(['Listings.id' =>$ListingId])
				->contain(['Categories', 'SubCategories', 'Cities','Countries','Users', 'Comments'=>['Users']])
				->first();

		$favourate = $this->Listings->Favourites->find('all')
					->where([
						'listing_id' =>$ListingId,
						'user_id' => $this->Auth->user('id')])
					->first();



		$title = $listing->listing_title;
		$this->set('title_for_layout', $title);
		$description = $listing->description;

		$this->set('title', $title);
		$this->set('description', $description);

		$comment = $this->Listings->Comments->newEntity();
		$this->set(compact('listing', 'comment', 'favourate', 'combine'));
	}

	public function contactMail($listingId = null){

        $Listing = TableRegistry::get('Listings');
      	$listing = $Listing->find('all')
					->where(['Listings.id' =>$this->request->data['listing_id']])
					->contain(['users'])
					->first();
		$data = $this->request->data();

		if (!empty($listing)) {
            $email = new Email();
            $email
                ->template('Contact', 'default')
                ->subject('Request For Contact Detail')
                ->emailFormat('html')
                //->to($listing->email)
				->to('gavalikamlesh@gmail.com','sanjeev@sanmisha.com')
			    ->viewVars(compact('listing','data'))
                ->send();

                $this->Flash->success('Thank you for filling out your information!.');
                return $this->redirect(['controller'=>'Listings','action' => 'index']);

        } else {
            $this->Flash->error('Sorry! Unable to find your email.');
        }
	}

	public function addFavourite($listingId){

		$Favourites = TableRegistry::get('Favourites');
		$user = $this->Auth->user('id');
		$favList = $Favourites->find('all',['conditions'=>['Favourites.listing_id'=>$listingId, 'Favourites.user_id'=>$user]])->first();

		if(empty($favList)){
			if($this->request->is(['patch','post','put'])) {
				$this->request->data['user_id'] = $this->Auth->user('id');
				$this->request->data['listing_id'] = $listingId;
				$Favourites = TableRegistry::get('Favourites');
				$favourate = $Favourites->newEntity();
				$favourites =$Favourites->patchEntity($favourate,$this->request->getData());
				if($Favourites->save($favourites)) {
					$success = "Your Favourite has been Added";
				} else {
					$success = "Your Favourite could not be Added try again";
				}
			}
		}else{
			if($Favourites->delete($favList)) {
				$success = "Your Favourite has been Removed";
			} else {
				$success = "Your Favourite could not be Removed try again";
			}
		}

		$this->set('success', $success);
		$this->set('_serialize', ['success']);
   	}
	public function renew($id = null){

		$this->viewBuilder()->setLayout('listing');
		$this->set('title_for_layout', 'Renew Package');

		$Subscriptions = TableRegistry::get('subscriptions');
		$subscriptions = $Subscriptions->find('all')
		->where([ 'subscriptions.package_id'=>$id, 'subscriptions.user_id'=>$this->Auth->user('id'), 'subscriptions.active'=>true])->contain('Packages')->first();

		$subscription = $Subscriptions->newEntity();
		if($this->request->is(['post', 'patch', 'put'])){
			$data = $this->request->getdata();
			$packages = $Subscriptions->Packages->get($data['package_id']);

			$subscription['user_id'] = $subscriptions->user_id;
			$subscription['package_id'] = $data['package_id'];
			$subscription['no_of_listings'] = $packages->no_of_listings;
			$subscription['registration_date'] = Date::createFromFormat('d/m/Y', $subscriptions->expiry_date)->addDay('1')->format('d/m/Y');
			$subscription['expiry_date'] = Date::createFromFormat('d/m/Y', $subscription->registration_date)->addMonth($subscriptions->package->period)->format('d/m/Y');
			$subscription['active'] = false;
			// debug($subscription); exit;
			if($Subscriptions->save($subscription)){
				$this->Flash->success(' The Package is Renewed');
				return $this->redirect(['controller'=>'Listings','action' => 'myListings']);
			} else {
				$this->Flash->error('The Package could not be updated');
			}

		}


		$packages = $Subscriptions->Packages->find('list');
		$this->set(compact('subscription', 'packages'));

	}
	public function message($id = null){
		$listing = $this->Listings->get($id);
		if($this->request->is(['patch', 'put', 'post'])) {
			$Messages = TableRegistry::get('messages');
			$message = $Messages->newEntity();
			$message = $Messages->patchEntity($message, $this->request->getData());
			$message->sender_id = $this->Auth->user('id');
			$message->receiver_id = $listing->user_id;
			$message->from_date = Date::createFromFormat('d/m/Y', $message->from_date)->format('m/d/Y');
			$message->to_date = Date::createFromFormat('d/m/Y', $message->to_date)->format('m/d/Y');


			if($Messages->save($message)){

				$Users = TableRegistry::get('users');
				$sender = $Users->get($this->Auth->user('id'));
				$receiver = $listing->email;
				$email = new Email('default');
				$email->template('Message', 'default')
					->emailFormat('html')
					->to($receiver)
					->subject('New Message')
					->viewVars(compact('receiver','sender', 'message'))
					->send($message);
				$this->Flash->success("Message sent");
				return $this->redirect(['controller'=>'Listings', 'action'=>'detail', $id]);
			} else {
				$this->Flash->error("Message could not send.");
				return $this->redirect(['controller'=>'Listings', 'action'=>'detail', $id]);
			}

		}
		$this->set(compact('listing', 'message'));

	}
}



