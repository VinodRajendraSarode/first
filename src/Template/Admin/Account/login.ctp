<h3 align="center">Login to Listly</h3>
<div class="box box-block bg-white">
	<?php echo $this->Form->create('User',array('class'=>'form-material mb-1 material-danger'));?>
		<div class="form-group">
			<?= $this->Form->input('email',['class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Email']);?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('password',['class'=>'form-control','label'=>false,'type'=>'password','placeholder'=>'Password']);?>
		</div>
		<div class="px-2 form-group mb-0">
			<button type="submit" class="btn btn-danger btn-block text-uppercase">Log in</button>
		</div>
	<?php echo $this->Form->end();?>
	<div class="p-2 text-xs-center text-muted">
		Forgot Password ? 
		<?php echo $this->Html->link('<span class="underline">Click Here?</span>', ['controller'=>'account', 'action'=>'forgot'], ['class'=>'text-black', 'escape'=>false]); ?>
	</div>
</div>
