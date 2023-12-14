
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($user,['type'=>'file','novalidate'=>true]) ?> 
    <fieldset>
		<?php if(empty($user['id'])){ ?>
		<div class="row">
		   <legend><?= __('Login Details') ?></legend>	
			<div class="col-md-3">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('name'); ?>
			</div>
			<div class="col-md-3">
				<?php echo $this->Form->control('email'); ?>
			</div>
			<div class="col-md-3">
				<?php echo $this->Form->control('mobile'); ?>
			</div>
			<div class="col-md-3">
				<?php echo $this->Form->control('password');?>
			</div>
		</div>
		<?php } else{ ?>
		<div class="row">
		   <legend><?= __('Login Details') ?></legend>	
			<div class="col-md-4">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('name'); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('email'); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('mobile'); ?>
			</div>
		</div>
		<?php }	?>
		</div><br>
       <div class="row">
		<legend><?= __('Address Details') ?></legend>	
			<div class="col-md-6">
				<?php echo $this->Form->control('member.location_id',['options'=>$locationLists,'class'=>'select2']); ?>
			</div>
			<div class="col-md-6">
				<?php echo $this->Form->control('member.pincode'); ?>
			</div>
		</div>
	 </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
</div>
