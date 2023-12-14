<div class="login-logo">
  <!--<a>
    <img src="http://www.apt-resources.com/dist/img/logo.jpg" class="img-responsive"  alt="Apt Resources" style="margin-left: auto;margin-right: auto;display: block;"></a>
  </a>-->
</div>
<p style="font-weight: bold;text-align: center;font-size: 20px"> Create Password</p>
<?= $this->Form->create(null,['novalidate'=>true]) ?>
  <div class="form-group">
        <?php //echo $this->Form->hidden('id');?>
        <?php echo $this->Form->input('email',array('class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Email'));?>
        <?php //echo $this->Form->input('mobile',array('class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Mobile'));?>
      </div>
      <div class="px-2 form-group mb-0">
        <button type="submit" class="btn btn-danger btn-block text-uppercase">Continue</button>
      </div>
      <span class="ajax-loader">
        <img class="img_class"  src="" style="width:32px" style=" display: block;margin:0 auto; ">
      </span>
      </div>
<?= $this->Form->end() ?>



