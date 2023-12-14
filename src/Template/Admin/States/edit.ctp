<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h5 class="float-xs-left"><?= $title_for_layout; ?></h5>
	</div>
    <?= $this->Form->create($states,['type'=>'file','novalidate'=>true]) ?> 
    <fieldset>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('country_id',['options'=>$countries,'empty'=>true]); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('state',['label'=>'Province']); ?>
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


