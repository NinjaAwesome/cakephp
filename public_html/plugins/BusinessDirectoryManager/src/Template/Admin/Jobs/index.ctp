<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $jobs
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Job') ?>  
        <small><?php echo __('Here you can manage the jobs'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>


<section class="content" data-table="jobs">   
    <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context']]) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                                echo $this->Form->select('status', [1 => "Yes", 0 => "No"], ['class' => 'form-control', 'empty' => 'Select Publish Status']);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                                 echo $this->Form->select('is_featured', [1 => "Yes", 0 => "No"], ['class' => 'form-control', 'empty' => 'Select Featured Status']);
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control("keyword", ['type' => 'text', 'class' => 'form-control input-small', 'placeholder' => 'Keyword :job title, experience', 'label' => false]); ?>
                        </div>
                    </div>
                    
                      <div class="col-md-3">
                        <div class="form-group">
                         <?php echo $this->Form->control('job_end', ['type' => 'text', 'readonly' =>true, 'class' => 'form-control datepicker', 'placeholder' => 'Job End Date', 'label' => false ]); 
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
    <div class="row jobs">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Jobs') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Job'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

    <div class="box-body table-responsive">    
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th> 
                <th scope="col"><?= $this->Paginator->sort('job_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('designation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vacancy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('experience') ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_end') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_featured','Featured')  ?></th>               
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php 
                    if (!empty($jobs->toArray())): 
                            $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                            foreach ($jobs as $job): ?>
                                <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>                
                                        <td><?= h($job->job_title) ?></td>
                                        <td><?= h($job->designation) ?></td>
                                        <td><?= $this->Number->format($job->vacancy) ?></td>
                                        <td><?= h($job->experience) ?></td>
                                        <td> <?php if ($job->job_end != "") {echo $job->job_end->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);}?></td> 
                                        <td><?= ($job->is_featured==1) ? __('Yes') : __('No')?> </td>
                                        <td>
                                            <?= $this->Form->checkbox('status', ['checked' => $job->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $job->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                                         </td>               
                                        <td class="actions">    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $job->id],['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View job'),'title'=>__('View job')]) ?>
                                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $job->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit job'),'title'=>__('Edit job')]) ?>
                                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $job->id], ['onClick' => 'confirmDelete(this, \''.$job->id.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete job'),'title'=>__('Delete job')]) ?>
                                         </td>
                                 </tr>
                            <?php 
                                $i++; 
                           endforeach; 
               else:
                    ?> <tr> <td colspan='20' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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