<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $artistsGroup
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Artists Group'); ?> <small>
            <?php echo empty($artistsGroup->id) ? __('Add New artists group') : __('Edit artists group'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="artistsGroups">
    <div class="box box-info artistsGroups">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($artistsGroup->id) ? 'Add Artists Group' : 'Edit Artists Group') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($artistsGroup, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
            echo $this->Form->control('artist_id', ['options' => $artists,'class' => 'form-control']);
            echo $this->Form->control('group_id', ['options' => $groups,'class' => 'form-control']);
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
