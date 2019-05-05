<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $location
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Location'); ?> <small>
            <?php echo empty($location->id) ? __('Add New location') : __('Edit location'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="locations">
    <div class="box box-info locations">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($location->id) ? 'Add Location' : 'Edit Location') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($location, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
            echo $this->Form->control('parent_id', ['options' => $parentLocations,'class' => 'form-control']);
                echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
                echo $this->Form->control('latitude',['class' => 'form-control', 'placeholder' => __('Latitude')]);
                echo $this->Form->control('longitude',['class' => 'form-control', 'placeholder' => __('Longitude')]);
                echo $this->Form->control('iso_alpha2_code',['class' => 'form-control', 'placeholder' => __('Iso Alpha2 Code')]);
                echo $this->Form->control('iso_alpha3_code',['class' => 'form-control', 'placeholder' => __('Iso Alpha3 Code')]);
                echo $this->Form->control('iso_numeric_code',['class' => 'form-control', 'placeholder' => __('Iso Numeric Code')]);
                echo $this->Form->control('formatted_address',['class' => 'form-control', 'placeholder' => __('Formatted Address')]);
                echo $this->Form->control('meta_title',['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                echo $this->Form->control('meta_keyword',['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                echo $this->Form->control('meta_description',['class' => 'form-control', 'placeholder' => __('Meta Description')]);
            echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
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
