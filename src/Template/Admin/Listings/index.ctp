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
        <?php echo $this->Form->button('Search', ['class'=>'btn btn-bordered-info']); ?>
        <?php echo $this->Html->link('Reset', ['action' => 'index'],['class'=>'btn btn-primary']); ?>
        <?php echo $this->Form->end(); ?>
	<script>
		$(document).ready(function(){
			$("#SearchForm").one("submit", function(e) {
				e.preventDefault();
				$.post('listings', $('#SearchForm').serialize()).done(function(data){
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
                            <th scope="col"><?= $this->Paginator->sort('listing_title','Listing')?></th>
							<th scope="col"><?= $this->Paginator->sort('email','Email')?></th>
							<th scope="col"><?= $this->Paginator->sort('mobile','Mobile')?></th>
							<th scope="col">&nbsp;</th>
							<th scope="col"><?= $this->Paginator->sort('active','Status')?></th>
					        <th scope="col" width="15%"><?= $this->Paginator->sort('Actions') ?></th>
				        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listings as $listing): ?>
                        <tr>
							<?php if(!empty($listing->user->name)){ ?>
							<td><?= $listing->user->name?></td>
							<?php }else{ ?>
							<td></td>
							<?php } ?>
                            <td><?= $listing->listing_title?></td>
							<td><?= $listing->email?></td>
							<td><?= $listing->mobile?></td>
							<td>
                                <?= $listing->premium ? '<span class="tag tag-primary">Premium</span>' : '' ?>&nbsp;
                                <?= $listing->popular ? '<span class="tag tag-primary">Popular</span>' : '' ?>
                            </td>
							<?php if($listing->active == '1'){ ?>
								<td><span class="tag tag-success">Active</span></td>
							<?php }else{?>
								<td><span class="tag tag-danger">InActive</span></td>
							<?php }?>
						    <td class="actions">
							<?php if($listing->active == false) {?>
								<?= $this->Html->link('Activate',['controller'=>'Listings','action'=>'activate',$listing->id],['class'=>'btn btn-primary btn-sm']); ?>
								<?php }else{?>
								<?= $this->Html->link('DeActivate',['controller'=>'Listings','action'=>'deactivate',$listing->id],['class'=>'btn btn-danger btn-sm']); ?>
								<?php }?>
                                <?= $this->N->editLink(['action' => 'edit', $listing->id]); ?>
                                <?= $this->N->deleteLink(['action' => 'delete', $listing->id]); ?>
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
