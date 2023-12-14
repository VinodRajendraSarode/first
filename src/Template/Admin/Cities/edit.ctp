<script>
	$(document).ready(function(){
		$("#country-id").on("change", function(){
			$("#state-id").empty();
			$.ajax({
				type: "GET",
				url: "/admin/countries/getCountry/"+$("#country-id").val(),
				dataType:"json"
			}).done(function(data) {
				console.table(data.states);
				States=data.states;
				$.each(States, function(key, value) {
				$('#state-id')
					 .append($("<option></option>")
								.attr("value",key)
								.text(value)); 
					  
				});
				<?php if(!empty($cities->state_id)) { ?>
					$('#state-id').val("<?php echo $cities['state']['id']; ?>");
				<?php } ?>
			});
		});
		$("#country-id").trigger("change");
	});
</script>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h5 class="float-xs-left"><?= $title_for_layout; ?></h5>
	</div>
    <?= $this->Form->create($cities,['type'=>'file','novalidate'=>true]) ?> 
    <fieldset>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('country_id',['options'=>$countries,'empty'=>true]); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('state_id',['empty'=>true,'label'=>'Province']); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('city'); ?>
			</div>
		</div>
	</fieldset><br>
	<fieldset>
		<div class="row pull-right">
			<div class="col-md-12">
				<?= $this->N->cancelLink(['action'=>'index']); ?>
				<button class="btn btn-primary">Save</button>
			</div>
		</div>	
	</fieldset><br>
</div>


