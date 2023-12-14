

<div class="row">
    <div class="col-md-8">
        <?php echo $this->Form->create(null, ['class'=>'form-inline','valueSources' => 'query','id'=>'SearchForm']); ?>
        <?php echo $this->Form->input('search',['placeholder'=>'Name','label'=>false]); ?>		
        <?php echo $this->Form->button('Search', ['class'=>'btn btn-bordered-info']); ?>
        <?php echo $this->Html->link('Reset', ['action' => 'index'],['class'=>'btn btn-bordered-info']); ?>
        <?php echo $this->Form->end(); ?>    
       <script>
            $(document).ready(function(){
                $("#SearchForm").one("submit", function(e) {
                    e.preventDefault();
                    $.post('/admin/members', $('#SearchForm').serialize()).done(function(data){
                        $("#ajaxDiv").empty().append(data);					
                    });;
                });
            });
	    </script>
    </div>
    <div class="col-md-4">
        <div class="pull-right">
            <?= $this->S->new(array('action'=>'edit')); ?>
        </div>
    </div>
</div><br>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col" class="actions" width="15%"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member): //debug($members);exit; ?>
            <tr>
				<td><?= h($member->name) ?></td>
                <td><?= h($member->user->mobile) ?></td>
                <td><?= h($member->user->email) ?></td>
                <td class="actions">
                    <?= $this->S->edit(['action' => 'edit', $member->id]); ?>
                    <?= $this->S->delete(['action' => 'delete', $member->id]); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php echo $this->element('Seipkon.pagination'); ?>
