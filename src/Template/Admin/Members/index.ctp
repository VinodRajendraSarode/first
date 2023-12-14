<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
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
				$.post('users', $('#SearchForm').serialize()).done(function(data){
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
                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>                            
                            <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Role') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): 
                            foreach($user->roles as $role) 
                            if($role->alias == "member"){ ?>
                        <tr>
                            <td><?= h($user->name) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->mobile) ?></td>                            
                            <?php if($user->active == '1'){ ?>
								<td><span class="text-success">Active</span></td>
							<?php }else{?>
								<td><span class="text-danger">InActive</span></td>
							<?php }?>
                            <?php if($user->is_vendor == '1'){ ?>
								<td><span class="tag tag-success">Vendor</span></td>
							<?php }else{?>
								<td><span class="tag tag-danger">Member</span></td>
							<?php }?>

                            <td class="actions">
								<?php if($user->is_vendor == false) {?>
								    <?= $this->Html->link('Make Vendor',['controller'=>'Members','action'=>'addVendor',$user->id],['class'=>'btn btn-primary btn-sm']); ?>
								<?php } else { ?>    
								    <?= $this->Html->link('Remove Vendor',['controller'=>'Members','action'=>'removeVendor',$user->id],['class'=>'btn btn-danger btn-sm']); ?>
                                <?php } ?>
                                <?php if($user->active == false) {?>
								    <?= $this->Html->link('Activate',['controller'=>'users','action'=>'activate',$user->id],['class'=>'btn btn-primary btn-sm']); ?>
								<?php }else{?>
								    <?= $this->Html->link('DeActivate',['controller'=>'users','action'=>'deactivate',$user->id],['class'=>'btn btn-danger btn-sm']); ?>
								<?php }?>	
                                                           
                            </td>
                        </tr>
                        <?php } endforeach; ?>
                    </tbody>
                </table>
			</div>
       </div>
	</div>
</div>	
<?php echo $this->element('Neptune.pagination'); ?>
