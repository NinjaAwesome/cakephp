<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Event'); ?> <small>
            <?php echo empty($event->id) ? __('Add New event') : __('Edit event'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="events">
    <div class="box box-info events">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($event->id) ? 'Add Event' : 'Edit Event') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($event, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-control']);
                echo $this->Form->control('title',['class' => 'form-control', 'placeholder' => __('Title')]);
                echo $this->Form->control('short_description',['class' => 'form-control', 'placeholder' => __('Short Description')]);
                echo $this->Form->control('description',['class' => 'form-control', 'placeholder' => __('Description')]);
                echo $this->Form->control('location',['class' => 'form-control', 'placeholder' => __('Location')]);
                echo $this->Form->control('organizar_name',['class' => 'form-control', 'placeholder' => __('Organizar Name')]);
                echo $this->Form->control('organizer_email',['class' => 'form-control', 'placeholder' => __('Organizer Email')]);
                echo $this->Form->control('banner_image',['class' => 'form-control', 'placeholder' => __('Banner Image')]);
                echo $this->Form->control('amount',['class' => 'form-control', 'placeholder' => __('Amount')]);
                echo $this->Form->control('max_participants',['class' => 'form-control', 'placeholder' => __('Max Participants')]);
                echo $this->Form->control('start_date',['class' => 'form-control', 'placeholder' => __('Start Date')]);
                echo $this->Form->control('end_date',['class' => 'form-control', 'placeholder' => __('End Date')]);
                echo $this->Form->control('meta_title',['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                echo $this->Form->control('meta_keyword',['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                echo $this->Form->control('meta_description',['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                echo $this->Form->control('is_join',['class' => 'form-control', 'placeholder' => __('Is Join')]);
                echo $this->Form->control('is_register',['class' => 'form-control', 'placeholder' => __('Is Register')]);
                echo $this->Form->control('is_paid',['class' => 'form-control', 'placeholder' => __('Is Paid')]);
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
