
<script>
	$(document).ready(function(){
		
		$("#country-id").on("change", function(){
			$("#state-id").empty();			
			$.ajax({
				type: "GET",
				url: "/admin/countries/getCountry/"+$("#country-id").val(),
				dataType:"json"
			}).done(function(data) {
				States = data.states;
				console.log(States);
				$('#state-id ')
					.append($("<option></option>")
					.attr("value",'')
					.text('---'));
				$.each(States, function(key, value) {
				$('#state-id')
					 .append($("<option></option>")
								.attr("value",key)
								.text(value)); 
					  
				});
				<?php if(!empty($listings->state_id)) { ?>
					$('#state-id').val("<?php echo $listings['state']['id']; ?>");
				<?php } ?>
			});
		});
		$("#country-id").trigger("change");

		$("#state-id").on("change", function(){						
			$.ajax({
				type: "GET",
				url: "/cities/getCities/"+$("#state-id").val(),
				dataType:"json"
			}).done(function(data) {
				$("#city-id").empty();	
				City =data.cities;
				$('#city-id ')
					.append($("<option></option>")
					.attr("value",'')
					.text('---'));
				$.each(City, function(key, value) {
				$('#city-id')
					.append($("<option></option>")
					.attr("value",key)
					.text(value));

				});

				<?php  if(!empty($listings->city_id)) {  ?>
					$('#city-id').val("<?php echo $listings['city']['id']; ?>");
				<?php } ?>

			});
		});
		$("#state-id").trigger("change");


		$("#category-id").on("change", function(){
			$("#sub-category-id").empty();
			$.ajax({
				type: "GET",
				url: "/admin/categories/getCategory/"+$("#category-id").val(),
				dataType:"json"
			}).done(function(data) {
				sub_category=data.categories.sub_categories;
				$.each(sub_category, function(key, value) {
				$('#sub-category-id')
					 .append($("<option></option>")
								.attr("value",value.id)
								.text(value.sub_category)); 
					  
				});
				<?php if(!empty($listings->sub_category_id)) { ?>
					$('#sub-category-id').val("<?php echo $listings['sub_category']['id']; ?>");
				<?php } ?>
			});
		});
		$("#category-id").trigger("change");	

		$("#closed-1").on("change", function() {
			
			if($('#closed-1').val() == 'Yes') {
				$("#from-1").prop("disabled", true);
				$("#to-1").prop("disabled", true);
			} else {
				$("#from-1").prop("disabled", false);
				$("#to-1").prop("disabled", false);
			}
		});

		$("#closed-2").on("change", function() {
			
			if($('#closed-2').val() == 'Yes') {
				$("#from-2").prop("disabled", true);
				$("#to-2").prop("disabled", true);
			} else {
				$("#from-2").prop("disabled", false);
				$("#to-2").prop("disabled", false);
			}
		});

		$("#closed-3").on("change", function() {
			
			if($('#closed-3').val() == 'Yes') {
				$("#from-3").prop("disabled", true);
				$("#to-3").prop("disabled", true);
			} else {
				$("#from-3").prop("disabled", false);
				$("#to-3").prop("disabled", false);
			}
		});

		$("#closed-4").on("change", function() {
			
			if($('#closed-4').val() == 'Yes') {
				$("#from-4").prop("disabled", true);
				$("#to-4").prop("disabled", true);
			} else {
				$("#from-4").prop("disabled", false);
				$("#to-4").prop("disabled", false);
			}
		});

		$("#closed-5").on("change", function() {
			
			if($('#closed-5').val() == 'Yes') {
				$("#from-5").prop("disabled", true);
				$("#to-5").prop("disabled", true);
			} else {
				$("#from-5").prop("disabled", false);
				$("#to-5").prop("disabled", false);
			}
		});

		$("#closed-6").on("change", function() {
			
			if($('#closed-6').val() == 'Yes') {
				$("#from-6").prop("disabled", true);
				$("#to-6").prop("disabled", true);
			} else {
				$("#from-6").prop("disabled", false);
				$("#to-6").prop("disabled", false);
			}
		});

		$("#closed-7").on("change", function() {
			
			if($('#closed-7').val() == 'Yes') {
				$("#from-7").prop("disabled", true);
				$("#to-7").prop("disabled", true);
			} else {
				$("#from-7").prop("disabled", false);
				$("#to-7").prop("disabled", false);
			}
		});
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
    <?= $this->Form->create($listings,['type'=>'file','novalidate'=>true]) ?> 
    <fieldset>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('user_id',['options'=>$users,'empty'=>true, 'label'=>'Vendor']); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('category_id',['options'=>$categories,'empty'=>true]); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('sub_category_id',['options'=>$subCategories,'empty'=>true]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo $this->Form->control('listing_title',['lable'=>"Listing Title"]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo $this->Form->control('slug',['readonly'=>true]); ?>
			</div>
		</div>		
		<div class="row">
			<div class="col-md-12">
				<?= $this->Form->input('address', ['type' => 'textarea','placeholder'=> 'Address','rows' => '3', 'cols' => '20']); ?>
			</div>
		</div>		
		<div class="row">
			<div class="col-md-12">
				<?= $this->Form->input('description', ['type' => 'textarea','placeholder'=> 'Description','rows' => '10', 'cols' => '20']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->control('google_location',['lable'=>"Google Location"]); ?>
			</div>
			<div class="col-md-6">
				<?php echo $this->Form->control('gps',['lable'=>"GPS"]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->control('country_id',['options'=>$countries,'empty'=>true]); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('state_id',['empty'=>'---','label'=>'Province']); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('city_id',['options'=>$cities,'empty'=>true]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->control('email',['lable'=>"Email"]); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('mobile',['lable'=>"Mobile"]); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('postal_code',['lable'=>"Postal Code"]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->control('website'); ?>
			</div>			
		</div>
		<div class="row">	
			<div class="col-md-12">				
				  &nbsp;<?= $this->Form->control('hide_contact', ['type'=>'checkbox']) ?> 
				<span style='font-size:12px;'>(check whether mobile number and address will be show on listing or not)	</span>
			</div> 
		</div> <br>
		<h5>Business Hours</h5>
		<div class="row">
			<div class="col-md-3">
				<?= $this->Form->control('day_1', ['label'=>'Day', 'value'=>'Monday', 'readonly'=>true]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('closed_1', ['label'=>'Closed', 'options'=>['No'=>'No', 'Yes'=>'Yes']]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('from_1', ['label'=>'From', 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('to_1', ['label'=>'To', 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?= $this->Form->control('day_2', ['label'=>false, 'value'=>'Tuesday', 'readonly'=>true]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('closed_2', ['label'=>false, 'options'=>['No'=>'No', 'Yes'=>'Yes']]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('from_2', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('to_2', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?= $this->Form->control('day_3', ['label'=>false, 'value'=>'Wednesday', 'readonly'=>true]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('closed_3', ['label'=>false, 'options'=>['No'=>'No', 'Yes'=>'Yes']]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('from_3', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('to_3', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?= $this->Form->control('day_4', ['label'=>false, 'value'=>'Thursday', 'readonly'=>true]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('closed_4', ['label'=>false, 'options'=>['No'=>'No', 'Yes'=>'Yes']]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('from_4', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('to_4', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?= $this->Form->control('day_5', ['label'=>false, 'value'=>'Friday', 'readonly'=>true]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('closed_5', ['label'=>false, 'options'=>['No'=>'No', 'Yes'=>'Yes']]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('from_5', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('to_5', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?= $this->Form->control('day_6', ['label'=>false, 'value'=>'Saturday', 'readonly'=>true]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('closed_6', ['label'=>false, 'options'=>['No'=>'No', 'Yes'=>'Yes']]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('from_6', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('to_6', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?= $this->Form->control('day_7', ['label'=>false, 'value'=>'Sunday', 'readonly'=>true]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('closed_7', ['label'=>false, 'options'=>['No'=>'No', 'Yes'=>'Yes']]); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('from_7', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
			<div class="col-md-3">
				<?= $this->Form->control('to_7', ['label'=>false, 'options'=>Cake\Core\Configure::read('time'), 'empty'=>'Please Select']); ?>
			</div>
		</div>
		<!--<div class="row">
			<div class="col-md-3">
				<?php //echo $this->Form->control('hourly_rate',['lable'=>"Hourly Rate"]); ?>
			</div>
			<div class="col-md-3">
				<?php //echo $this->Form->control('daily_rate',['lable'=>"Daily Rate"]); ?>
			</div>
			<div class="col-md-3">
				<?php //echo $this->Form->control('currency',['lable'=>"Currency"]); ?>
			</div>
			<div class="col-md-3">
			<label>Open 24/7</label><br>
				<?php //echo $this->Form->checkbox('open_24_7',['lable'=>true]); ?>
			</div>
		</div>-->
		<div class="row">
			<div class="col-md-4">
			<label>Banner</label>
				<?php 
					echo $this->Form->input('banner',['type'=>'file','label'=>false]);
					echo $this->Form->hidden('banner_dir');
					if(!empty($listings->banner_dir)) {
						echo $this->Html->link($listings->banner,'/files/listings/banner/'.$listings->banner_dir.'/proper_'.$listings->banner,['target'=>'_blank']);
					}
				?>
			</div>
			<div class="col-md-4">
			<label>Image</label>
				<?php 
					echo $this->Form->input('image',['type'=>'file','label'=>false]);
					echo $this->Form->hidden('image_dir');
					if(!empty($listings->image_dir)) {
						echo $this->Html->link($listings->image,'/files/listings/image/'.$listings->image_dir.'/proper_'.$listings->image,['target'=>'_blank']);
					}
				?>
			</div>
			<div class="col-md-4">
			<label>Image 1</label>
				<?php 
					echo $this->Form->input('image_1',['type'=>'file','label'=>false]);
					echo $this->Form->hidden('image_1_dir');
					if(!empty($listings->image_1_dir)) {
						echo $this->Html->link($listings->image_1,'/files/listings/image_1/'.$listings->image_1_dir.'/proper_'.$listings->image_1,['target'=>'_blank']);
					}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
			<label>Image 2</label>
				<?php 
					echo $this->Form->input('image_2',['type'=>'file','label'=>false]);
					echo $this->Form->hidden('image_2_dir');
					if(!empty($listings->image_2_dir)) {
						echo $this->Html->link($listings->image_2,'/files/listings/image_2/'.$listings->image_2_dir.'/proper_'.$listings->image_2,['target'=>'_blank']);
					}
				?>
			</div>
			<div class="col-md-4">
			<label>Image 3</label>
				<?php 
					echo $this->Form->input('image_3',['type'=>'file','label'=>false]);
					echo $this->Form->hidden('image_3_dir');
					if(!empty($listings->image_3_dir)) {
						echo $this->Html->link($listings->image_3,'/files/listings/image_3/'.$listings->image_3_dir.'/proper_'.$listings->image_3,['target'=>'_blank']);
					}
				?>
			</div>
			<div class="col-md-4">
			<label>Image 4</label>
				<?php 
					echo $this->Form->input('image_4',['type'=>'file','label'=>false]);
					echo $this->Form->hidden('image_4_dir');
					if(!empty($listings->image_4_dir)) {
						echo $this->Html->link($listings->image_4,'/files/listings/image_4/'.$listings->image_4_dir.'/proper_'.$listings->image_4,['target'=>'_blank']);
					}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
			<label>Active</label><br>
				<?php echo $this->Form->checkbox('active',['lable'=>true]); ?>
			</div>
			<div class="col-md-4">
			<label>Premium</label><br>
				<?php echo $this->Form->checkbox('premium',['lable'=>true]); ?>
			</div>
			<div class="col-md-4">
			<label>Popular</label><br>
				<?php echo $this->Form->checkbox('popular',['lable'=>true]); ?>
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


