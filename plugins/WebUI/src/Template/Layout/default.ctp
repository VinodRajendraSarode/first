<!-- <?php echo $this->element('header'); ?> -->


<main class="pattern">
	<div class="container margin_80_55">
		<?= $this->Flash->render(); ?>
		<div id="ajaxDiv">
			<?= $this->fetch('content'); ?>
		</div>
	</div>	

</main>
<!-- /main -->
<?php echo $this->element('footer'); ?>
