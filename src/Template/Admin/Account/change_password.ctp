<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h3 class="float-xs-left"><?= $title_for_layout; ?></h3>
	</div>
    <br>
	 <?= $this->Form->create($user,['novalidate'=>true, 'autocomplete'=>false, 'autocomplete'=>'off']) ?>
        <div class="row">
			<div class="col-md-6">
    			<?php echo $this->Form->input('password', ['type'=>'password', 'label'=>'New Password','autocomplete'=>false]); ?>					
			</div>
		</div>
        <div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->input('verify_password', ['type'=>'password','label'=>'Verify Password']); ?>
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
