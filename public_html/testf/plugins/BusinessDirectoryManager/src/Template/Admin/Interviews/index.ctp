<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $interviews
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Interview') ?>  
        <small><?php echo __('Here you can manage the interviews'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="interviews">   
      <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context']]) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                     echo $this->Form->control('status',['options'=>[1 => "pending", 2 => "In progress", 3 => "Confirm schedule", 4 => "Reschedule", 5 => "Selected", 6 => "Rejected from hr end", 7 => "Rejected from interview end", 8 => "Cancel from employee end", 9 => "Hold"],'empty' =>'Select Status','class' => 'form-control', 'label' => false]);
                            ?>
                        </div>
                    </div>
                   
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $this->Form->control("keyword", ['type' => 'text', 'class' => 'form-control input-small', 'placeholder' => 'Keyword e.g:Comments,InterviewerName', 'label' => false]); ?>
                        </div>
                    </div>
                   
                      <div class="col-md-3">
                        <div class="form-group">
                         <?php  echo $this->Form->control('interview_date', ['type' => 'text', 'readonly' =>true, 'class' => 'form-control datepicker', 'placeholder' => 'Interview Date: YYYY-mm-dd', 'label' => false  ]); 
                         ?>
                        </div>
                      </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->button(__('<i class="fa fa-filter"></i> Filter'), ['class' => 'btn btn-success', 'title' => __('Search')]);
                            echo " ";
                            echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> " . __('Reset'), ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Cancel'), 'escape' => false]);

                            ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>  
    <div class="row interviews">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Interviews') ?></span></h3>
                    <div class="box-tools">
                        <?php //= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Interview'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

    <div class="box-body table-responsive">    
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col"><?= $this->Paginator->sort('job_seeker_id',array('lable' =>'Job Title')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_seeker_id',array('lable' =>'Employee')) ?></th>               
                <th scope="col"><?= $this->Paginator->sort('interviewer_name',array('lable' =>'Interviewer')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('interview_date',array('lable' =>'Date')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('interview_time_from',array('lable' =>'From')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('interview_time_to',array('lable' =>'To')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
              <!-- 
               <th scope="col"><?php //= $this->Paginator->sort('reshedule_count') ?></th>
               <th scope="col"><?php //= $this->Paginator->sort('comments') ?></th>-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php if (!empty($interviews->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($interviews as $interview): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                <td><?php //= $interview->has('job_seeker') ? $this->Html->link($interview->job_seeker->id, ['controller' => 'JobSeekers', 'action' => 'view', $interview->job_seeker->id]) : '' ?>
       <?php echo  $interview->job_seeker->job->job_title; ?>
         </td>
        <td> <?php echo  $interview->job_seeker->first_name.' '.$interview->job_seeker->last_name; ?></td>
                <td><?= ($interview->interviewer_name == '') ?'Not Fix' : $interview->interviewer_name ?></td>
                <td>
                <?php if ($interview->interview_date != "") {
                echo $interview->interview_date->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);}
                   ?>
                </td>
                <td><?php $time_from='';
                 if($interview->interview_time_from == 0) 
                    $time_from='null';
                  else if($interview->interview_time_from == 1) 
                      $time_from='10:30 Am';
                    else if($interview->interview_time_from == 2) 
                        $time_from='11:00 Am';
                      else if($interview->interview_time_from == 3) 
                         $time_from='11:30 Am';
                        else if($interview->interview_time_from == 4) 
			    $time_from='12:00 Pm';
			   else if($interview->interview_time_from == 5) 
                     	      $time_from='12:30 Pm';
                   		 else if($interview->interview_time_from == 6) 
                       		     $time_from='01:00 Pm';
                      			else if($interview->interview_time_from == 7) 
                        		  $time_from='01:30 Pm';
                       			     else if($interview->interview_time_from == 8) 
                         			 $time_from='02:00 Pm';
                   echo  $time_from; ?></td>
                <td><?php $time_to='';
                 if($interview->interview_time_to == 0) 
                    $time_to='null';
                  else if($interview->interview_time_to == 1) 
                      $time_to='3:00 Pm';
                    else if($interview->interview_time_to == 2) 
                        $time_to='03:30 Pm';
                      else if($interview->interview_time_to == 3) 
                         $time_to='04:00 Pm';
                        else if($interview->interview_time_to == 4) 
			    $time_to='04:30 Pm';
			   else if($interview->interview_time_to == 5) 
                     	      $time_to='05:00 Pm';

                   		 
                   echo  $time_to; ?></td>
                <td>
                    <?php //= $this->Form->checkbox('status', ['checked' => $interview->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $interview->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                 <?php $sts='';
                 if($interview->status== 0) 
                     $sts='null';
                  else if($interview->status == 1) 
                       $sts='pending';
                    else if($interview->status == 2) 
                         $sts='In progress';
                      else if($interview->status == 3) 
                          $sts='Confirm schedule';
                        else if($interview->status == 4) 
			    $sts='Reschedule';
			   else if($interview->status == 5) 
                     	       $sts='Selected';
				 else if($interview->status == 6) 
                       $sts='Rejected from hr end';
                    else if($interview->status == 7) 
                         $sts='Rejected from interview end';
                      else if($interview->status == 8) 
                          $sts='Cancel from employee end';
                        else if($interview->status == 9) 
			    $sts='Hold';
			   
                   		 
                   echo  $sts; ?>  
            </td>
               <!-- <td><?php //= $this->Number->format($interview->reshedule_count) ?></td>
                <td><?php $request = $this->Url->build(['plugin' => 'BusinessDirectoryManager', 'controller' => 'Interviews', 'action' => 'add', $interview->id]); //= h($interview->comments) ?></td>-->
                    <td class="actions">
                                         <?= $this->Html->link("<i class=\"glyphicon glyphicon-ok-circle\"></i>", ['action'=>'#'], ['class' => 'btn btn-primary btn-sm btn-flat applt-now-bttn xyzabc','id'=>'openModal','data-toggle'=>'modal', 'data-target'=>'#jobPost','data-url'=>$request ,'escape' => false,'alt'=>__('reschedule the interview'),'title'=>__('reschedule the interview')]) ?>
                                        
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $interview->id],['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View schedule interview'),'title'=>__('View schedule interview')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $interview->id], ['onClick' => 'confirmDelete(this, \''.$interview->id.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete the interview schedule'),'title'=>__('Delete the interview schedule')]) ?>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='10' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>            

                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>            

            </div>
        </div>
    </div>
</section>
<div id="jobPost" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Schedule the Interview</h4>
            </div>
            <div class="modal-body" id="modal-content-for-jobs-seekers">
            </div>           
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
            $("a[data-target='flexModal']").click(function(ev) {
                        ev.preventDefault();
                        var target = $('#flexModal').attr("href");
                        $("#flexModals .modal-body").load(target, function(data) {
                            $("#flexModals").modal("show");
                        });
            });

          $(".xyzabc").click(function() {
                //$('#modal-content-for-jobs-seekers').empty();
                ajaxurl=$(this).attr('data-url');
               
                        $.ajax({
                                type:"GET",
                                url:ajaxurl,
                                
                                dataType: 'html',
                                beforeSend: function (xhr) {
                                xhr.setRequestHeader('X-CSRF-Token', '<?php echo $this->request->params['_csrfToken']; ?>');
                                },
                                success: function(responce){
                                
                                $('#modal-content-for-jobs-seekers').html(responce);
                                $("#jobPost").modal('show');
                                },
                                error: function (responce) {
                                $('#modal-content-for-jobs-seekers').html('<label>Form has been schedule</label>');
                                }
                        });                  

        });//end open modal click
            $(document).on("click","#submitBtn",function(){
                    var form = document.querySelector('form');
                    var form_data = new FormData($("#FormPostJob")[0]);
                    $.ajax({
                        url:  '<?php echo $this->Url->build(['plugin' => 'BusinessDirectoryManager', 'controller' => 'Interviews', 'action' => 'add',$interview->id]); ?>',
                        data:form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                        "accept": "application/json",
                        },
                        beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', '<?php echo $this->request->params['_csrfToken']; ?>');
                        },
                        success: function (responce) {
                        console.log(responce);
                        if(responce.status==0){
                            $.each(responce.errors,function(key,value){
                                    console.log(key + " | " + value._empty);
                                    $("#error_div_"+key).css("display", "block");
                                    if(key=='attachment_file'){
                                        if(value.hasOwnProperty("_empty")){
                                            $("#error_div_"+key).text(value._empty);
                                        }else if(value.hasOwnProperty("validExtension")){
                                            $("#error_div_"+key).text( value.validExtension);
                                        }
                                    }                            
                                    else
                                        $("#error_div_"+key).text(value._empty);  
                                    
                            });
                            $("#divJobSeekerError").css("display", "block");
                            
                        }
                        else{ 
                            $("#divJobSeekerSuccess").css("display", "block");
                            setTimeout(function () {
                                $("#divJobSeekerSuccess").css("display", "none");                                 
                                $("#dataDisMissForJobPost").click();
                             }, 2500);
                            }
                           }
                   
                    });

            });

  }); 



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