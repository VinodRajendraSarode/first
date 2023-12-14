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
				$.post('subCategories', $('#SearchForm').serialize()).done(function(data){
					NProgress.start();
					$("#ajaxDiv").empty().append(data);
					NProgress.done();
				});;
			});			
		});
	</script>
</div>
<div class="box box-block bg-white">
    <div class="clearfix mb-1">
		<div class="float-xs-right">
			<?= $this->N->addLink(array('action'=>'edit')); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('sub_category')?></th>
							<th scope="col"><?= $this->Paginator->sort('category_id','Category')?></th>
							<th scope="col"><?= $this->Paginator->sort('slug')?></th>
                            <th scope="col" width="15%"><?= $this->Paginator->sort('Actions') ?></th>
				        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subCategories as $subCategory): //debug($subCategory);exit; ?>
                        <tr>
                            <td><?= $subCategory->sub_category?></td>
							<td><?= $subCategory->category->category?></td>
							<td><?= $subCategory->slug?></td>
                            <td class="actions">
                                <?= $this->N->editLink(['action' => 'edit', $subCategory->id]); ?>
                                <?= $this->N->deleteLink(['action' => 'delete', $subCategory->id]); ?>
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
