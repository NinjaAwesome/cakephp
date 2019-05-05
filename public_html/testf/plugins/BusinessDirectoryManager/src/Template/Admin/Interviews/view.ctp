<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $interview
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Interview'); ?>  <small>Interview Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="interviews">
<div class="interviews box">
    <div class="box-header">
            <h3 class="box-title">Interview Schedule<?php //= h($interview->id) ?></h3>       
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Job Title') ?></th>
            <td><?= $interview->job_seeker->job->job_title ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Employee Name') ?></th>
            <td><?= $interview->job_seeker->first_name.' '.$interview->job_seeker->last_name?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interviewer Name') ?>
            </th>
            <td><?= ($interview->interviewer_name == '') ?'Not Fix' : $interview->interviewer_name ?>      
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interview Time ') ?></th>
             <td><b> From </b><?php $time_from='';
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
                   echo  $time_from; ?>
       <b> To </b><?php $time_to='';
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
           
        </tr>
       
       <!-- <tr>
            <th scope="row"><?php //= __('Id') ?></th>
            <td><?php //= $this->Number->format($interview->id) ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Reschedule') ?></th>
            <td>( <?= $this->Number->format($interview->reshedule_count) ?> ) Times</td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interview Date') ?></th>
            <td><?= h($interview->interview_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td> <?php $sts='';
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
			   
                   		 
                   echo  $sts; ?>  </td>
        </tr>
         <tr>
            <th scope="row"><?= __('Comments') ?></th>
           
        </tr>
    </table>
        <div> <?= h($interview->comments) ?></div>
    </div>

</div>
</section>
