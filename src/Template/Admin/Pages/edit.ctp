<script>
	//CKEDITOR.replace('body');
	tinymce.init({
		selector: 'textarea#body',  // change this value according to your HTML
		height: 400,
		plugins: [
		'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media mediaembed nonbreaking',
		'table emoticons template paste help'
		],
		toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify |' +
		' bullist numlist outdent indent | link image | print preview media fullpage | ' +
		'forecolor backcolor | help',
		menu: {
			favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | emoticons'}
		},
		menubar: 'favs file edit view insert format tools table help',

		image_title: true,
		/* enable automatic uploads of images represented by blob or data URIs*/
		automatic_uploads: true,
		/*
			URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
			images_upload_url: 'postAcceptor.php',
			here we add custom filepicker only to Image dialog
		*/
		file_picker_types: 'image',
		/* and here's our custom image picker*/
		file_picker_callback: function (cb, value, meta) {
			var input = document.createElement('input');
			input.setAttribute('type', 'file');
			input.setAttribute('accept', 'image/*');

			/*
			Note: In modern browsers input[type="file"] is functional without
			even adding it to the DOM, but that might not be the case in some older
			or quirky browsers like IE, so you might want to add it to the DOM
			just in case, and visually hide it. And do not forget do remove it
			once you do not need it anymore.
			*/

			input.onchange = function () {
			var file = this.files[0];

			var reader = new FileReader();
			reader.onload = function () {
				/*
				Note: Now we need to register the blob in TinyMCEs image blob
				registry. In the next release this part hopefully won't be
				necessary, as we are looking to handle it internally.
				*/
				var id = 'blobid' + (new Date()).getTime();
				var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
				var base64 = reader.result.split(',')[1];
				var blobInfo = blobCache.create(id, file, base64);
				blobCache.add(blobInfo);

				/* call the callback and populate the Title field with the file name */
				cb(blobInfo.blobUri(), { title: file.name });
			};
			reader.readAsDataURL(file);
			};

			input.click();
		}
	});

</script>

<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h5 class="float-xs-left"><?= $title_for_layout; ?></h5>
	</div>
    <?= $this->Form->create($pages,['type'=>'file','novalidate'=>true]) ?>
    <fieldset>
		<div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->control('parent_id', ['options'=>$parents,'empty'=>true]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php echo $this->Form->control('menu'); ?>
			</div>
			<div class="col-md-6">
				<?php echo $this->Form->control('slug',['readonly'=>true]); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->control('page_title'); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('page_heading'); ?>
			</div>
			<div class="col-md-4">
				<?php echo $this->Form->control('keywords'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->Form->input('description', ['type' =>'textarea', 'placeholder'=> 'Description','rows' => '10', 'cols' => '20']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->Form->input('meta_tags', ['type' => 'textarea','placeholder'=> 'Meta Tags','rows' => '10', 'cols' => '20']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo $this->Form->control('layout'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php echo $this->Form->control('hidden'); ?>
			</div>
		</div>
	</fieldset><br>
	<fieldset>
		<div class="tabs-example">
			  <div class="tabs-box-example horizontal-tab-example">
				 <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
					<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Body</a>
					</li>
					<?php if($pages->isNew()==false) { ?>
					<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Section</a>
					<?php }?>
					</li>
				</ul>
				<div class="tab-content checkout">
					<div class="tab-pane fade in active col-md-12" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
						<?= $this->Form->input('body', ['type' =>'textarea', 'class'=>'summernote', 'placeholder'=> 'Content','rows' => '10', 'cols' => '20']); ?>
					</div><hr>
					<div class="tab-pane fade in" id="tab_2" role="tabpanel" aria-labelledby="tab_2">
						<div class="form-group pull-right">
							<?= $this->Html->link('Add Section',['controller'=>'Sections','action'=>'edit',0,$pages->id],['class'=>'btn btn-primary btn-sm']);?>
						</div><hr>
						<div class="form-group ">
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col"><?= $this->Paginator->sort('section')?></th>
										<th scope="col" width="15%"><?= $this->Paginator->sort('Actions') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($pages['sections'] as $i => $page): //debug($page);exit; ?>
									<tr>
										<td><?= $page->section?></td>
										<td class="actions">
											<?= $this->N->editLink(['controller'=>'Sections','action' => 'edit',$page->id,$pages->id]); ?>
											<?= $this->N->deleteLink(['controller'=>'Sections','action' => 'delete',$page->id]); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<div class="row pull-right">
			<div class="col-md-12">
				<?= $this->N->cancelLink(['action'=>'index']); ?>
				<button class="btn btn-primary">Save</button>
			</div>
		</div>
	</fieldset><br>
</div>


