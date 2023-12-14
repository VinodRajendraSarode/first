
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
				$.post('pages', $('#SearchForm').serialize()).done(function(data){
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
                            <th scope="col"><?= $this->Paginator->sort('menu')?></th>
							<th scope="col"><?= $this->Paginator->sort('page_title')?></th>
                            <th scope="col"><?= $this->Paginator->sort('page_heading')?></th>
                            <th scope="col"><?= $this->Paginator->sort('layout')?></th>
                            <th scope="col" width="15%"><?= $this->Paginator->sort('Actions') ?></th>
				        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page): //debug($category);exit; ?>
                        <tr>
                            <td><?= $page->menu?></td>
							<td><?= $page->page_title?></td>
                            <td><?= $page->page_heading?></td>
                            <td><?= $page->layout?></td>
                            <td class="actions">
                                <?= $this->N->editLink(['action' => 'edit', $page->id]); ?>
                                <?= $this->N->deleteLink(['action' => 'delete', $page->id]); ?>
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