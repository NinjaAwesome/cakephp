
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
    <?= $this->Form->create($interview, ['role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'FormPostJobs','novalidate' => TRUE,]) ?>
        <div class="jobSeekers form large-9 medium-8 columns content form-group">
            <div id='divJobSeekerError' class="alert alert-danger" style="display:none;" >please correct all <strong>highlighted errors </strong> and try again.
    </div>
    <div class="alert alert-success"  id='divJobSeekerSuccess' style="display:none;">
        data has been saved <strong>Success fully!</strong> 
    </div>
   <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php  echo "<span > <b>Name </b> </span> "; echo "<span class = 'form-control'>$jobSeekers->first_name  $jobSeekers->last_name </span> ";   ?>                 
                                            </div>
                                            <div class="col-md-6">
                                                <?php   echo "<span ><b>Email </b></span> ";
               echo "<span class = 'form-control'>$jobSeekers->email </span> ";  ?>
                                            </div>
                                        </div>
           
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo $this->Form->control('status',['options'=>[1 => "pending", 2 => "In progress", 3 => "Confirm schedule", 4 => "Reschedule", 5 => "Selected", 6 => "Rejected from hr end", 7 => "Rejected from interview end", 8 => "Cancel from employee end", 9 => "Hold"],'empty' =>'Select Status','class' => 'form-control']); ?>                 
                                            </div>
                                            <div class="col-md-6">
                                                <?php   echo $this->Form->control('interview_date', ['type' => 'text', 'readonly' =>true, 'class' => 'form-control datepicker', 'placeholder' => 'Interview Date', 'label' => ['text' => "Interview Date"] ]); 
      ?>
                                            </div>
                                        </div>
       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php   echo $this->Form->control('interview_time_from',['id' => 'interview_time_from','type' => 'text','class' => 'form-control', 'placeholder' => __('Interview Time From')]);  ?>                 
                                            </div>
                                            <div class="col-md-6">
                                           <?php  echo $this->Form->control('interview_time_to',['id' => 'interview_time_to','type' => 'text','class' => 'form-control', 'placeholder' => __('Interview Time To')]);?>
                                            </div>
                                        </div>
       
                                           
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php  echo $this->Form->control('interviewer_name',['class' => 'form-control', 'placeholder' => __('Interviewer Name'), 'lable' => 'Interviewer Name']); ?>                 
                                            </div>
                                            <div class="col-md-6">
                                           <?php  echo $this->Form->control('comments',['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Comments')]);?>
                                            </div>
                                        </div>
           
    </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> ".__('Submit'), ['class' => 'btn btn-primary btn-flat','id' => 'submitBtn', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'),'escape'=>false]); ?>
         
     
         
     </div>
    </div>
    
        </section>

<script>



    var start = new Date();
    var interview_end = new Date(new Date().setYear(start.getFullYear() + 6));
    // set end date to max one year period:
    var end = new Date(new Date().setYear(start.getFullYear() + 1));

    $('.datepicker').datetimepicker({
        startDate: start,
        endDate: '+<?php echo $daysCount; ?>d',
        datesDisabled: '+<?php echo $daysCount; ?>d',
        minView: 2,
        format: 'yyyy-mm-dd',
        showTimepicker: false,
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
 $(document).ready(function() {
    $('#interview_time_from').timepicker(); 
    $('#interview_time_to').timepicker();
});

</script>  
