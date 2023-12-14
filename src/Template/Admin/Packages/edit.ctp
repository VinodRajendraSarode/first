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
    <?= $this->Form->create($packages,['type'=>'file','novalidate'=>true]) ?> 
    <fieldset>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('package'); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('no_of_listings',['options'=>range(1,10),'empty'=>'(Choose One)']); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('period',['options'=>range(1,36),'empty'=>'(Choose One)']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->control('active'); ?>
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


