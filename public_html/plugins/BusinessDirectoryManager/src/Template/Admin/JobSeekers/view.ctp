<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $jobSeeker
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Job Seeker'); ?>  <small>Job Seeker Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="jobSeekers">
<div class="jobSeekers box">
    <div class="box-header">
            <h3 class="box-title"><?= h($jobSeeker->first_name.' '.$jobSeeker->last_name) ?></h3>
            <?php //= $this->Html->link("<i class=\"glyphicon glyphicon-ok-circle\"></i>", ['plugin' => 'BusinessDirectoryManager','controller' => 'Interviews','action' => 'add', $jobSeeker->id], ['class' => 'btn btn-primary btn-sm btn-flat ', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Select For Interview'),'title'=>__('Select For Interview')]) ?>
      
        
                <?php 
              if(!$jobSeeker->schedule_status)
                echo $this->Html->link("<i class='glyphicon glyphicon-ok-circle'></i> ".__('Select For Interview'), ['plugin' => 'BusinessDirectoryManager','controller' => 'Interviews','action' => 'add', $jobSeeker->id], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
                                   
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Job') ?></th>
            <td><?= $jobSeeker->has('job') ? $this->Html->link( $jobSeeker->job->job_title, ['controller' => 'Jobs', 'action' => 'view', $jobSeeker->job->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($jobSeeker->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($jobSeeker->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($jobSeeker->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($jobSeeker->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attachment') ?></th>
            <td><?= ($jobSeeker->attachment!=null) ?$this->Html->link("Download",['controller'=>'JobSeekers','action'=>'download',$jobSeeker['id'],'plugin'=>'BusinessDirectoryManager', 'prefix'=>'admin'],['class'=>'btn_border gray view_btn']) : __('Null')?></td>
        </tr>
       
        
        
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?php echo $jobSeeker->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);?>
             </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>            
             <td><?php echo $jobSeeker->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']); ?></td>
        </tr>
    </table>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Message') ?></h4>
        <span class='valuecol'>  <?= $this->Text->autoParagraph(h($jobSeeker->message)); ?> </span>
    </div>
        
    </div>
    </div>

</div>
</section>
