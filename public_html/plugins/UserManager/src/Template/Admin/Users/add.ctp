<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage User'); ?> <small>
            <?php echo empty($user->id) ? __('Add New user') : __('Edit user'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="users">
    <div class="box box-info users">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($user->id) ? 'Add User' : 'Edit User') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);

        ?>
        <?= $this->Form->create($user, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $this->Form->control('first_name', ['class' => 'form-control', 'placeholder' => __('First Name')]); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->control('last_name', ['class' => 'form-control', 'placeholder' => __('Last Name')]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email')]); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->control('dob', ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'YYYY-mm-dd', 'label' => ['text' => "Date Of Birth"], 'readonly' => true]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']); ?>
                    <?php echo $this->Form->control('account_types._ids', ['options' => $accountTypes, 'class' => 'form-control']); ?>
                </div>
                <div class="col-md-6">
                    <div class="row imageBox" id="imageBox-0">
                            <label class="col-md-12 control-label" for="image">Profile Photo</label>
                            <div class="col-md-8">
                                <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                    <?php 
									echo $this->Glide->image(($user->profile_photo != '' ? $user->profile_photo : 'no_image.gif'), ['w'=>'150', 'h'=>'150'], ['style'=>'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                </a>
                                <?php echo $this->Form->control('profile_photo', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                            </div>
                        </div>
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
$this->Html->script(['GalleryManager.common'], ['block' => true]);
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);

?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    $('.datepicker').datetimepicker({
        minView: 2,
        format: 'yyyy-mm-dd',
        'showTimepicker': false,
        autoclose: true,
        endDate: "+0d"
    });
<?php $this->Html->scriptEnd(); ?>
</script>	