<div class="topInnerBanner" style="background-image:url(<?= $this->request->getAttribute('webroot') ?>img/cantact_us_banner.jpg);">
    <div class="container">
        <div class="topBannerMidCol">
            <h1>Job <span>listing</span></h1>
        </div>
    </div>
</div>
<div class="mainWpapContainer">
    <section class="search-result-block padding-T-B-60">
        <div class="container">
            <div class="result-content-block">
                <div class="row">
                    <div class="col-sm-3 col-xs-12">
                        <div class="srch-result-left-blk">
                            <div class="filter-block-left">
                                <div class="filter-hd-block location-sec">
                                    <h2>My Account</h2>
                                </div>
                                <ul class="myAccountMenu">
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Change password</a></li>
                                    <li class="linkSelected"><a href="#">Job History</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="job-info-left-sec">
                            <h2><?php echo $job->designation; ?></h2>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Job Title</h3>
                            <ul>
                                <li><?php echo $job->job_title; ?></li>
                            </ul>
                            <h3> <i class="fa fa-briefcase">&nbsp;</i>Job Type</h3>
                            <ul>
                                <li><a href="#">Permanent</a></li>
                            </ul>
                            <h3> <i class="fa fa-bar-chart">&nbsp;</i>Business Type</h3>
                            <ul>
                                <li>Support</li>
                            </ul>

                            <h3> <i class="fa fa-clock-o">&nbsp;</i>Office Times</h3>
                            <ul class="time-sec time-sec1">
                                <li><?php echo $job->job_time; ?></li>

                            </ul>
                            <h3> <i class="fa fa-phone">&nbsp;</i>contact </h3>
                            <ul class="time-sec">
                                <li>0421615016</li>
                            </ul>
                            <h3> <i class="fa fa-envelope">&nbsp;</i>Contact Email</h3>
                            <ul class="time-sec">
                                <li>dummy@text.co.uk</li>
                            </ul>
                            <h3> <i class="fa  fa-file-text"></i>Job Summary</h3>
                            <ul> <li> <?php echo $job->job_summary; ?></li> </ul>
                            <h3> <i class="fa fa-map-marker">&nbsp;</i>Job Location (Area or Region)</h3>
                            <ul>
                                <?php
                                $i = 0;
                                foreach ($job->locations as $location) {?>
                                    <li><a href="#"><?php echo $location->title; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="job-info-right-sec">
                            <div class="inner-listing-sec">
                                <?php
                                $request = $this->Url->build(['plugin' => 'BusinessDirectoryManager', 'controller' => 'JobSeekers', 'action' => 'add', $job->id]);
                                ?>
                                <a href="javascript:void(0);" data-toggle="modal"  id='openModal' data-target="#jobPost2"  class="applt-now-bttn " data-url="<?= $request ?>">Apply Now</a>

                                <h2 class="inner-listing-heading"><i class="inner-listing-heading-icon fa  fa-street-view">&nbsp;</i>Overview</h2>
                                <div class="job-spotlight job-spotlight-2 ">
                                    <ul>
                                        <li> <i class="fa fa-clock-o"></i>
                                            <div class="sortlist"> <strong>Work type</strong> <span><?= ($job->position_type == 1) ? __('Permanent') : __('Temporary'); ?></span> </div>
                                        </li>
                                        <li> <i class="fa fa-calendar "></i>
                                            <div class="sortlist" > <strong>Posted Date</strong> <span><?php echo $job->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']); ?></span> </div>
                                        </li>

                                        <li> <i class="fa fa-map-marker"></i>
                                            <div  class="sortlist"> <strong>Location </strong> 
                                                <span> 
                                                    <?php 
                                                            $i = 0; 
                                                            foreach ($job->locations as $location) {
                                                                if ($i != 0)
                                                                    echo ",";
                                                                echo $location->title;
                                                             $i++;
                                                             }
                                                    ?>
                                                </span> 
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
            <div class="modal-footer">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        
<!-- Modal -->
<div id="jobPost2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Apply jobPost2</h4>
            </div>
            <div class="modal-body" id="modal-content-for-jobs-seekers">
            </div>           
        </div>
    </div>
</div>

<?php $this->Html->scriptStart(['block' => true]); ?>

    $(document).ready(function() {
            $("a[data-target='flexModal']").click(function(ev) {
                        ev.preventDefault();
                        var target = $('#flexModal').attr("href");
                        $("#flexModals .modal-body").load(target, function(data) {
                            $("#flexModals").modal("show");
                        });
            });

          $("#openModal").click(function() {
                $('#modal-content-for-jobs-seekers').empty();
                ajaxurl=$(this).attr('data-url');
                        $.ajax({
                                type:"GET",
                                url:ajaxurl,
                                dataType: 'html',
                                beforeSend: function (xhr) {
                                xhr.setRequestHeader('X-CSRF-Token', '<?php echo $this->request->params['_csrfToken']; ?>');
                                },
                                success: function(responce){
                               
                                $('#modal-content-for-jobs-seekers').append(responce);
                                },
                                error: function (responce) {
                                $('#modal-content-for-jobs-seekers').append('<label>missing the URL</label>');
                                }
                        });                  

        });//end open modal click
           $(document).on("click","#submitBtn",function(){
                    var form = document.querySelector('form');
                    var form_data = new FormData($("#FormPostJobs")[0]);
                    $.ajax({
                        url:  '<?php echo $this->Url->build(['plugin' => 'BusinessDirectoryManager', 'controller' => 'JobSeekers', 'action' => 'add']); ?>',
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

            });//end submit click

  });  //end document.ready

<?php $this->Html->scriptEnd(); ?>
