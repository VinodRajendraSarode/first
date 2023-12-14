<?= $this->Form->create($user,['novalidate'=>true]) ?>
<section class="account-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-9 mx-auto">
                  <div class="row no-gutters">
                     <div class="col-md-2"></div>
                     <div class="col-md-8">
                        <div class="card card-body account-right">
                           <div class="widget">
                              <div class="section-header">
                                 <h5 class="heading-design-h5">
                                    Reset Password
                                 </h5>
                              </div>
                              <form class="login_form row">
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
									   <?php
											echo $this->Form->hidden('id');
											echo $this->Form->input('password', ['type'=>'password']);
											echo $this->Form->input('verify_password', ['type'=>'password']);
										?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12 text-right">
										<button class="btn btn-info">Reset</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2"></div>
                  </div>
               </div>
            </div>
         </div>
      </section>
<?= $this->Form->end() ?>

