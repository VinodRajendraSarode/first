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
    <?= $this->Form->create($categories,['type'=>'file','novalidate'=>true]) ?> 
    <fieldset>
		<div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('category'); ?>
			</div>
			<div class="col-md-6">
					<?php echo $this->Form->control('slug',['readonly'=>true]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->Form->input('description', ['type' => 'textarea','placeholder'=> 'Description','rows' => '10', 'cols' => '20']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?php echo $this->Form->control('icon'); ?>
			</div>
			<div class="col-md-3">
				<?php echo $this->Form->control('list_order'); ?>
			</div>
			<div class="col-md-3">
			<label>Popular</label><br>
				<?php echo $this->Form->checkbox('popular',['lable'=>true]); ?>
			</div>
			<div class="col-md-3">
			<label>Display On Homepage</label><br>
				<?php echo $this->Form->checkbox('display_on_homepage',['lable'=>true]); ?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-3">
			<label>Attachment</label>
				<?php 
					echo $this->Form->input('photo',['type'=>'file','label'=>false]);
					echo $this->Form->hidden('photo_dir');
					if(!empty($categories->photo_dir)) {
						echo $this->Html->link($categories->photo,'/files/categories/photo/'.$categories->photo_dir.'/proper_'.$categories->photo,['target'=>'_blank']);
					}
				?>
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


