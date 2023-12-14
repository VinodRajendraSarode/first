<?php echo $this->element('header'); ?>

<div id="page">
		<header class="header_in is_sticky menu_fixed">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-12">
					<div id="logo">
						<a href="/" title="">
						<?php
							echo $this->Html->image(\Cake\Core\Configure::read('logo.name'), ['class'=>'logo_sticky']);
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
				<h1>Account</h1>
			</div>
			<!-- /container -->
		</div>
		<!-- /sub_header -->

		<main>
			<div class="container margin_60">
				<div class="row justify-content-center">
					<div class="col-xl-6 col-lg-6 col-md-8">
						<?= $this->Flash->render(); ?>
						<div id="ajaxDiv">
							<?= $this->fetch('content'); ?>
						</div>
					</div>
				</div>
			<!-- /row -->
			</div>
			<!-- /container -->
		</main>
		<!--/main-->
<?php echo $this->element('footer'); ?>
