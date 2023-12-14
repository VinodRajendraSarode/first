<div class="box box-block bg-white p-3">
    <?= $title_for_layout ?>
    <?= $this->Form->create($subscription, ['novalidation'=>true, 'type'=>'text']) ?>
    <div class="row">
        <div class="col-md-4">
            <?= $this->Form->control('package_id') ?>
        </div>               
        
    </div>
    <div class="row pull-right">
        <div class="col-md-12">
            <?= $this->N->cancelLink(['action'=>'index']); ?>
            <button class="btn btn-primary">Save</button>
        </div>
    </div>	
    <?= $this->Form->end() ?>

</div>