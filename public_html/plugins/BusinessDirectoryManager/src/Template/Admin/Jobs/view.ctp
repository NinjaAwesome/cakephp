<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $job
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Job'); ?>  <small>Job Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="jobs">
<div class="jobs box">
    <div class="box-header">
            <h3 class="box-title"><?php //= h($job->id) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><span class='headcol'><?= __('User') ?></span> 
           <span class='valuecol'> <?php //= $job->has('user') ? $this->Html->link($job->user->id, ['controller' => 'Users', 'action' => 'view', $job->user->id]) : '' ?>
             <?= h($job->user->first_name.' '.$job->user->last_name) ?>
           </span>
          </th>
        <th scope="row"><span class='headcol'><?= __('Listing') ?></span>  
           <span class='valuecol'> <?php //= $job->has('listing') ? $this->Html->link($job->listing->title, ['controller' => 'Listings', 'action' => 'view', $job->listing->id]) : '' ?>  
            <?= h($job->listing->title) ?></span>
       </th>
        </tr>
        <tr>
            <th scope="row"><span class='headcol'><?= __('Job Title') ?></span>  
           <span class='valuecol'> <?= h($job->job_title) ?></span></th>
       
            <th scope="row"><span class='headcol'><?= __('Designation') ?></span> 
           <span class='valuecol'> <?= h($job->designation) ?></span></th>
        </tr>
        <tr>
            <th scope="row"><span class='headcol'><?= __('Experience') ?></span>
           <span class='valuecol'> <?= h($job->experience) ?></span></th>
       
            <th scope="row"><span class='headcol'><?= __('Qualification') ?></span>  
           <span class='valuecol'> <?= h($job->qualification) ?></span></th>
        </tr>
        <tr>
           <th  scope="row"> <span class='headcol'> <?= __('Job End Date') ?> </span> 
           <span class='valuecol'>  <?php if ($job->job_end != "") {
                echo $job->job_end->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);}
                   ?></span></th> 
       
            <th scope="row"><span class='headcol'><?= __('Office Time') ?></span> 
           <span class='valuecol'> <?= h($job->job_time) ?></span></th>
        </tr>
        <tr>
            <th scope="row"><span class='headcol'><?= __('Job Type') ?> </span>          
              <span class='valuecol'>
                
              <?php $jobtyp='';
                 if($job->job_for == 0) 
                    $jobtyp='Full Time';
                  else if($job->job_for == 1) 
                      $jobtyp='Part Time';
                    else if($job->job_for == 2) 
                        $jobtyp='Internship';
                      else if($job->job_for == 3) 
                         $jobtyp='Contract';
                        else if($job->job_for == 4) 
                          $jobtyp='Volunteer';
                   echo  $jobtyp; ?>

              </span>
            

         </th>


        
            <th scope="row"><span class='headcol'><?= __('Job For') ?></span> 
          <span class='valuecol'>
              <?php echo  ($job->job_for == 2) ? __('Both') : (($job->job_for==1)? __('Male'): __('Female')); ?></span>
          
         </th>
        </tr>
        
        <tr>
            <th scope="row"><span class='headcol'><?= __('Vacancy') ?></span> 
          <span class='valuecol'>  <?= $this->Number->format($job->vacancy) ?></span></th>
         <th scope="row"><span class='headcol'><?= __('Is Featured') ?></span>           
             <span class='valuecol'><?= $job->is_featured ? __('Yes') : __('No'); ?></span>
           
        </tr>
        <tr>
           <th scope="row"><span class='headcol'><?= __('Salary Min') ?></span> 
            <span class='valuecol'><?= $this->Number->currency($job->salary_min,'USD') ?></span></th>
            <th scope="row"><span class='headcol'><?= __('Salary Max') ?> </span> 
           <span class='valuecol'> <?= $this->Number->currency($job->salary_max,'USD') ?></span></th>
        
           
        </tr>
        <tr>
          
            <th scope="row"><span class='headcol'><?= __('Position Yype') ?></span>  
            <span class='valuecol'>
              <?= ($job->position_type==1) ? __('Permanent') : __('Temporary'); ?>
            </span></th>

           <th scope="row"><span class='headcol'><?= __('Status') ?></span>  
            <span class='valuecol'><?= $job->status ? __('Publish') : __('Not publish'); ?></span></th>
            <th></th>
        </tr>

        


          <tr>
            <th scope="row"> <span class='headcol'> <?= __('Locations') ?> </span> 
           </th> 
           <th></th>      
           
        </tr>
         <?php 
             //dump($job->locations);
          $i=1;
          foreach ($job->locations as $location) {?>
          <tr>                  
            <th scope="row"><span class='headcol'><?php   echo $i; ?> </span>            
            <span class='valuecol'> <?php   echo $location->title; ?> </span></th>
            <th></th>
        </tr>
        <?php $i++; } ?>
         <tr>
          
            <th colspan="2" scope="row"><span class='headcol'><?= __('Job Summary') ?></span>  
            <span class='valuecol'><?php echo  $job->job_summary; ?></span></th>            
           
            
        </tr>

        <tr>
            <th scope="row"> <span class='headcol'> <?= __('Created') ?> </span> 
           <span class='valuecol'> <?php if ($job->created != "") {
                echo $job->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);}
                   ?> </span></th>        
            <th scope="row"><span class='headcol'> <?= __('Modified') ?> </span> 
           <span class='valuecol'><?php if ($job->modified != "") {
                echo $job->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);}
                   ?> </span></th>
        </tr>
       
     
    </table>
   
   
    </div>

</div>
</section>
