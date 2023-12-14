<?php 
	use Cake\I18n\Number;
	use Cake\Core\Configure;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Login</title>
	
	<?= $this->Html->css('/vendor/bootstrap4/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/vendor/themify-icons/themify-icons.css') ?>
    <?= $this->Html->css('/vendor/font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('core.css') ?>
	<?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
	<body class="img-cover">
		<div class="container-fluid">
			<div class="sign-form">
				<div class="row">
					<div class="col-md-4 offset-md-4 px-3">
						<div class="box b-a-0">
							<div class="p-2 text-xs-center">
								<h2><?= Configure::read("Project.name"); ?></h2>
							</div>
							<?= $this->Flash->render() ?>
							<?= $this->fetch('content') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?= $this->Html->script('/vendor/jquery/jquery-1.12.3.min.js') ?>
		<?= $this->Html->script('/vendor/tether/js/tether.min.js') ?>
		<?= $this->Html->script('/vendor/bootstrap4/js/bootstrap.min.js') ?>
	</body>
</html>
