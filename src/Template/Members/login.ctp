<div class="box_account">
<h3 class="client">Already User</h3>
	<div class="form_container">
	
		<?= $this->Form->create('User',['url'=>['controller'=>'Members', 'action'=>'login'],['class'=>'form-material mb-1 material-danger']]) ?>

		
			<div class="form-group">
				<?= $this->Form->input('email',['class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Email']);?>
			</div>
			<div class="form-group">
				<?= $this->Form->input('password',['class'=>'form-control','label'=>false,'type'=>'password','placeholder'=>'Password']);?>
				<?= $this->Form->hidden('origin', ['value' => $this->request->referer()]) ?>
			</div>
			<div class="form-group mb-0">
				<button type="submit" class="btn btn-danger btn-block text-uppercase">Log in</button>
			</div>
		<?php echo $this->Form->end();?>
		<div class="p-2 text-xs-center text-muted">
			<?= $this->Form->postLink($this->Html->image('google_login.png'), '/oauth/google', ['escape'=>false]); ?>
		</div>
		<div class="p-2 text-xs-center text-muted">
			Forgot Password?
			<?php echo $this->Html->link('<span class= "underline">Click Here</span>', ['controller'=>'Members', 'action'=>'forgot'], ['class'=>'text-black', 'escape'=>false]); ?>
			<br>
			<span align=left>New User? </span>
					<span ><?= $this->Html->link('Register Now', ['controller'=>'Members','action'=>'register']) ?></span>
		</div>
	</div>
</div>
