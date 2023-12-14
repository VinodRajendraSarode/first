<?php
use Cake\Core\Configure;
use Cake\I18n\Number;
?>
<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h5 class="float-xs-left"><?= $title_for_layout; ?></h5>
	</div>
	<div class="row">
		<div class="col-md-12">
			 <?= $this->Form->create('Report',['novalidate'=>true,'target'=>'_blank']) ?>
			<fieldset>
				<div class="row">
					<div class="col-md-4">
						<?= $this->N->datepicker('from',['label'=>'Expiry From']); ?>
					</div>
					<div class="col-md-4">
						<?= $this->N->datepicker('to',['label'=>'Expiry To']); ?>
					</div>			
					<div class="col-md-4">
						<?= $this->N->select('user_id',['options'=>$users]); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<?= $this->N->select('package_id',['options'=>$packages]); ?>
					</div>					
					<div class="col-md-4">
						<?= $this->Form->control('export',['options'=>['pdf'=>'pdf']]); ?>
					</div>							
				</div>
				<div class="row">
			</fieldset><hr />
			<fieldset>
				<div class="row pull-right">
					<div class="col-md-12">
						<?= $this->Form->button('<span class="fa fa-ok"></span> Show',['class'=>'btn btn-primary']);?>
					</div>
				</div>
			</fieldset>
			<?= $this->Form->end() ?>
		</div>
	</div><hr />
</div>

