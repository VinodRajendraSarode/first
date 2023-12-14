<div class="row">
	<div class="col-md-3">
		<span style="color:balck">Vendor Name:</span> <span style="color:red"><?php echo $vendor->vendor  ?></span>
	</div>
	<div class="col-md-3">
		<span style="color:balck">Package:</span> <span style="color:red"><?php echo $vendor->active_subscription->package->package ?></span>
	</div>
	<div class="col-md-3">
		<span style="color:balck">No of Listings:</span> <span style="color:red"><?php echo $vendor->active_subscription->package->no_of_listings ?></span>
	</div>
</div>

<a href="/listings/add" class="btn_add">Add Listings</a>

<div class="strip_booking">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col"><?= $this->Paginator->sort('listing_title','Listing')?></th>
				<th scope="col"><?= $this->Paginator->sort('email','Email')?></th>
				<th scope="col"><?= $this->Paginator->sort('mobile','Mobile')?></th>
				<th scope="col"><?= $this->Paginator->sort('active','Status')?></th>
				<th scope="col" class="actions" width="10%"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($listings as $listing): //debug($listing);exit; ?>
			<tr>
				<td><?= $listing->listing_title?></td>
				<td><?= $listing->email?></td>
				<td><?= $listing->mobile?></td>
				<?php if($listing->active == '1'){ ?>
					<td><span class="text-success">Active</span></td>
				<?php }else{?>
					<td><span class="text-danger">InActive</span></td>
				<?php }?>
				<td class="actions">
					<?= $this->Html->link(__('Edit'), ['controller' => 'Listings','action' => 'edit',$listing->id],['class'=>'btn btn-warning btn-sm pull-right']) ?>					
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
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
