<div class="topInnerBanner" style="background-image:url(<?= $this->request->getAttribute('webroot') ?>img/cantact_us_banner.jpg);">
    <div class="container">
        <div class="topBannerMidCol">
            <h1>Edit<span> Profile</span></h1>
        </div>
    </div>
</div> 
<div class="mainWpapContainer">
    <section class="search-result-block padding-T-B-60">
        <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get', 'valueSources' => ['query', 'context']]) ?>
        <div class="box box-info">
            <div class="box-body table-responsive">
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">

                                <?php echo $this->Form->control("keyword", ['type' => 'text', 'class' => 'form-control input-small', 'placeholder' => 'keyword e.g: Company title,name,business', 'label' => false]); ?>


                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo $this->Form->control('location', ['value' => '', 'options' => $locations, 'class' => 'location_select form-control', 'placeholder' => 'Locations', 'multiple' => true, 'label' => false]); ?>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php
                                echo $this->Form->button(__('<i class="fa fa-filter"></i> Search'), ['class' => 'btn btn-success', 'title' => __('Search')]);
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
    </section>
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
        <div class="ListingSec">
            <div class="jobHistoryRow">
                <div class="inner-info-box info-bg-light">
                    <?php foreach ($listings as $key => $listing) {
                        ?>
                        <div class ="col-sm-4">
                            

                            <label>
                                <?php
                                if ($listing->banner_image !== '') {
                                    echo $this->Html->image($listing->banner_image, ['alt' => 'CakePHP', 'height' => 80, 'width' => 140]);
                                }
                                ?>
                            </label>
                        </div>
						
                        <div class ="col-sm-8">
                            <div class="clearfix">
                                <div class="companyinfo">

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="dis_block clearfix postd">
                                <div class="jobinfo"> <span> Title :  </span>
                                    <label><?php echo $listing->title; ?></label>
                                </div>
                            </div>
                            <div class="dis_block clearfix postd">
                                <div class="jobinfo"> <span>Business Name :  </span>
                                    <label><?php echo $listing->business_name; ?></label>
                                </div>
                            </div>

                            <div class="dis_block clearfix postd">
                                <div class="jobinfo"> <span>location :  </span>
                                    <label><?php echo $listing->location->title; ?></label>
                                </div>
                            </div>
                            <div class="dis_block clearfix postd">
                                <div class="jobinfo"> <span>Created Date :  </span>
                                    <label>
                                        <?php echo $listing->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']); ?>
                                    </label>
                                </div>
                            </div>

                            <div class="btn-group">
                                <?php echo $this->Html->link('Details', array('plugin' => 'BusinessDirectoryManager', 'controller' => 'Listings', 'action' => 'view', $listing->id, '_full' => true), array('class' => 'btn  btn-sm bannerSearch-btn')); ?>
                            </div>
                        </div>
                        <div class="leftlist">
                            <div class="dis_block clearfix rightr1">
                                <h2><a href="job-detail-page.html"> short description </a></h2>
                            </div>
                            <div class="clearfix"></div>
                            <div class="dis_block clearfix marT1 job-des">
                                <p><?php echo $listing->short_description; ?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="info-bttn-sec"> <a href="/jobs/show/1" class="read-more">read more</a> </div>
                        </div>



                    <?php } ?>
                </div>
            </div>
            <div class="box-footer clearfix">
                <?php echo $this->element('pagination'); ?>
            </div>

        </div>

    </div>
    <script>

<?php $this->Html->scriptStart(['block' => true]); ?>
        $(document).ready(function () {
            $('.location_select').select2();
        });
<?php $this->Html->scriptEnd(); ?>

    </script>