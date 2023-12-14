<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h3 class="float-xs-left"><?= $title_for_layout; ?></h3>
	</div>
    <br>
	 <?= $this->Form->create($user,['novalidate'=>true]) ?>
	
		<div class="row">
			<div class="col-md-6">
            <label>Change Password</label>
				<?php echo $this->Form->text('current_password', ['type'=>'password','placeholder'=>'Current Password']); ?>	
			</div>
		</div>
        <div class="row">
			<div class="col-md-6">
            <label>New Password</label>
				<?php echo $this->Form->text('password', ['type'=>'password','placeholder'=>'New Password','label'=>'New Password']); ?>					
			</div>
		</div>
        <div class="row">
			<div class="col-md-6">
            <label>Verify Password</label>
				<?php echo $this->Form->text('verify_password', ['type'=>'password','placeholder'=>'Verify Password','label'=>'Verify Password']); ?>
			</div>
		</div>	
	<fieldset>
		<div class="row pull-right">
			<div class="col-md-12">
				<?= $this->Html->link('Cancel',['action'=>'index'],['class' => 'btn btn-danger','confirm' => __('Are you sure you want to Cancel ?')]); ?>
				<button class="btn btn-primary">Save</button>
			</div>
		</div>
	</fieldset>
	<?= $this->Form->end() ?>
</div>
