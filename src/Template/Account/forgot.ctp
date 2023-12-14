<div class="box box-block bg-white">
	<?php echo $this->Form->create(null,['class'=>'form-material mb-1','url' => ['controller'=>' Members', 'action'=>'forgot']]);?>	
		<div class="form-group">
			<?php //echo $this->Form->hidden('id');?>
			<?php echo $this->Form->input('email',array('class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Email'));?>
			<?php //echo $this->Form->input('mobile',array('class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Mobile'));?>
		</div>
		<div class="px-2 form-group mb-0">
			<button type="submit" class="btn btn-danger btn-block text-uppercase">Continue</button>
		</div>
	<?php echo $this->Form->end();?>
	
	<div class="p-2 text-xs-center text-muted">
		<a href="/" ><span class="underline">Back to Login</span></a>
	</div>
</div>
