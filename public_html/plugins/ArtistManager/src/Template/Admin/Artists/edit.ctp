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
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($artist, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
                echo $this->Form->control('name',['class' => 'form-control', 'placeholder' => __('Name')]);
            echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
            echo $this->Form->control('groups._ids', ['options' => $groups]);
        ?>
</div>
</div>
    </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> ".__('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>
    <?= $this->Form->end() ?>
</div>
        </section>
