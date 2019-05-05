<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
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


<!-- Main content -->
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
    <?= $this->Form->create($job, ['role' => 'form', 'enctype' => 'multipart/form-data','novalidate' => True]) ?>
     <div class="box-body">            
            <div class="row">
                <div class="col-xs-12">
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="tabA active"><a href="#tab-a" data-toggle="tab">General </a></li>
                        <li class="tabB"><a href="#tab-b" data-toggle="tab">Details</a></li>
                      </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-a">
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <?php echo $this->Form->control('job_title',['class' => 'form-control', 'placeholder' => __('Job Title')]); ?>
                                            </div>
                                            <div class="col-md-6">
                                                 <?php  echo $this->Form->control('vacancy',['min' =>"0",'class' => 'form-control', 'placeholder' => __('Vacancy')]); ?>
                                            </div>
                                        </div>

                                        <div class="row">                
                                            <div class="col-md-6">
                                                <?php   echo $this->Form->control('salary_min',['step' =>"100",'min' =>"0",'class' => 'form-control', 'placeholder' => __('Salary Min')]); ?>
                                            </div> 

                                            <div class="col-md-6">
                                                <?php   echo $this->Form->control('salary_max',['step' =>"100",'min' =>"0",'class' => 'form-control', 'placeholder' => __('Salary Max')]); ?>
                                            </div>
                                        </div>            

                                        <div class="row">
                                             <div class="col-md-6">                        
                                                 <?php echo $this->Form->control('job_end', ['type' => 'text', 'readonly' =>true, 'class' => 'form-control datepicker', 'placeholder' => 'Job End Date', 'label' => ['text' => "Job End Date"] ]); 
                                                 ?>
                                            </div>

                                            <div class="col-md-6">
                                                <?php echo $this->Form->control('job_time',['type' => 'text','id' => 'job_time','class' => 'form-control', 'placeholder' => __('Office Time'), 'label' => ['text' => "Office Time"]]); ?>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                 <?php   //echo $this->Form->control('job_type',['class' => 'form-control', 'placeholder' => __('Job Type')]); ?>
                                                  <?php   echo $this->Form->control('job_type',['options'=>[0 => "Full Time", 1 => "Part Time", 2 => "Internship", 3 => "Contract", 4 => "Volunteer"],'class' => 'form-control']);?>
                                                 
                                                 
                                            </div> 
                                            <div class="col-md-6">
                                                <?php  // echo $this->Form->control('job_for',['class' => 'form-control', 'placeholder' => __('Job For')]); ?>

                                                <?php   echo $this->Form->control('job_for',['options'=>[1 => "Male", 0 => "Female", 2 => "Both"],'class' => 'form-control']); ?>
                                            </div> 
                                        </div>
                                        <div class="row">
                                             <div class="col-md-6">
                                                    <?php   echo $this->Form->control('job_summary',['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Job Summary')]); ?>
                                            </div>
                                           
                                                 <?php // echo  <div class="col-md-6">
                                                 //$this->Form->control('job_end',['class' => 'form-control', 'placeholder' => __('Job End')]); 
                                                 // ?>

                                           
                                             <div class="col-md-6">
                                                <?php  echo $this->Form->control('status',['options'=>[1 => "Active", 0 => "Inactive"],'class' => 'form-control']); ?>
                                            </div>
                                            <div class="col-md-6">                        
                                                 <?php // echo $this->Form->control('job_end',['class' => 'form-control datepicker', 'placeholder' => __('Job End')]); ?>
                                            </div>                                      
                                        </div>
                            </div>                           
                            <div class="tab-pane" id="tab-b">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php  echo $this->Form->control('user_id', ['options' => $users, 'empty' => "Select User", 'class' => 'form-control']); ?>                 
                                            </div>
                                            <div class="col-md-6">
                                                <?php  echo $this->Form->control('listing_id', ['options' => $listings, 'empty' => "choose your company listing",'class' => 'form-control','label' => 'choose Listing']); ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                 <?php  echo $this->Form->control('designation',['class' => 'form-control', 'placeholder' => __('Designation')]); ?>
                                            </div> 
                                            <div class="col-md-6">
                                                <?php  echo $this->Form->control('experience',['class' => 'form-control', 'placeholder' => __('Experience')]); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                               <?php  //echo $this->Form->control('is_featured',['class' => 'form-control', 'placeholder' => __('Is Featured')]); ?>

                                                <?php  echo $this->Form->control('is_featured',['options'=>[1 => "Yes", 0 => "No"],'class' => 'form-control']); ?>

                                            </div>

                                            <div class="col-md-6">
                                                 <?php   echo $this->Form->control('qualification',['class' => 'form-control', 'placeholder' => __('Qualification')]); ?>
                                            </div>
                                        </div>

                                         <div class="row">                                        
                                           
                                            <div class="col-md-6">                                          
                                                 <?php   echo $this->Form->control('position_type',['options'=>[0 => "Temporary", 1 => "Permanent"],'class' => 'form-control']); ?>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                             <?php  echo $this->Form->control('locations._ids', ['options' => $locations,'class' => 'form-control location-admin-list','label' => 'Job Locations']); 
                                             ?> <b> Select locations where you posted this jobs</b>
                                            </div> 

                                        </div>          
                            </div>                           
                    </div>
                 </div>
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

<script>

<?php $this->Html->scriptStart(['block' => true]); ?>

    var start = new Date();
    // set end date to max one year period:
    var end = new Date(new Date().setYear(start.getFullYear() + 1));

    $('.datepicker').datetimepicker({
        startDate: start,
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
    /*
    $(".next_btn").click(function(){
        $(".tabB").children('a').trigger("click");
        $(this).hide();
        $(".submit_btn").removeClass("hidden");
       // $(".back_btn").removeClass("hidden");
    });
    $(".tabA a").click(function(){
        $(".submit_btn").addClass("hidden");
       // $(".back_btn").addClass("hidden"); 
        $('.next_btn').show();
    });
    $(".tabB a").click(function(){
        $(".submit_btn").removeClass("hidden");
       /// $(".back_btn").removeClass("hidden"); 
        $('.next_btn').hide();
    });
    
    */
   $(document).ready(function() {
    var dataError = <?php echo json_encode($dataerror);?>;
        $.each( dataError, function( key, value ) {
            console.log( key + ": " + value['_empty'] );
            var data = $( "input[name='"+key+"'], textarea[name='"+key+"']" ).closest( "div.tab-pane" ).attr("id");
            console.log(key);
            console.log(data);
             $('.nav-tabs a[href="#'+data+'"]').tab('show')
             return false;
         });
         
         
     $('#job_time').timepicker();     
  });
  
  
  $(document).ready(function() {
    $('.location-admin-list').select2();
});
<?php $this->Html->scriptEnd(); ?>
</script>   