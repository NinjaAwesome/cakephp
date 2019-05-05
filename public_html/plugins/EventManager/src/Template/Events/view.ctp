<?php

use Cake\I18n\Date; ?>
<?php
//pr($event);
//dump($event);
///Start date 
$dateStartDate = new Date($event->start_date);
$startDay = $dateStartDate->format('d'); //date('d', strtotime($event->start_date));
$startMonth = $dateStartDate->format('M'); //date('M', strtotime($event->start_date));
$startYear = $dateStartDate->format('Y'); //date('Y', strtotime($event->start_date));
//End date 
$dateEndDate = new Date($event->end_date);
$endDay = $dateEndDate->format('d'); //date('d', strtotime($event->start_date));
$endMonth = $dateEndDate->format('M'); //date('M', strtotime($event->start_date));
$endYear = $dateEndDate->format('Y'); //date('Y', strtotime($event->start_date));
//Event document
$eventDocument = $event->event_documents;
//pr($eventDocument);
?>


<div class="row">
    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="images/bg/bg2.jpg">
            <div class="container pt-30 pb-30">
                <!-- Section Content -->
                <div class="section-content text-center">
                    <div class="row"> 
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h2 class="text-theme-colored font-36">Event Details 2</h2>
                            <ol class="breadcrumb text-center mt-10 white">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Pages</a></li>
                                <li class="active">Event Details 2</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>      
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <ul>
                            <li>
                                <h5>Topics:</h5>
                                <p><?php echo $event->title; ?></p>
                            </li>
                            <li>
                                <h5>Host:</h5>
                                <p><?php echo $event->organizar_name; ?></p>
                            </li>
                            <li>
                                <h5>Location:</h5>
                                <p><?php echo $event->location; ?></p>
                            </li>
                            <li>
                                <h5>Start Date:</h5>
                                <p><?php echo $startMonth . ' ' . $startDay . ', ' . $startYear; ?></p>
                                <p>January 26, 2016</p>
                            </li>
                            <li>
                                <h5>End Date:</h5>
                                <p><?php echo $endMonth . ' ' . $endDay . ', ' . $endYear; ?></p>
                                <p>February 10, 2016</p>
                            </li>
                            <li>
                                <h5>Website:</h5>
                                <p>kodesolution.com</p>
                            </li>
                            <li>
                                <h5>Interested:</h5>
                                <?= $this->Form->create($event, ['url' => ['action' => 'eventInvites', $event->id], 'role' => 'form','id'=>'Interested']); ?>
                                <p>
                                    <?php 
                                    echo $this->Form->input('event_id',['type'=>'hidden',"value"=>$event->id]);
                                    echo $this->Form->radio('status_in',
                                                            [
                                                                ['value' => '1', 'text' => 'Interested', 'style' => 'color:red;margin-right:5px;'],
                                                                ['value' => '2', 'text' => 'Going', 'style' => 'color:blue;'],
                                                                ['value' => '3', 'text' => 'May Be', 'style' => 'color:green;'],
                                                            ]
                                                            //['default'=>NULL]
                                                        );
                                    ?>
                                    <?php //echo $this->Form->button(__('Client Here'), ['class' => 'btn btn-dark btn-theme-colored btn-sm btn-block mt-20 pt-10 pb-10', 'title' => __('Client Here')]); ?>
                                </p>
<!--                                <p id="magpop"></p>-->
                                <span class="info" id="magpop"></span>  
                                <?= $this->Form->end() ?>
                            </li>
                            <li>
                                <h5>Share:</h5>
                                <div class="styled-icons icon-sm icon-gray icon-circled">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </li>     
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="featured-project-carousel owl-carousel" id="event-slider">
                            <?php
                            foreach ($eventDocument as $eventDocumentEach) {
                                ?>
                                <?php if ($eventDocumentEach->file_type == 1) { ?>  
                                    <div class="item">
                                        <?php echo $this->Glide->image(($eventDocumentEach->file_name != '' ? $eventDocumentEach->file_name : 'https://placehold.it/755x480'), ['w' => '755', 'h' => '440'], ['class' => 'img-fullwidth', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>                                    
                                    </div>
                                <?php } else if ($eventDocumentEach->file_type == 2) { ?>
                                    <div class="item">    
                                        <iframe src="<?php echo $eventDocumentEach->file_name; ?>" height="600" width="500" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                                        </iframe>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-md-12">
                        <h4 class="mt-0">Event Description</h4>
                        <p><?php echo $event->description; ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Registration Form -->
        <section class="divider parallax layer-overlay overlay-light" data-stellar-background-ratio="0.5" data-bg-img="images/bg/bg1.jpg">
            <div class="container-fluid">
                <div class="section-title mb-30">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h3 class="title text-theme-colored">Registration Form</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?= $this->Form->create($event, ['url' => ['action' => 'formSub', $event->id], 'role' => 'form', 'class' => 'booking-form bg-lightest-transparent p-50 mb-0', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validation();']); ?>
                    <div class="col-md-8 col-md-offset-2">
                        <?php
                        $inc = 0;
                        //dump($event->event_options);
                        foreach ($event->event_options as $evOpt) {
                            //pr($evOpt->id);
                            echo $this->Form->input("event_booking_options." . $inc . ".option_type", ['type' => 'hidden', 'value' => $evOpt->evoption->option_type]);
                            echo $this->Form->input("event_booking_options." . $inc . ".evoption_id", ['type' => 'hidden', 'value' => $evOpt->evoption_id]);
                            echo $this->Form->input("event_booking_options." . $inc . ".name", ['type' => 'hidden', 'value' => $evOpt->evoption->title]);

                            if ($evOpt->evoption->option_type == "checkbox" || $evOpt->evoption->option_type == "radio") {
                                $inputOpts = [];
                                $inputOpts['type'] = 'select';
                                //$inputOpts['label'] = $evOpt->option->title;
                                $inputOpts['label'] = False;
                                //$inputOpts['class'] = 'form-control';
                                $inputOpts['options'] = $option_values[$evOpt->id];
                                if (in_array($evOpt->evoption->option_type, ['checkbox'])) {
                                    if ($evOpt->evoption->option_type == 'checkbox') {
                                        $checkbox = 'checkbox';
                                    }
                                    $inputOpts['multiple'] = $evOpt->evoption->option_type;
                                }
                                if ($evOpt->evoption->option_type == "radio") {
                                    $radio = 'radio';
                                    //$inputOpts['type'] = "radio";
                                }
                                ?>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo $evOpt->evoption->title; ?></label>
                                        <?php
                                        if ($evOpt->evoption->option_type == "checkbox" && isset($option_values[$evOpt->id])) {
                                            //dump($option_values[$evOpt->id]);
                                            $ck = 0;
                                            foreach ($option_values[$evOpt->id] as $chk):
                                                echo $this->Form->input("event_booking_options." . $inc . ".event_booking_option_values." . $ck . ".opt_value", ['type' => 'checkbox', 'value' => $chk, 'label' => $chk]);
                                                $ck++;
                                            endforeach;
                                            echo '<span class="info" id="id_check_info"></span>';
                                        } else {
                                            $inputOpts['class'] = "class_radio";
                                            $inputOpts['type'] = "radio";
                                            $inputOpts['options'] = array_combine(array_values($inputOpts['options']), array_values($inputOpts['options']));
                                            echo $this->Form->input("event_booking_options." . $inc . ".evoption_value", $inputOpts);
                                            echo '<span class="info" id="id_radio_info"></span>';
                                        }
                                        ?>

                                    </div>
                                    <?php //echo $this->Form->input("event_booking_options." . $inc . ".option_id", ['type' => 'hidden','value'=>$evOpt->id]);   ?>
                                </div>
                                <?php
                            } elseif ($evOpt->evoption->option_type == "select") {
                                ?>
                                <div class="col-sm-12">
                                    <label><?php echo $evOpt->evoption->title; ?></label>
                                    <div class="form-group">
                                        <?php
//                                        $inputOpts['type'] = "select";
                                        $inputOpts['options'] = $option_values[$evOpt->id];
                                        $inputOpts['options'] = array_combine(array_values($inputOpts['options']), array_values($inputOpts['options']));
//                                        echo $this->Form->input("event_booking_options." . $inc . ".option_value", $inputOpts);

                                        echo $this->Form->input("event_booking_options." . $inc . ".evoption_value", ['type' => 'select', 'class' => 'form-control', 'id' => 'id_select', 'options' => $inputOpts['options'], 'empty' => 'Select', 'label' => False]);
                                        echo $this->Form->input("event_booking_options." . $inc . ".name", ['type' => 'hidden', 'value' => $evOpt->option->title]);
                                        ?>
                                        <span class="info" id="id_select_info"></span>   
                                    </div>
                                </div>
                                <?php
                            } elseif ($evOpt->option->option_type == "text") {
                                ?>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo $this->Form->input("event_booking_options." . $inc . ".evoption_value", ['type' => 'text', 'id' => 'id_text', 'class' => 'form-control', 'placeholder' => $evOpt->option->title, 'label' => $evOpt->option->title]); ?>
                                        <span class="info" id="text_info"></span>   
                                    </div>
                                </div>
                            <?php } elseif ($evOpt->option->option_type == "textarea") { ?>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo $this->Form->input("event_booking_options." . $inc . ".evoption_value", ['type' => 'textarea', 'id' => 'id_textarea', 'class' => 'form-control', 'placeholder' => $evOpt->option->title, 'label' => $evOpt->option->title]); ?>
                                        <span class="info" id="textarea_info"></span>
                                    </div>
                                </div>
                            <?php } elseif ($evOpt->option->option_type == "date") { ?>
                                <div class="col-sm-12">
                                    <label>Date</label>
                                    <div class="form-group">
                                        <?php echo $this->Form->control("event_booking_options." . $inc . ".evoption_value", ['type' => 'text', 'id' => 'id_date', 'class' => 'form-control datepicker', 'required' => FALSE, 'placeholder' => 'YYYY-mm-dd', 'readonly' => true, 'label' => FALSE]); ?>
                                        <span class="info" id="date_info"></span>
                                    </div>
                                </div>
                            <?php } elseif ($evOpt->option->option_type == "datetime") { ?>
                                <div class="col-sm-12">
                                    <label>Date & Time</label>
                                    <div class="form-group">
                                        <?php echo $this->Form->control("event_booking_options." . $inc . ".evoption_value", ['type' => 'text', 'id' => 'id_datetime', 'class' => 'form-control datepicker', 'required' => FALSE, 'placeholder' => 'yyyy-mm-dd H:i:s', 'readonly' => true, 'label' => FALSE]); ?>
                                        <span class="info" id="datetime_info"></span>
                                    </div>
                                </div>
                            <?php } elseif ($evOpt->option->option_type == "time") { ?>
                                <div class="col-sm-12">
                                    <label>Time</label>
                                    <div class="form-group">
                                        <?php echo $this->Form->control("event_booking_options." . $inc . ".evoption_value", ['type' => 'text', 'id' => 'id_time', 'class' => 'form-control datepicker', 'required' => FALSE, 'placeholder' => 'H:i:s', 'readonly' => true, 'label' => FALSE]); ?>
                                        <span class="info" id="time_info"></span>
                                    </div>
                                </div>
                            <?php } elseif ($evOpt->option->option_type == "image") {
                                ?>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo $evOpt->option->title; ?></label>
                                        <?php echo $this->Form->control("event_booking_options." . $inc . ".evoption_value", ['type' => 'file', 'id' => 'id_img', 'label' => False]); ?>
                                        <span class="info" id="img_info"></span>
                                    </div>
                                </div>
                                <?php
                            } $inc++;
                        }
                        ?>
                        <div class="col-sm-12">
                            <label>Amount</label>
                            <div class="form-group">
                                <?php echo $this->Form->control("amount", ['type' => 'text', 'class' => 'form-control datepicker', 'required' => FALSE,'readonly' => true, 'label' => FALSE]); ?>
                                <span class="info" id="time_info"></span>
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-8">
                            <div class="form-group">
                                <?php echo $this->Form->control("coupons", ['type' => 'text', 'class' => 'form-control datepicker','placeholder'=>'Enter coupon code', 'required' => FALSE, 'label' => FALSE]); ?>
                                <span class="info" id="time_info"></span>
                            </div>
                            <span class="info" id="couponspop"></span>  
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group text-center">
                                <?php echo $this->Form->button(__('Apply Coupon Code'), ['type'=>'button','id'=>'coupons_button','class' => 'btn btn-dark btn-theme-colored btn-sm btn-block pt-10 pb-10', 'title' => __('Coupon Code')]); ?>  
                            </div>
                        </div>
                         
                        <div class="col-sm-12">
                            <label>Card Number<span class="red">*</span></label>
                            <div class="form-group">
                                <?php echo $this->Form->control('card_num',['type' => 'text','class' => 'form-control','id'=>'card_num','size'=>20,'label' => FALSE,"placeholder"=>"Eg. 4242424242424242"]); ?>
                                <span class="info" id="card_num_info"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>CVC<span class="red">*</span></label>
                                    <div class="form-group">
                                        <?php echo $this->Form->control("cvc",["type"=>"text","class"=>"form-control","id"=>"cvc","label"=>FALSE,"size"=>4,"placeholder"=>"Eg. 123"]); ?>
                                        <span class="info" id="cvc_info"></span>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <label>Expiration (MM/YYYY)<span class="red">*</span></label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php echo $this->Form->control("exp_month",["type"=>"text","class"=>"form-control","id"=>"exp_month","label"=>FALSE,"size"=>2,"placeholder"=>"Eg. MM"]); ?>
                                            <span class="info" id="exp_month_info"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php echo $this->Form->control("exp_year",["type"=>"text","class"=>"form-control","id"=>"exp_year","label"=>FALSE,"size"=>4,"placeholder"=>"Eg. YYYY"]); ?>
                                            <span class="info" id="exp_year_info"></span>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group text-center">
                                <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-dark btn-theme-colored btn-sm btn-block mt-20 pt-10 pb-10', 'title' => __('Register now')]); ?>                
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </section>
    </div>

    <section>
        <div class="container">
            <div class="row mt-30">
                <div class="col-md-12">
                    <h4 class="mb-20">Event Gallery</h4>
                    <div class="recent-project owl-carousel" id="event-gallery">
                        <?php
                        foreach ($eventDocument as $eventDocumentEach) {
                            if ($eventDocumentEach->file_type == 1) {
                                ?>
                                <div class="item">
                                    <?php echo $this->Glide->image(($eventDocumentEach->file_name != '' ? $eventDocumentEach->file_name : 'https://placehold.it/285x215'), ['w' => '755', 'h' => '440'], ['class' => 'img-fullwidth', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->css(['/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min'], ['block' => true]);
$this->Html->css(['/assets/plugins/iCheck/square/blue.css'], ['block' => true]);

$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min'], ['block' => true]);
?>
<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>
    //    $('.datepicker').datetimepicker({
//        minView: 2,
//        format: 'yyyy-mm-dd',
//        'showTimepicker': false,
//        autoclose: true
//    });

    function validation() {
            var id_check_info = true; 
            var id_select = true;
            var id_radio_info = true;
            var text_info = true;             
            var textarea_info = true;
            var date_info = true;
            var time_info = true; 
            var datetime_info = true;
            var img_info = true;
            var info_photo = true;
            var card_num_info = true;
            var cvc_info = true;
            var exp_month_info = true;
            var exp_year_info = true;
            
            var regex = new RegExp(/^\+?[0-9(),.-]+$/);
            var char = new RegExp(/^[a-zA-Z ]*$/);
            
            <?php if (isset($checkbox) && $checkbox == "checkbox") { ?>
                if (!jQuery('form input[type=checkbox]:checked').val()) {
                        jQuery('#id_check_info').show();
                        jQuery("#id_check_info").html("<span style='color: red;font-size:15px;'>Please select checkbox.</span>");
                        id_check_info = false;
                } else {
                jQuery('#id_check_info').hide();
                        id_check_info = true;
                }
                <?php } ?>                  
                if (!jQuery("#id_select").val() && jQuery("#id_select").val() == "") {
            jQuery('#id_select_info').show();
                    jQuery("#id_select_info").html("<span style='color: red;font-size:15px;'>Select bike.</span>");
                    id_select = false;  
                } else {
                jQuery('#id_select_info').hide();
                    id_select = true;
                 }
                <?php if (isset($radio) && $radio == "radio") { ?>
                     if (!jQuery('form input[type=radio]:checked').val()) {
                    // alert("radio");
                             jQuery('#id_radio_info').show();
                             jQuery("#id_radio_info").html("<span style='color: red;font-size:15px;'>Please select radio value.</span>");
                             id_radio_info = false;
                     } else {
                     jQuery('#id_radio_info').hide();
                             id_radio_info = true;
                     }
                <?php } ?>    
                if (!jQuery("#id_text").val() && jQuery("#id_text").val() == "") {
                    jQuery('#text_info').show();
                    jQuery("#text_info").html("<span style='color: red;font-size:15px;'>Enter text field value.</span>");
                    text_info = false;
                } else if (!jQuery("#id_text").val().match(char)) {
                    jQuery('#text_info').show();
                    jQuery("#text_info").html("<span style='color: red;font-size:15px;'>Enter only characters.</span>");
                    text_info = false;              
                } else {
                    jQuery('#text_info').hide();
                    text_info = true;
                 }
            
                if (!jQuery("#id_textarea").val() && jQuery("#id_textarea").val() == "") {
                     jQuery('#textarea_info').show();
                    jQuery("#textarea_info").html("<span style='color: red;font-size:15px;'>Enter textarea field value.</span>");
                    textarea_info = false;            
                } else {
                    jQuery('#textarea_info').hide();
                    textarea_info = true;
                 }
                 
            if (!jQuery("#id_date").val() && jQuery("#id_date").val() == "") {
                    jQuery('#date_info').show();
                    jQuery("#date_info").html("<span style='color: red;font-size:15px;'>Please select field.</span>");
                    date_info = false;                
                } else {
                    jQuery('#date_info').hide();
                    date_info = true;
                }
            
            
            if (!jQuery("#id_time").val() && jQuery("#id_time").val() == "") {
                    jQuery('#time_info').show();
                    jQuery("#time_info").html("<span style='color: red;font-size:15px;'>Please select time field.</span>");
                    time_info = false;      
                } else {
                    jQuery('#time_info').hide();
                    time_info = true;
                }
            
            
            if (!jQuery("#id_datetime").val() && jQuery("#id_datetime").val() == "") {
                    jQuery('#datetime_info').show();
                    jQuery("#datetime_info").html("<span style='color: red;font-size:15px;'>Please select datetime field.</span>");
                    datetime_info = false;         
                } else {
                    jQuery('#datetime_info').hide();
                    datetime_info = true;
                }
            
            
            
            if(!jQuery("#id_img").val() && jQuery("#id_img").val() == ""){
                     jQuery('#img_info').show();
                    jQuery("#img_info").html("<span style='col or: red;font-size:15px;'>Please select image.</span>");
                    img_info  = false;
            }else  if (jQuery("#id_img").val()) {
                    var validExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp ']; //array of valid extensions
                    var fileName = jQuery("#id_img").val();
                    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);           
                    if (jQuery.inArray(fileNameExt, validExtensions) == -1) { 
                    jQuery('#img_info').show();
                    jQuery("#img_info").html("<span style='color: red;font-size:15px;'>Invelid file extention.</span>");
                    img_info = false;
            } else {
                    jQuery('#img_info').hide();
                    img_info = true;                
                } 
            }
            
            if (!jQuery("#card_num").val()) {
                    jQuery('#card_num_info').show();
                    jQuery("#card_num_info").html("<span style='color: red;font-size:15px;'>Enter cart number.</span>");
                    card_num_info = false;
                }  else {
                    jQuery('#card_num_info').hide();
                    card_num_info = true;
                 }
                 
                 
             if (!jQuery("#cvc").val()) {
                    jQuery('#cvc_info').show();
                    jQuery("#cvc_info").html("<span style='color: red;font-size:15px;'>Enter cvv number.</span>");
                    cvc_info = false;
                }  else {
                    jQuery('#cvc_info').hide();
                    cvc_info = true;
                 }  
                 
              if (!jQuery("#exp_month").val()) {
                    jQuery('#exp_month_info').show();
                    jQuery("#exp_month_info").html("<span style='color: red;font-size:15px;'>Enter card expire month.</span>");
                    exp_month_info = false;
                }  else {
                    jQuery('#exp_month_info').hide();
                    exp_month_info = true;
                 }   
                 
                 if (!jQuery("#exp_year").val()) {
                    jQuery('#exp_year_info').show();
                    jQuery("#exp_year_info").html("<span style='color: red;font-size:15px;'>Enter card expire year.</span>");
                    exp_year_info = false;
                }  else {
                    jQuery('#exp_year_info').hide();
                    exp_year_info = true;
                 } 
            
            
            if (id_check_info == true && id_select == true && text_info == true && textarea_info == true && date_info == true && time_info == true && datetime_info == true && img_info == true && id_radio_info == true && card_num_info == true && cvc_info == true && exp_month_info == true && exp_year_info == true)
                    return true;
                    else
                    return false;
            }

            jQuery(document).ready(function () {
            jQuery('#id_date').datetimepicker({minView: 2, format: 'yyyy-mm-dd', 'showTimepicker': false, autoclose: true});
                    jQuery('#id_time').datetimepicker({
            //minView: 2,  dateFormat: '' ,, 'showDimepicker': false, autoclose: true
                    format: 'HH:ii p',
                    autoclose: true,
                    // todayHighlight: true,
                    showMeridian: true,
                    startView: 1,
                    maxView: 1
            });
            
            jQuery('#id_datetime').datetimepicker({format: 'yyyy-mm-dd H:i:s', autoclose: true });});
            
            $('input[name="status_in"]').click(function(){
                var Interested = jQuery("#Interested").serialize();
                $.ajax({
                    url: '<?php echo $this->Url->build(['controller' => 'Events', 'action' => 'eventInvites','plugin'=>'EventManager']); ?>',
                    type: 'POST',
                    data: Interested,
                    dataType: 'json',
                    beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-Token', '<?php  echo $this->request->getParam('_csrfToken'); ?>');
                    },
                    success: function(response){
                        //response = JSON.parse(response);
                        if(response.status == 'success'){
                            jQuery("#magpop").html("<p style='color: green;font-size:15px;'>success</p>");
                        }else{
                            jQuery("#magpop").html("<p style='color: red;font-size:15px;'>error</p>");
                        }
                    }
                });
            });
            
            $('#coupons_button').click(function(){
                 var amount = jQuery("#amount").val();
                 var coupons = jQuery("#coupons").val();
                 if(coupons == ''){
                     jQuery("#couponspop").html("<p style='color: red;font-size:15px;'>Please enter coupon code.</p>");
                 }else{
                     $.ajax({
                    url: '<?php echo $this->Url->build(['controller' => 'Events', 'action' => 'checkDiscountCode','plugin'=>'EventManager']); ?>',
                    type: 'POST',
                    data: {amount: amount, coupons: coupons},
                    dataType: 'json',
                    beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-Token', '<?php  echo $this->request->getParam('_csrfToken'); ?>');
                    },
                    success: function(response){
                        if(response.status == 'success'){
                            jQuery("#amount").val(response.new_price);
                            jQuery("#couponspop").html("<p style='color: green;font-size:15px;'>Coupon code applied successfully.</p>");
                        }else{
                            jQuery("#couponspop").html("<p style='color: red;font-size:15px;'>error</p>");
                        }
                    }
                });
              }
            });
            
<?php $this->Html->scriptEnd(); ?>
</script>