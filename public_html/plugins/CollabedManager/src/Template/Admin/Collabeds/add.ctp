<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $collabed
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Collabed'); ?> <small>
            <?php echo empty($collabed->id) ? __('Add New collabed') : __('Edit collabed'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="collabeds">
    <div class="box box-info collabeds">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($collabed->id) ? 'Add Collabed' : 'Edit Collabed') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'horizontal_form',
        ]);
        ?>
        <?= $this->Form->create($collabed, ['novalidate' => true,'role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    echo $this->Form->control('artist_id_1', ['class' => 'form-control', 'placeholder' => __('Artist 1'), 'label' => __('Artist 1')]);
                    echo $this->Form->control('artist_id_2', ['class' => 'form-control', 'placeholder' => __('Artist 2'), 'label' => __('Artist 2')]);
                    echo $this->Form->control('banner_id', ['options' => $banners, 'empty' => 'Select Banner', 'class' => 'form-control']);
                    echo $this->Form->control('image_file', ['type' => 'file', 'class' => 'form-control', 'placeholder' => __('Image')]);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                    ?>
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
