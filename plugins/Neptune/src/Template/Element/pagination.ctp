<?php
	$this->Paginator->options(array(
		'update' => '#ajaxDiv',
		'evalScripts' => false,
		'complete'=>"ajaxComplete();",
		'before' => 'ajaxBefore();',
		'success' => 'ajaxAfter();',
	));
?>

<div class="row">
	<div class="col-md-4">
		<?php
			echo $this->Paginator->counter(array(
				'format' => __('<span class="mailbox_count_msg"><strong>{{start}}</strong>-<strong>{{end}}</strong> of <strong>{{count}}</strong></span>')
			));
		?>
	</div>
	<div class="col-md-8">
		<nav class="pull-right">
			<ul class="pagination m-0">
				<?php
					echo $this->Paginator->prev();
				//	echo $this->Paginator->numbers();
					echo $this->Paginator->next();

				?>
			</ul>
		</nav>
	</div>
</div>
<script>
	$(document).one('click', '.pagination a, .sort', function() {

		var target = $(this).attr('href');
		if(!target)
			return false;
		$.get(target, function(data) {
			NProgress.start();
			$('#ajaxDiv').html( data );
		}, 'html').done(function(){
			NProgress.done();
		});
		return false;
	});
</script>

