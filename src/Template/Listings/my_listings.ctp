<?php
	use Cake\I18n\Date;
 ?>
 <?php if(!empty($member['subscription'])) { ?>
<div class="box box-block bg-white p-3 mt-1">
	<div class="row mobviews">
		<div class="col-md-3">
			<span style="color:balck">Vendor Name:</span> <span style="color:red"><?php echo $member->name  ?></span>
		</div>
		<div class="col-md-3">
			<span style="color:balck">Package:</span> <span style="color:red"><?php echo $member->subscription->package->package ?></span>
		</div>
		<div class="col-md-2">
		<?php if($Listingcount != $member->subscription->package->no_of_listings){ ?>
			<span style="color:balck">No of Listings:</span><span style="color:red"><?php  echo $member->subscription->package->no_of_listings ;	?></span>
		<?php }else{ ?>
			<span style="color:balck">No of Listings:  </span><span style="color:red">Listing Limit exceeded.</span>
		<?php } ?>
		</div>	
		<div class="col md-4">
			<?php if($member->subscription->active == 1){ ?>
				<span style="color:balck">Registration Date:</span> &nbsp; <span style="color:red"><?php  echo $member->subscription->registration_date ;	?></span> <br>
				<span style="color:balck">Expiry Date:</span>&nbsp; <span style="color:red"><?php  echo $member->subscription->expiry_date ;	?></span>
			<?php }else{ ?>
				<span style="color:balck">Expiry Date: </span> &nbsp; <span style="color:red">Package Expired.</span>
			<?php } ?>		
		</div>
	</div>
	<div class="mobview">
		<div class="row">
			<div class="col-md-4">
				<h4><b><?php echo $member->name  ?></b></h4>
				<h6><?php echo $member->subscription->package->package ?></h6>
				<h6><?php if($member->subscription->active == 1) {
					echo "From ".$member->subscription->registration_date." To ".$member->subscription->expiry_date;
					 } else { 
						echo "Packege Expired";
;					 } ?></h6>
			</div>
		</div>

	</div>
</div> <br>

<div class="row">
	<div class="col-md-6">
		<?php if($Listingcount != $member->subscription->package->no_of_listings){ ?>
			<a href="/listings/add" class="btn_add">Add Listings</a>
		<?php } ?>

	</div>
	<div class="col-md-6" align="right">
	<?php 	$now = Date::now();
			if($member->subscription->expiry_date < $now){ ?>
			<!-- <a href="/listings/renew" class="btn_add"></a> -->
			<?= $this->Html->link(__('Renew Package'), ['controller' => 'Listings','action' => 'renew', $member->subscription->package_id],['class'=>'btn_add']) ?>			
		<?php } ?>		
	</div>
	
</div> <br>

<?php }  ?>
 
				
 	<div class="row">
	 	<?php
			if(!empty($listings)){
		 foreach ($listings as $listing):  ?>	
		<div id="filters_col"  class="col-md-4  m-3">
			<h4><b><?= $listing->listing_title?></b></h4>
			<h6><?= $listing->email?></h6>
			<h6><?= $listing->mobile?></h6>
			<h6><?= ($listing->active) ? '<span class="text-success">Active<span>' : '<span class="text-danger">Inactive<span>' ?></h6>
			<?= $this->Html->link(__('Edit'), ['controller' => 'Listings','action' => 'edit',$listing->id],['class'=>'btn btn-warning btn-sm pull-right']) ?>					

		</div>
		<?php endforeach; } ?> &nbsp;

	</div>

<div class="pagination pagination-large">
	    <ul class="pagination">
            <?php
                echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
    </div>
