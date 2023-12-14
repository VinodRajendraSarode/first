<?php echo $this->element('header'); ?>
<body>
<div id="page">
<header class="header_in">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-12">
					<div id="logo" class="p-0">
						<a href="/" title="">
						<?php
							echo $this->Html->image(\Cake\Core\Configure::read('logo.name'), ['class'=>'']);
						?>
						</a>
					</div>
				</div>
				<div class="col-lg-9 col-12">
					<?= $this->element('menu'); ?>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</header>
<!-- /header -->


	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1><?= $page->menu ?></h1>
		</div>
		<!-- /container -->
	</div>
	<!-- /sub_header -->

	<main>
		<div class="container margin_80_55">
			<?= $this->Flash->render(); ?>
			<div id="ajaxDiv">
				<?= $this->fetch('content'); ?>
			</div>
		</div>
		<!-- /container -->
	</main>
	<!--/main-->

<?php echo $this->element('footer'); ?>
