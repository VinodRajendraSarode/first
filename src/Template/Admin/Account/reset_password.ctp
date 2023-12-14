 
<div class="box box-block bg-white">
	<?php echo $this->Form->create($user,['class'=>'form-material mb-1']);?>	
		<div class="form-group">
      <?php echo $this->Form->hidden('id'); ?>
      <?php echo $this->Form->hidden('username'); ?>
			<?php echo $this->Form->input('password',array('class'=>'form-control','label'=>false,'type'=>'password','placeholder'=>'Password'));?>
			<?php echo $this->Form->input('verify_password',array('class'=>'form-control','label'=>false,'type'=>'password','placeholder'=>'Retype Password'));?>
		</div>
		<div class="px-2 form-group mb-0">
			<button type="submit" class="btn btn-danger btn-block text-uppercase">Create Password</button>
		</div>
	<?php echo $this->Form->end();?>
</div>


