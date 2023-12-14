<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h5 class="float-xs-left"><?= $title_for_layout; ?></h5>
	</div>
    <?= $this->Form->create($user,['type'=>'file','novalidate'=>true]) ?> 
    <fieldset>
		<div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('name'); ?>
			</div>
			<div class="col-md-6">
				<?php echo $this->Form->control('username'); ?>
			</div>
        </div>
        <div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->control('mobile'); ?>
			</div>
			<div class="col-md-6">
				<?php echo $this->Form->control('email'); ?>
			</div>            
		</div>
        <?php if($user->isNew()) { ?>
		<div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->control('password'); ?>
			</div>
		</div>
        <?php } ?>
		<div class="row">
			<div class="col-md-6">
                <?php echo $this->Form->control('roles._ids', ['options' => $roles, 'id' => 'magicselect', 'multiple'=>'checkbox']); ?>
			</div>
		</div>
	</fieldset><br>
	<fieldset>
		<div class="row pull-right">
			<div class="col-md-12">
				<?= $this->N->cancelLink(['action'=>'index']); ?>
				<button class="btn btn-primary">Save</button>
			</div>
		</div>	
	</fieldset><br>
</div>
