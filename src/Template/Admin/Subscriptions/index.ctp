<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package[]|\Cake\Collection\CollectionInterface $packages
 */
?>

<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h5 class="float-xs-left"><?= $title_for_layout; ?></h5>
	</div>
    <?php echo $this->Form->create(null, ['class'=>'form-inline','valueSources' => 'query','id'=>'SearchForm']); ?>
        <?php echo $this->Form->input('search',['placeholder'=>'Search','label'=>false]); ?>		
		<?php echo $this->N->datepicker('from_expiry_date', ['placeholder'=>'Expiry Date']); ?>
		<?php echo $this->N->datepicker('to_expiry_date', ['placeholder'=>'Expiry Date']); ?>
		
        <?php echo $this->Form->button('Search', ['class'=>'btn btn-bordered-info']); ?>
        <?php echo $this->Html->link('Reset', ['action' => 'index'],['class'=>'btn btn-primary']); ?>
        <?php echo $this->Form->end(); ?>    
	<script>
		$(document).ready(function(){
			$("#SearchForm").one("submit", function(e) {
				e.preventDefault();
				$.post('subscriptions', $('#SearchForm').serialize()).done(function(data){
					NProgress.start();
					$("#ajaxDiv").empty().append(data);
					NProgress.done();
				});;
			});			
		});
	</script>
</div>
<div class="box box-block bg-white">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover">
                    <thead>
                        <tr>
							<th scope="col"><?= $this->Paginator->sort('user_id','Vendor')?></th>
							<th scope="col"><?= $this->Paginator->sort('email')?></th>
							<th scope="col"><?= $this->Paginator->sort('mobile')?></th>
                            <th scope="col"><?= $this->Paginator->sort('package_id','Package')?></th>
							<th scope="col"><?= $this->Paginator->sort('registration_date','Registration Date')?></th>
							<th scope="col"><?= $this->Paginator->sort('expiry_date','Expiry Date')?></th>
							<th scope="col"><?= $this->Paginator->sort('active','Status')?></th>
							<th scope="col"><?= $this->Paginator->sort('action','Action')?></th>
					    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscriptions as $subscription): //debug($subscription);exit; ?>
                        <tr>
							<?php if(!empty($subscription->user->name)){ ?>
							<td><?= $subscription->user->name?></td>
							<?php }else{ ?><td></td><?php } ?>
							<?php if(!empty($subscription->user->email)){ ?>
							<td><?= $subscription->user->email?></td>
							<?php }else{ ?><td></td><?php } ?>
							<?php if(!empty($subscription->user->mobile)){ ?>
							<td><?= $subscription->user->mobile?></td>
							<?php }else{ ?><td></td><?php } ?>
                            <?php if(!empty($subscription->package->package)){ ?>
							<td><?= $subscription->package->package?></td>
							<?php }else{ ?>
							<td></td>
							<?php } ?>
							<td><?= $subscription->registration_date?></td>
							<td><?= $subscription->expiry_date?></td>
							<?php if($subscription->active == '1'){ ?>
								<td><span class="text-success">Active</span></td>
							<?php }else{?>
								<td><span class="text-danger">InActive</span></td>
							<?php }?>
							<td>
								<?php if($subscription->active == false) {?>
								<?= $this->Html->link('Activate',['controller'=>'Subscriptions','action'=>'activate',$subscription->id],['class'=>'btn btn-primary btn-sm']); ?>
								<?php }else{?>
								<?= $this->Html->link('DeActivate',['controller'=>'Subscriptions','action'=>'deactivate',$subscription->id],['class'=>'btn btn-danger btn-sm']); ?>
								<?php }?>
							</td>
						    
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
				</table>
			</div>
       </div>
	</div>
</div>	
<?php echo $this->element('Neptune.pagination'); ?>
