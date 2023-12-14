<div class="box_account">
   <h3 class="client">Reset your password</h3>
      <div class="form_container">
      <?= $this->Form->create($user,['novalidate'=>true]) ?>
            <div class="form-group">
               <?php
                  echo $this->Form->hidden('id');
                  echo $this->Form->input('password', ['type'=>'password']);
                  echo $this->Form->input('verify_password', ['type'=>'password']);
               ?>
            </div>
            <div class="text-center"><input type="submit" value="Reset" class="btn_1 full-width"></div>
         <?php echo $this->Form->end();?>
      </div>
</div>

