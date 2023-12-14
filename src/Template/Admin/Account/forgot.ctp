<div class="box box-block bg-white">
	<?php echo $this->Form->create(null,['class'=>'form-material mb-1','url' => ['controller'=>' Account', 'action'=>'forgot']]);?>	
		<div class="form-group">
			<?php echo $this->Form->input('username',array('class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Username'));?>
			<?php echo $this->Form->input('mobile',array('class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Mobile'));?>
		</div>
		<div class="px-2 form-group mb-0">
			<button type="submit" class="btn btn-danger btn-block text-uppercase">Continue</button>
		</div>
	<?php echo $this->Form->end();?>
	
	<div class="p-2 text-xs-center text-muted">
		<?php echo $this->Html->link('<span class="underline"><< Back to Login</span>', ['controller'=>'account', 'action'=>'login'], ['class'=>'text-black', 'escape'=>false]); ?>
	</div>
</div>
