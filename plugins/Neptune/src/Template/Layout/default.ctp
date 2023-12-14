<?php
	use Cake\I18n\Number;
	use Cake\Core\Configure;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Title -->
		<title><?= Configure::read("Project.name"); ?></title>
		<?= $this->fetch('meta'); ?>
		<!-- Vendor CSS -->

		<?=
			$this->Html->css([
				'/vendor/bootstrap4/css/bootstrap.min',
				'/vendor/themify-icons/themify-icons',
				'/vendor/font-awesome/css/font-awesome.min',
				'/vendor/animate.css/animate.min',
				'/vendor/jscrollpane/jquery.jscrollpane',
				'/vendor/waves/waves.min',
				'/vendor/switchery/dist/switchery.min',
				'/vendor/nprogress/nprogress',
				//'/vendor/morris/morris',
				'/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min',
				'/vendor/select2/dist/css/select2.min',
				'/vendor/summernote/summernote',
				'summernote-add-tags',
				'core',
				'custom'
			]);
		?>
		<?= $this->fetch('css'); ?>
		<?= $this->Html->script([
			'/vendor/jquery/jquery-1.12.3.min',
			//'/vendor/chartjs/Chart.bundle.min'
			]);
		?>
		<script>
			$(document).ready(function(){
				if($('.summernote').length) {
					$('.summernote').summernote({
						toolbar: [
							// [groupName, [list of button]]
							['style', ['bold', 'italic', 'underline', 'clear']],
							// ['font', ['fontname', 'strikethrough', 'superscript', 'subscript']],
							// ['fontsize', ['fontsize']],
							// ['color', ['color']],
							['para', ['ul', 'ol']],
							// ['insert', ['picture', 'link', 'video', 'table', 'hr']],
							//['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'add-text-tags']],
							// ['misc', ['fullscreen', 'codeview', 'undo', 'redo']],
						],
						popover: {
							image: [],
							link: [],
							air: []
						},
						fontNames: ['Verdana', 'Arial', 'Courier New'],
						fontNamesIgnoreCheck: ['Verdana', 'Arial', 'Courier New'],
						fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150']
					});
				}
			});
		</script>
		<script src="//cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js" type="text/javascript"></script>
		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="fixed-sidebar fixed-header skin-default content-appear">
		<div class="wrapper">

			<!-- Preloader -->
			<div class="preloader"></div>

			<!-- Sidebar -->
			<div class="site-overlay"></div>
			<div class="site-sidebar">
				<?php echo $this->element('side_menu'); ?>
			</div>

			<!-- Header -->
			<div class="site-header">
				<?php echo $this->element('top_menu'); ?>
			</div>

			<div class="site-content">
				<!-- Content -->
				<div class="content-area py-1">
					<div class="container-fluid">
						<?= $this->Flash->render(); ?>
						<div id="ajaxDiv">
							<?= $this->fetch('content'); ?>
						</div>
					</div>
				</div>
				<!-- Footer -->
				<footer class="footer">
					<div class="container-fluid">
						<div class="row text-xs-center">
							<div class="col-sm-4 text-sm-left mb-0-5 mb-sm-0">
								2020 © Project Name
							</div>
							<div class="col-sm-8 text-sm-right">
								<ul class="nav nav-inline l-h-2">
									<!--<li class="nav-item"><a class="nav-link text-black" href="#">Privacy</a></li>
									<li class="nav-item"><a class="nav-link text-black" href="#">Terms</a></li>
									<li class="nav-item"><a class="nav-link text-black" href="#">Help</a></li>-->
								</ul>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<?=
			$this->Html->script([
				'/vendor/tether/js/tether.min',
				'/vendor/bootstrap4/js/bootstrap.min',
				'/vendor/detectmobilebrowser/detectmobilebrowser',
				'/vendor/jscrollpane/jquery.mousewheel',
				'/vendor/jscrollpane/mwheelIntent',
				'/vendor/jscrollpane/jquery.jscrollpane.min',
				'/vendor/waves/waves.min',
				'/vendor/switchery/dist/switchery.min',
				'/vendor/nprogress/nprogress',
				'/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min',
				'/vendor/select2/dist/js/select2.min',
				'/vendor/moment/moment',
				'jquery.selectboxes',
				'/vendor/summernote/summernote.min',
				'app',
				'jsDate'
			]);
		?>
		<?= $this->fetch('script'); ?>
		<script>
			function getNormalDate(val) {
				val = val.split('-');
				return val[2] + '/' + val[1] + '/' + val[0];
			}

			function getJsDate(val) {
				val = val.split('/');
				return val[1] + '/' + val[0] + '/' + val[2];
			}

			function getDate(val) {
				if(val.getDate() < 10) {
					d=("0" + val.getDate()).slice (-2);
				} else {
					d=val.getDate();
				}
				if(val.getMonth() < 10) {
					m=("0" + (val.getMonth()+1)).slice (-2);
				} else {
					m=val.getMonth()+1;
				}
				return d + '/' + (m) + '/' + val.getFullYear();
			}

			$(document).on('click', '.pagination a, .sort', function() {
				var target = $(this).attr('href');
				if(!target)
					return false;
				$.get(target, function(data) {
					//NProgress.start();
					$('#ajaxDiv').html( data );
				}, 'html').done(function(){
					//NProgress.done();
				});
				return false;
			});
	
		</script>
	</body>
</html>
