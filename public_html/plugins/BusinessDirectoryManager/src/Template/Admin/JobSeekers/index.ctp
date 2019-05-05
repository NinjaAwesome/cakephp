<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $jobSeekers
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Job Seeker') ?>  
        <small><?php echo __('Here you can manage the job seekers'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>

<section class="content" data-table="jobSeekers">   
   <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context']]) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->control('email',['class' => 'form-control', 'placeholder' => __('Email'), 'label' => false]);
                            ?>
                        </div>
                    </div>
                   
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control("keyword", ['type' => 'text', 'class' => 'form-control input-small', 'placeholder' => 'Keyword e.g:mobile,firstname,lastname', 'label' => false]); ?>
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
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Job Seekers') ?></span></h3>
                   
                </div><!-- /.box-header -->
           
             <div class="box box-info">
                  <div class="box-body table-responsive">
        
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col"><?= $this->Paginator->sort('job') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
               <!-- <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attachment') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php 
                if (!empty($jobSeekers->toArray())): 
                        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                        foreach ($jobSeekers as $jobSeeker):  ?>
                                <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?= $jobSeeker->has('job') ? $this->Html->link($jobSeeker->job->job_title, ['controller' => 'Jobs', 'action' => 'view', $jobSeeker->job->id]) : '' ?> </td>
                                    <td><?= h($jobSeeker->first_name.' '.$jobSeeker->last_name) ?></td>
                                    <td><?= h($jobSeeker->email) ?></td>
                                    <td><?= h($jobSeeker->mobile) ?></td>
                                    <td><?= ($jobSeeker->attachment!=null) ?$this->Html->link("Download",['controller'=>'JobSeekers','action'=>'download',$jobSeeker['id'],'plugin'=>'BusinessDirectoryManager', 'prefix'=>'admin'],['class'=>'btn_border gray view_btn']) : __('Null')?>
                                        <?php //echo $this->Html->link("Download",['controller'=>'JobSeekersController','action'=>'download',$jobSeeker['id'],'plugin'=>'BusinessDirectoryManager', 'prefix'=>'admin'],['class'=>'btn_border gray view_btn']) ?>
                                    </td>
                                     <td>
                                        <?php if ($jobSeeker->created != "") {
                                                echo $jobSeeker->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']); }?>
                                    </td>
                                        <td class="actions">
                                           <?php 
                                           $request = $this->Url->build(['plugin' => 'BusinessDirectoryManager', 'controller' => 'Interviews', 'action' => 'add', $jobSeeker->id]);
                                                //$act=array('plugin' => 'BusinessDirectoryManager','controller' => 'Interviews','action' => 'add', $jobSeeker->id);
                                                if($jobSeeker->schedule_status)$act=array();?>
                                            <?= $this->Html->link("<i class=\"glyphicon glyphicon-ok-circle\"></i>", ['action'=>'#'], ['class' => 'btn btn-primary btn-sm btn-flat applt-now-bttn xyzabc','id'=>'openModal','data-toggle'=>'modal', 'data-target'=>'#jobPost','data-url'=>$request ,'escape' => false,'alt'=>__('Select For Interview'),'title'=>__('Select For Interview')]) ?>
                            
                                                
                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $jobSeeker->id], ['onClick' => 'confirmDelete(this, \''.$jobSeeker->id.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Reject job seeker'),'title'=>__('Reject job seeker')]) ?>
                                        </td>
                                </tr>
                                 <?php
                                     $i++; 
                         endforeach; 
                 else: ?>
                            <tr> <td colspan='9' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                 <?php endif; ?>
                        </tbody>
                    </table>
                
                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>     
    
          
        
                  </div>        
              
             </div>    
</section>
<!-- Modal -->
<div id="jobPost" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select candidate</h4>
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
                    var form_data = new FormData($("#FormPostJobs")[0]);
                    $.ajax({
                        url:  '<?php echo $this->Url->build(['plugin' => 'BusinessDirectoryManager', 'controller' => 'Interviews', 'action' => 'add',$jobSeeker->id]); ?>',
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
 


   </script>
