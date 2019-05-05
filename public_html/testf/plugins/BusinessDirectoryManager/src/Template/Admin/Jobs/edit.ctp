<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $job
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Job'); ?> <small>
            <?php echo empty($job->id) ? __('Add New job') : __('Edit job'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="jobs">
    <div class="box box-info jobs">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($job->id) ? 'Add Job' : 'Edit Job') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
            <?php
            $this->loadHelper('Form', [
                'templates' => 'default_form',
            ]);
            ?>
    <?= $this->Form->create($job, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
            <?php
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('listing_id', ['options' => $listings,'class' => 'form-control']);
                    echo $this->Form->control('job_title',['class' => 'form-control', 'placeholder' => __('Job Title')]);
                    echo $this->Form->control('designation',['class' => 'form-control', 'placeholder' => __('Designation')]);
                    echo $this->Form->control('vacancy',['class' => 'form-control', 'placeholder' => __('Vacancy')]);
                    echo $this->Form->control('experience',['class' => 'form-control', 'placeholder' => __('Experience')]);
                    echo $this->Form->control('qualification',['class' => 'form-control', 'placeholder' => __('Qualification')]);
                    echo $this->Form->control('salary_min',['class' => 'form-control', 'placeholder' => __('Salary Min')]);
                    echo $this->Form->control('salary_max',['class' => 'form-control', 'placeholder' => __('Salary Max')]);
                    echo $this->Form->control('job_end',['class' => 'form-control', 'placeholder' => __('Job End')]);
                    echo $this->Form->control('job_summary',['class' => 'form-control', 'placeholder' => __('Job Summary')]);
                    echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
                    echo $this->Form->control('job_time',['class' => 'form-control', 'placeholder' => __('Job Time')]);
                    echo $this->Form->control('job_type',['class' => 'form-control', 'placeholder' => __('Job Type')]);
                    echo $this->Form->control('job_for',['class' => 'form-control', 'placeholder' => __('Job For')]);
                    echo $this->Form->control('position_type',['class' => 'form-control', 'placeholder' => __('Position Type')]);
                    echo $this->Form->control('is_featured',['class' => 'form-control', 'placeholder' => __('Is Featured')]);
                    echo $this->Form->control('locations._ids', ['options' => $locations]);
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
