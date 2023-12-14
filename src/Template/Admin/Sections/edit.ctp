<?php //echo $this->Html->script('ckeditor/ckeditor', ['block' => 'script']); ?>
<script>
	//CKEDITOR.replace('contents');
	tinymce.init({
		selector: 'textarea#contents',  // change this value according to your HTML
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
<?php echo $this->Html->script('tinymce/tinymce.min', ['block' => 'script']); ?>

<div class="box box-block bg-white">
	<div class="clearfix mb-1">
		<h5 class="float-xs-left"><?= $title_for_layout; ?></h5>
	</div>
   <?= $this->Form->create($sections,['type'=>'file','novalidate'=>true]) ?> 
	<fieldset>
        	<div class="row">
				<div class="col-md-6">
					<?php echo $this->Form->hidden('id'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?= $this->Form->input('section'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Form->control('contents', ['type' => 'textarea', 'label' => 'Content', 'placeholder'=> 'Content', 'escape' => false,'class' =>'comment', 'rows' => '10', 'cols' => '20','class'=>'summernote']); ?>
				</div>
			</div><br>
	</fieldset></br>

	<fieldset>
		<div class="row pull-right">
			<div class="col-md-12">
				<?= $this->N->cancelLink(['action'=>'index']); ?>
				<button class="btn btn-primary">Save</button>
			</div>
		</div>	
	</fieldset><br>
</div>

