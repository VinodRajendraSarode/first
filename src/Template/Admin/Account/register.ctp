<div class="login-logo">
        <a href="https://apt-resources.com" target="_blank">
          <img src="https://www.apt-resources.com/dist/img/logo.jpg" class="img-responsive"  alt="Welcome to My Dominion 2" style="margin-left: auto;margin-right: auto;display: block;"></a>
        </a>
      </div>

      <p style="font-weight: bold;text-align: center;font-size: 20px"> Create Your Account Here</p>

       <?= $this->Form->create($companies,['novalidate'=>true]); ?>
        <div class="form-group col-xs-12 has-feedback" >
            <?php echo $this->Form->input('company_name', ['placeholder'=>'Company Name *','label'=>false]); ?>
         </div><br>
         <div class="form-group col-xs-12 has-feedback" >
            <?php echo $this->Form->input('name', ['placeholder'=>'Name *','label'=>false]); ?>
         </div><br>
         <div class="form-group has-feedback col-xs-12">
            <?php echo $this->Form->input('email', ['placeholder'=>'Company Email *','label'=>false]); ?>
          </div>
          <div class="form-group has-feedback col-xs-12">
            <?php echo $this->Form->input('mobile', ['placeholder'=>'Mobile *', 'label'=>false]); ?>
          </div>
          <div class="form-group has-feedback col-xs-12">
            <?php echo $this->Form->input('city', ['placeholder'=>'City','label'=>false]); ?>
          </div>
          <div class="form-group has-feedback col-xs-12">
            <?php echo $this->Form->input('no_of_employees', ['type'=>'text', 'placeholder'=>'No of Employees','label'=>false]); ?>
          </div>
          
          <!--<div class="form-group has-feedback col-xs-12">
            <select class="form-control" name="refered_by" >
              <option value=" ">How do you came to know about this course?</option>
              <option value="Facebook">Facebook</option>
              <option value="Twitter">Twitter</option>
              <option value="Whatsapp">Whatsapp</option>
              <option value="Google">Google</option>
              <option value="Reference">Free PF Demo</option>
              <option value="Others">Others</option>
            </select>
         </div>-->
         <div class="col-xs-12"><br>
          <button type="submit" class="btn btn-primary btn-block btn-flat"> Create New Account </button>
          <span class="ajax-loader">
            <img class="img_class"  src="https://www.apt-resources.com/dist/img/loader.gif" style="width:32px" style=" display: block;margin:0 auto; ">
          </span>
         </div>
      <?= $this->Form->end() ?>


