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
                            <h2><?php echo $listing->company_name; ?></h2>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Title</h3>
                            <ul>
                                <li><?php echo $listing->title; ?></li>
                            </ul>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Business Name</h3>
                            <ul>
                                <li><?php echo $listing->business_name; ?></li>
                            </ul>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Company Mobile No</h3>
                            <ul>
                                <li><?php echo $listing->company_mobile_no; ?></li>
                            </ul>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>company_fax_no</h3>
                            <ul>
                                <li><?php echo $listing->company_fax_no; ?></li>
                            </ul>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Company Tollfree No</h3>
                            <ul>
                                <li><?php echo $listing->company_tollfree_no; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Company Email</h3>
                            <ul>
                                <li><?php echo $listing->company_email; ?></li>
                            </ul>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Company Website</h3>
                            <ul>
                                <li><?php echo $listing->company_website; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Contact Person Name</h3>
                            <ul>
                                <li><?php echo $listing->contact_person_name; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Contact Person Designation</h3>
                            <ul>
                                <li><?php echo $listing->contact_person_designation; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Contact Person Email</h3>
                            <ul>
                                <li><?php echo $listing->contact_person_email; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Contact Person Phone</h3>
                            <ul>
                                <li><?php echo $listing->title; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Contact Person Phone</h3>
                            <ul>
                                <li><?php echo $listing->contact_person_phone; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Banner Image</h3>
                            <ul>
                                <li><?php echo $this->Html->image($listing->banner_image, ['alt' => 'CakePHP', 'height' => 40, 'width' => 80]);?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>	Logo</h3>
                            <ul>
                                <li><?php   echo $this->Html->image($listing->logo, ['alt' => 'CakePHP', 'height' => 40, 'width' => 80]); ?></li>
                            </ul>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Address Line 1</h3>
                            <ul>
                                <li><?php echo $listing->Address_Line_1; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Address Line 2</h3>
                            <ul>
                                <li><?php echo $listing->Address_Line_1; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Postcode</h3>
                            <ul>
                                <li><?php echo $listing->postcode ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Short Description</h3>
                            <ul>
                                <li><?php echo $listing->short_description; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Description</h3>
                            <ul>
                                <li><?php echo $listing->description; ?></li>
                            </ul>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Meta Title</h3>
                            <ul>
                                <li><?php echo $listing->meta_title; ?></li>
                            </ul>
                            <h3> <i class="fa fa-address-card">&nbsp;</i>Meta Keyword</h3>
                            <ul>
                                <li><?php echo $listing->meta_keyword; ?></li>
                            </ul><h3> <i class="fa fa-address-card">&nbsp;</i>Meta Description</h3>
                            <ul>
                                <li><?php echo $listing->meta_description; ?></li>
                            </ul>


                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="job-info-right-sec">
                            <div class="inner-listing-sec">
                                <?php
                                $request = $this->Url->build(['plugin' => 'BusinessDirectoryManager', 'controller' => 'Listings', 'action' => 'view', $listing->id]);
                                ?>
                                <a href="JavaScript:Void(0);" data-toggle="modal"  id='openModal' data-target="#jobPost2"  class="applt-now-bttn " data-url="<?= $request ?>">Apply Now</a>

                                <h2 class="inner-listing-heading"><i class="inner-listing-heading-icon fa  fa-street-view">&nbsp;</i>Overview</h2>
                                <div class="job-spotlight job-spotlight-2 ">
                                    <ul>


                                        <li> <i class="fa fa-map-marker"></i>
                                            <div  class="sortlist"> <strong>Location </strong> 
                                                <span> 




                                                    <label><?php echo $listing->location->title; ?></label>

                                            </div>
                                        <li> <i class="fa fa-map-marker"></i>
                                            <div  class="sortlist"> <strong>Company Name </strong> 
                                                <span> 




                                                    <label><?php echo $listing->company_name; ?></label>

                                            </div>




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
