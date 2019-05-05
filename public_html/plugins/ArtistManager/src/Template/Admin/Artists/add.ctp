<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $artist
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Artist'); ?> <small>
            <?php echo empty($artist->id) ? __('Add New artist') : __('Edit artist'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="artists">
    <div class="box box-info artists">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($artist->id) ? 'Add Artist' : 'Edit Artist') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'horizontal_form',
        ]);
        ?>
        <?= $this->Form->create($artist, ['novalidate' => true,'role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    //pr($artist->groups);die;
                    echo $this->Form->control('name', ['class' => 'form-control', 'placeholder' => __('Name')]);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                    //echo $this->Form->control('groups._ids', ['options' => $groups, 'class' => 'form-control',]);
                    $i = 1;
                    if(empty($artist->id)){
                        //echo $this->Form->control('groups.0.name', ['id' => 'name_1', 'class' => 'form-control', 'placeholder' => __('Nick Names'),'label'=>__('Nick Names')]);
                    }else{
                        if($artist->groups){ 
                            $i = 1;
                            foreach ($artist->groups as $key => $group){
                                echo $this->Form->control('groups.'.$key.'.name', ['id' => 'name_'.$key, 'class' => 'form-control', 'placeholder' => __('Nick Names'),'label'=>__('Nick Names'.$i),'value' => $group->name]);
                                echo $this->Form->control('groups.'.$key.'.id', ['type'=>'hidden', 'id' => 'id_'.$key, 'class' => 'form-control', 'placeholder' => __('Nick Names'),'label'=>__('Nick Names'),'value' => $group->id]);
                                $i++;
                                echo '<div class="clearfix"></div>';
                            }
                        }else{
                            //echo $this->Form->control('groups.0.name', ['id' => 'name_1', 'class' => 'form-control', 'placeholder' => __('Nick Names'),'label'=>__('Nick Names')]);
                        }
                    }
                    ?>
                    <div class="clearfix"></div>
                    <div id="append_nickname">
                        
                    </div>
                    <?php if($i < 6){ ?>
                    <a href="javascript:void(0);" class="add_button pull-right" title="Add field">
                        <i class="fa fa-plus"></i> <?= __('Add More') ?>
                    </a>
                    <?php } ?>
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
<?php
$inputCount = 5;
$j = $i-1; 
if($i != 1){
    $inputCount = 6-$i;
}

?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function(){
    var maxField = <?= $inputCount+$j ?>; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('#append_nickname'); //Input field wrapper
    var x = <?= $j ?>; //Initial field counter is 1
     //New input field html 
    
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            
            var fieldHTML = '<div class="form-group input text">\n\
<div class="row">\n\
<label class="col-md-2 control-label" for="name">Nick Names <a href="javascript:void(0);" class="remove_button"><i class="fa fa-close"></i></a></label>\n\
<div class="col-md-8">\n\
<input type="text" name="groups['+x+'][name]" class="form-control form-error" placeholder="Nick Names" required="required" maxlength="255" id="name_'+x+'" value=""></div>\n\
<div class="col-md-offset-2 col-md-8 error-message text-danger"></div>\n\
</div>\n\
</div>';
    x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }else{
            alert('Maximum number of input fields 5')
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