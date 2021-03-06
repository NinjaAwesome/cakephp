<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $jobSeeker
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Job Seeker'); ?> <small>
            <?php echo empty($jobSeeker->id) ? __('Add New job seeker') : __('Edit job seeker'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="jobSeekers">
    <div class="box box-info jobSeekers">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($jobSeeker->id) ? 'Add Job Seeker' : 'Edit Job Seeker') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($jobSeeker, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
            echo $this->Form->control('job_id', ['options' => $jobs,'class' => 'form-control']);
                echo $this->Form->control('first_name',['class' => 'form-control', 'placeholder' => __('First Name')]);
                echo $this->Form->control('last_name',['class' => 'form-control', 'placeholder' => __('Last Name')]);
                echo $this->Form->control('email',['class' => 'form-control', 'placeholder' => __('Email')]);
                echo $this->Form->control('mobile',['class' => 'form-control', 'placeholder' => __('Mobile')]);
                echo $this->Form->control('message',['class' => 'form-control', 'placeholder' => __('Message')]);
                echo $this->Form->control('attachment',['class' => 'form-control', 'placeholder' => __('Attachment')]);
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
