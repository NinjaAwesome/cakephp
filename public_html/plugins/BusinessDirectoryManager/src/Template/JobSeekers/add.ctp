<style>
    .col-sm-2 {
        width: 16.66666667%;
        padding-left: 10px; 
        margin-left: 10px; 
    }
</style>
<div class="jobSeekers form large-9 medium-8 columns content form-group">
    <div id='divJobSeekerError' class="alert alert-danger" style="display:none;" >please correct all <strong>highlighted errors </strong> and try again.
    </div>
    <div class="alert alert-success"  id='divJobSeekerSucces' style="display:none;">
        data has been saved <strong>Success fully!</strong> 
    </div>
    <?= $this->Form->create($jobSeeker, ['role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'FormPostJobs']) ?>
    <fieldset>
        <?php
        echo $this->Form->control('job_id', array('id' => 'job_id', 'class' => 'form-control', 'value' => $jobid['id'], 'type' => 'text', 'hidden' => true, 'label' => false));
        echo $this->Form->control('first_name', array('id' => 'first_name', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'First Name'));
        echo "<div id='error_div_first_name' class='alert alert-danger' style='display:none;' ></div>";
        echo $this->Form->control('last_name', array('id' => 'last_name', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Last Name'));
        echo "<div id='error_div_last_name' class='alert alert-danger' style='display:none;' ></div>";
        echo $this->Form->control('email', array('id' => 'email', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Email'));
        echo "<div id='error_div_email' class='alert alert-danger' style='display:none;' ></div>";
        echo $this->Form->control('mobile', array('id' => 'mobile', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Mobile'));
        echo "<div id='error_div_mobile' class='alert alert-danger' style='display:none;' ></div>";
        echo $this->Form->control('message', array('id' => 'message', 'class' => 'form-control', 'placeholder' => 'Message'));
        echo "<div id='error_div_message' class='alert alert-danger' style='display:none;' ></div>";
        echo $this->Form->control('attachment_file', array('id' => 'attachment_file', 'class' => 'form-control', 'type' => 'file', 'placeholder' => 'Upload Resume', 'label' => 'Attachment file (pdf,doc) only'));
        echo "<div id='error_div_attachment_file' class='alert alert-danger' style='display:none;' ></div>";
        ?>
    </fieldset>

    <div style="height:30px;margin:10px;">   
        <?= $this->Form->control(__('Cancel'), array('class' => 'form-control btn btn-info col-sm-2 pull-right', 'type' => 'button', 'label' => false, 'data-dismiss' => 'modal', 'id' => 'dataDisMissForJobPost')) ?>
        <?= $this->Form->control(__('Submit'), array('class' => 'submitBtn form-control btn btn-info col-sm-2 pull-right', 'type' => 'button', 'label' => false, 'id' => 'submitBtn')) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
