<script>
    $(document).ready(function() {
        $("#btn-register").prop("disabled", true);
        $("#i-agree").on("change", function() {
            
            if($('#i-agree').prop('checked')) {
                $("#btn-register").prop("disabled", false);
            } else {
                $("#btn-register").prop("disabled", true);
            }
        });
    });
</script>

<div class="box_account">
    <h3 class="new_client">New Client</h3> <small class="float-right pt-2">* Required Fields</small>
    <div class="form_container">

        <?= $this->Form->create($users,['controller'=>'Members','action' => 'register','novalidate'=>true]); ?>
        <div class="private box">
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="form-group">     
                        <?php echo $this->Form->input('name', ['placeholder'=>'Name *','label'=>false]); ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                    <?php echo $this->Form->input('email', ['placeholder'=>'Email *','label'=>false]); ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                    <?php echo $this->Form->input('mobile', ['placeholder'=>'Mobile *', 'label'=>false]); ?>
                    </div>
                </div>               

            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="container_check" ><span class="ml-3">Accept <a href="/terms-and-conditions" target="_blank">Terms and conditions</span></a>
            <input type="checkbox" id="i-agree">
            <span class="checkmark"></span>
            </label>
        </div>
        <div class="text-center"><input id="btn-register" type="submit" value="Register" class="btn_1 full-width"></div>
        <div class="col-12">
            <div class="form-group">
                Already Registered 
                <?php echo $this->Html->link('<span class="underline">Click here to login ?</span>', ['controller'=>'Members', 'action'=>'login'], ['class'=>'text-black', 'escape'=>false]); ?>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
    <!-- /form_container -->
</div>
<!-- /box_account -->
