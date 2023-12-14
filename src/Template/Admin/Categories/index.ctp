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
				$.post('categories', $('#SearchForm').serialize()).done(function(data){
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
                            <th scope="col"><?= $this->Paginator->sort('category')?></th>
							<th scope="col"><?= $this->Paginator->sort('slug')?></th>
							<th scope="col"><?= $this->Paginator->sort('popular/Display on Homepage')?></th>
                            <th scope="col"><?= $this->Paginator->sort('list_order')?></th>
                            <th scope="col" width="15%"><?= $this->Paginator->sort('Actions') ?></th>
				        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): //debug($category);exit; ?>
                        <tr>
                            <td><?= $category->category?></td>
							<td><?= $category->slug?></td>
							<td>
								<?php if($category->popular == true && $category->display_on_homepage == true ){ ?>
								<span class="text-danger">Popular</span>/<span class="text-danger">Display on Homepage</span>
								<?php } else if($category->display_on_homepage == true){?>
								<span class="text-danger">Display on Homepage</span>
								<?php }else if($category->popular == true){?>
									<span class="text-danger">Popular</span>
								<?php }?>
							</td>
                            <td><?= $category->list_order?></td>
                            <td class="actions">
                                <?= $this->N->editLink(['action' => 'edit', $category->id]); ?>
                                <?= $this->N->deleteLink(['action' => 'delete', $category->id]); ?>
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
