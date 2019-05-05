<div class="topInnerBanner" style="background-image:url(<?= $this->request->getAttribute('webroot') ?>img/cantact_us_banner.jpg);">
    <div class="container">
        <div class="topBannerMidCol">
            <h1>Edit<span> Profile</span></h1>
        </div>
    </div>
</div>  
 
<div class="mainWpapContainer">
   
    <section class="search-result-block padding-T-B-60">
   <div class="container">
      <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get', 'valueSources' => ['query', 'context']]) ?>
       <div class="box box-info">
         <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control("keyword", ['type' => 'text', 'value' =>'', 'class' => 'form-control input-small', 'placeholder' => 'Keyword e.g:job title, experience,qualification,designation', 'label' => false]);?>  
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control('location', ['value' =>'','options' => $locations,'class' => 'location_select form-control', 'placeholder' =>'Locations','multiple'=>true, 'label' => false]); ?>
                        </	div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                           <?php
                               echo $this->Form->button(__('Search <i class="fa fa-long-arrow-right"></i> '), ['class' => 'btn btn-success', 'title' => __('Search')]);
                               echo " ";
                               echo $this->Form->button("<i class='fa fa-fw fa-refresh'></i> " . __('Reset'), ['action' => 'JobsListing'], ['class' => 'btn  btn-sm bannerSearch-btn', 'title' => __('Cancel'), 'escape' => false]);
                           ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
        
            
            <div class="row">
                <div class="col-sm-4 col-xs-12">
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
                <div class="col-sm-8 col-xs-12">
                    <div class="jobListingSec">
                      <?php
                        foreach ($jobs as $key => $job) { ?>
                        
                        
                            <div class="jobHistoryRow">
                                <div class="inner-info-box info-bg-light">
                                    <div class="rightlist">                                       
                                        <div class="clearfix">
                                            <div class="jobinfo">
                                                <label><?php echo $new->title; ?></label>
                                            </div>                        
                                        </div>
										

                                        <div class="dis_block clearfix postd">
                                            <div class="jobinfo"> <span>Posted Date</span>
                                                <label>
                                                    <?php echo $job->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']); ?>
                                                </label>
                                            </div>
                                            <div class="jobinfo"> <span> Seniority</span>
                                                <label><?php echo $job->designation; ?></label>
                                            </div>

                                            <div class="jobinfo"> <span> Location</span>
                                                <?php
                                                $i = 0;
                                                foreach ($job->locations as $location) {
                                                    ?>
                                                    <label>
                                                        <?php
                                                        if ($i != 0)
                                                            echo ",";
                                                        echo $location->title;
                                                        ?>
                                                    </label>
                                                    <?php $i++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="info-block-3 dis_block clearfix">
                                            <div class="md-info dis_block clearfix"> <span> <?= ($job->position_type == 1) ? __('Permanent') : __('Temporary'); ?></span> </div>
                                        </div>
                                        <div class="btn-group">
                                             <?php echo $this->Html->link('Details', array('plugin' => 'BusinessDirectoryManager', 'controller' => 'Jobs', 'action' => 'view', $job->id, '_full' => true), array('class' => 'btn  btn-sm bannerSearch-btn')); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="leftlist">
                                        <div class="dis_block clearfix rightr1">
                                            <h2><a href="job-detail-page.html"><?php echo $job->job_title; ?></a></h2>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="dis_block clearfix marT1 job-des">
                                            <p><?php echo $job->job_summary; ?>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="info-bttn-sec"> <a href="/jobs/show/1" class="read-more">read more</a> </div>
                                    </div>
                                </div>
                            </div>   

                     <?php } ?>
                        <div class="box-footer clearfix">
                              <?php echo $this->element('pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
        
    </section>
</div>

<script>
    
  <?php $this->Html->scriptStart(['block' => true]); ?>
                    $(document).ready(function() {
                         $('.location_select').select2();             
                    });
  <?php $this->Html->scriptEnd(); ?>
            
</script>