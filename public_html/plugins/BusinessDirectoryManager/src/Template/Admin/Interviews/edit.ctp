<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $interview
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Interview'); ?> <small>
            <?php echo empty($interview->id) ? __('Add New interview') : __('Edit interview'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="interviews">
    <div class="box box-info interviews">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($interview->id) ? 'Add Interview' : 'Edit Interview') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div><!-- /.box-header -->
    <?php
    $this->loadHelper('Form', [
        'templates' => 'default_form',
    ]);
    ?>
    <?= $this->Form->create($interview, ['role' => 'form', 'enctype' => 'multipart/form-data','id' => 'FormPostjob']) ?>
         <div class="jobSeekers form large-9 medium-8 columns content form-group">
              <div id='divJobSeekerError' class="alert alert-danger" style="display:none;" >please correct all <strong>highlighted errors </strong> and try again.
    </div>
    <div class="alert alert-success"  id='divJobSeekerSuccess' style="display:none;">
        data has been saved <strong>Success fully!</strong> 
    </div>
   <div class="box-body">
       <div class="row">
                <div class="col-md-12">
<?php
            echo $this->Form->control('job_seeker_id', ['options' => $jobSeekers,'class' => 'form-control']);
                echo $this->Form->control('interviewer_name',['class' => 'form-control', 'placeholder' => __('Interviewer Name')]);
                echo $this->Form->control('interview_date',['class' => 'form-control', 'placeholder' => __('Interview Date')]);
                echo $this->Form->control('interview_time_from',['class' => 'form-control', 'placeholder' => __('Interview Time From')]);
                echo $this->Form->control('interview_time_to',['class' => 'form-control', 'placeholder' => __('Interview Time To')]);
            echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']);
                echo $this->Form->control('reshedule_count',['class' => 'form-control', 'placeholder' => __('Reshedule Count')]);
                echo $this->Form->control('comments',['class' => 'form-control', 'placeholder' => __('Comments')]);
        ?>
</div>
</div>
    </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> ".__('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>
         </div>
    <?= $this->Form->end() ?>
</div>
        </section>

<script>
     var start = new Date();
    // set end date to max one year period:
    var end = new Date(new Date().setYear(start.getFullYear() + 1));

    $('.datepicker').datetimepicker({
       // startDate: start,
        minView: 2,
        format: 'yyyy-mm-dd',
        'showTimepicker': false,
        autoclose: true
      //  ,        endDate: "+0d"
    });



    $('#start-date').datepicker({
        startDate: start,
        endDate: end,
        format: 'yyyy-mm-dd',
        autoclose: true
                // update "toDate" defaults whenever "fromDate" changes
    }).on('changeDate', function () {
        // set the "toDa te " start to not be later than "fromDate" ends:
        $('#end-date').datepicker('setStartDate', new Date($(this).val()));
    });

    $('#end-date').datepicker({
        startDate: start,
        endDate: end,
        format: 'yyyy-mm-dd',
        autoclose: true
                // update "fromDate" defaults whenever "toDate" changes
    }).on('changeDate', function () {
        // set the "fromDate" end to not be later than  "t oDate" starts:
        $('#start-date').datepicker('setEndDate', new Date($(this).val()));
    });
    
    </script>
