<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $group
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Group'); ?> <small>
            <?php echo empty($group->id) ? __('Add New group') : __('Edit group'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="groups">
    <div class="box box-info groups">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($group->id) ? 'Add Group' : 'Edit Group') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'horizontal_form',
        ]);
        ?>
        <?= $this->Form->create($group, ['role' => 'form', 'enctype' => 'multipart/form-data','novalidate' => true,]) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    echo $this->Form->control('artist_id', ['options' => $artists, 'empty'=>'-Select Artist-', 'class' => 'form-control']);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                    echo $this->Form->control('name[]', ['id' => 'name_1', 'class' => 'form-control', 'placeholder' => __('Nick Name 1'),'label'=>__('Nick Name 1')]);
                    
                    ?>
                    <div id="append_nickname">
                        
                    </div>
                    <a href="javascript:void(0);" class="add_button pull-right" title="Add field">
                        <i class="fa fa-plus"></i> <?= __('Add More') ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</section>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('#append_nickname'); //Input field wrapper
    var x = 1; //Initial field counter is 1
     //New input field html 
    
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            var fieldHTML = '<div class="form-group input text">\n\
<div class="row">\n\
<label class="col-md-2 control-label" for="name">Nick Name '+x+' <a href="javascript:void(0);" class="remove_button"><i class="fa fa-close"></i></a></label>\n\
<div class="col-md-8">\n\
<input type="text" name="name[]" class="form-control form-error" placeholder="Nick Name '+x+'" required="required" maxlength="255" id="name_'+x+'" value=""></div>\n\
<div class="col-md-offset-2 col-md-8 error-message text-danger"></div>\n\
</div>\n\
</div>';
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('label').parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
<?php $this->Html->scriptEnd(); ?>
</script>