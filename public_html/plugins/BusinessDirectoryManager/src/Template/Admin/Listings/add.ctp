<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $listing
 */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Listing'); ?> <small>
            <?php echo empty($listing->id) ? __('Add New listing') : __('Edit listing'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="listings">
    <div class="box box-info listings">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($listing->id) ? 'Add Listing' : 'Edit Listing') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>

        </div>
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);
        ?>
        <?= $this->Form->create($listing, ['role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate' => TRUE]) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-a" data-toggle="tab"><?=__("Company Info")?></a></li>
                            <li><a href="#tab-b" data-toggle="tab">Banner theme</a></li>
                            <li><a href="#tab-c" data-toggle="tab">Banner Images</a></li>
                            <li><a href="#tab-d" data-toggle="tab">Address Info</a></li>
                            <li><a href="#tab-e" data-toggle="tab">Description</a></li>
                            <li><a href="#tab-f" data-toggle="tab">Meta Data</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-a">
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->control('company_name', ['class' => 'form-control', 'placeholder' => __('Company Name')]);
                                            echo $this->Form->control('industry_id', ['options' => $industries, 'empty' => 'Select', 'class' => 'form-control', 'placeholder' => __('Industry Id')]);
                                            echo $this->Form->control('business_name', ['class' => 'form-control', 'placeholder' => __('Business Name')]);
                                            echo $this->Form->control('company_mobile_no', ['class' => 'form-control', 'placeholder' => __('Comapny Mobile No')]);
                                            echo $this->Form->control('company_fax_no', ['class' => 'form-control', 'placeholder' => __('Company Fax No')]);
                                            echo $this->Form->control('company_tollfree_no', ['class' => 'form-control', 'placeholder' => __('Company Tollfree No')]);
                                            echo $this->Form->control('company_email', ['class' => 'form-control', 'placeholder' => __('Compnay Email')]);
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->control('company_website', ['class' => 'form-control', 'placeholder' => __('Company Website')]);
                                            echo $this->Form->control('contact_person_name', ['class' => 'form-control', 'placeholder' => __('Contact Person Name')]);
                                            echo $this->Form->control('contact_person_designation', ['class' => 'form-control', 'placeholder' => __('Contact Person Designation')]);

                                            echo $this->Form->control('contact_person_email', ['class' => 'form-control', 'placeholder' => __('Contact Person Email')]);
                                            echo $this->Form->control('contact_person_phone', ['class' => 'form-control', 'placeholder' => __('Contact Person Phone')]);

                                            echo $this->Form->control('sort_order', ['class' => 'form-control', 'placeholder' => __('Sort Order')]);
                                            echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                                            ?>

                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane" id="tab-b">
                                <div class="row">
                                    <div class="imageBox col-md-6 form-group" id="imageBox12">
                                        <h4>Banner Image</h4> 
                                        <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                            <?php echo $this->Glide->image(($listing->banner_image != '' ? $listing->banner_image : 'no_image.gif'), ['w' => '350', 'h' => '200', 'fit' => 'fill'], ['style' => 'width:350px; height:200px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                        </a>
                                        <?php echo $this->Form->control('banner_image', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                                    </div>
                                    <div class="col-md-6 imageBox" id="imageBox564">
                                        <h4>Logo</h4> 
                                        <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                            <?php echo $this->Glide->image(($listing->logo != '' ? $listing->logo : 'no_image.gif'), ['w' => '250', 'h' => '150'], ['style' => 'width:250px; height:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                        </a>
                                        <?php echo $this->Form->control('logo', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="tab-c">
                                <div class="row fontawesome-icon-list">
                                    <div class="col-md-12">
                                        <h4>Banner Shots</h4>
                                        <table id="bannerImages" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-left" style="width: 30%;">Caption</th>
                                                    <th class="text-left" style="width: 20%;">Image</th>
                                                    <th class="text-left" style="width: 30%;">Sort Order</th>
                                                    <th  style="width: 20%;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $key = 0;

                                                if (!empty($listing->listing_catalogs)) {
                                                    foreach ($listing->listing_catalogs as $key => $bannerImg) {
                                                        ?>
                                                        <tr id="imageBox-<?= $key; ?>" class="row-<?= $bannerImg->id; ?> imageBox">
                                                            <td class="text-center">
                                                                <?php
                                                                echo $this->Form->control('listing_catalogs.' . $key . '.id', ['type' => 'hidden']);
                                                                echo $this->Form->control('listing_catalogs.' . $key . '.caption', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => __('caption'), 'label' => false, 'rows' => '2', 'cols' => '20']);
                                                                ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>">
                                                                    <?php echo $this->Glide->image(($bannerImg->images != '' ? $bannerImg->images : 'no_image.gif'), ['w' => '150', 'h' => '150'], ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                                                </a>
                                                                <?php echo $this->Form->control('listing_catalogs.' . $key . '.images', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?=
                                                                $this->Form->control('listing_catalogs.' . $key . '.sort_order', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Sort Order'), 'label' => false, 'templates' => [
                                                                        'error' => '<div class="col-md-6 error-message text-danger">{{content}}</div>',
                                                                        'input' => '<div class="col-md-12"><input type="{{type}}" name="{{name}}"{{attrs}}/></div>',
                                                                ]]);
                                                                ?>
                                                            </td>
                                                            <td class="text-right">
                                                                <?php if (!empty($bannerImg->id)) { ?>
                                                                    <button type="button" data-url="<?php echo $this->Url->build(["controller" => 'Banners', "action" => "deleteImages", $bannerImg->id]); ?>" data-toggle="tooltip" data-title="<?= __('Delete Banner') ?>" title="Remove" class="btn btn-danger deleteTableData">
                                                                        <i class="fa fa-minus-circle"></i>
                                                                    </button>
                                                                <?php } { ?>
                                                                  
                                                                        
                                                                    </button>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-right" colspan="5">
                                                        <button type="button" onclick="addImage();" data-toggle="tooltip" title="<?= __('Add Banner') ?>" class="btn btn-primary">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-d">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="show_sub_locations" class="row">
                                            <div class="col-md-12 column">
                                                <?php echo $this->Form->control('parent_id', ['options' => $locations, 'class' => 'form-control parent', 'empty' => 'Select Location', 'required' => true, 'label' => false]); ?>

                                            </div>
                                            <?php
                                            if(!empty($all_location)){
                                            $count = 0;
                                            foreach ($all_location as $key => $loc) {
                                                ?>
                                                    <div class="col-md-12 column">
                                                        <?php echo $this->Form->control('sublocations[]', ['options' => $loc, 'class' => 'form-control parent', 'empty' => 'Select Location', 'label' => false]); ?>
                                                    </div>
                                                    <?php
                                              $count++;
                                            }
                                            }
                                            ?>
                                           </div>
                                        <?php
                                         if($listing->getError('location_id')){
                                            foreach($listing->getError('location_id') as $err){
                                            echo "<div class='error-message text-danger'>". $err ."</div>";
                                            }
                                        }
                                        ?>
                                        <?php
                                        echo $this->Form->control('address_line_1', ['class' => 'form-control', 'placeholder' => __('Address Line 1')]);
                                        echo $this->Form->control('address_line_2', ['class' => 'form-control', 'placeholder' => __('Address Line 2')]);
                                        echo $this->Form->control('postcode', ['class' => 'form-control', 'placeholder' => __('Postcode')]);
                                       echo $this->Form->control('location_id', ['type' => 'hidden','id'=>'listinglocationId']);
                                        ?>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div id="map" style="width:100%;height:380px;border:1px solid #999;position:relative; margin-top:5;">

                                        </div>
                                        <div class="row margin-top-10" style="margin-top: 10px;">
                                            <div class="col-md-4">
                                                <button class="btn btn-success btn-block validateAddress" type="button" id="validateAddress"><i class="fa fa-map-marker"></i>Locate</button>
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control("latitude", array("type" => "text", "placeholder" => "Latitude", "class" => "form-control", "label" => false)); ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control("longitude", array("type" => "text", "placeholder" => "Longitude", "class" => "form-control", "label" => false)); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-e">
                                <div class="row fontawesome-icon-list">
                                    <div class="col-md-12">
                                        <?php
                                        echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);
                                        echo $this->Form->control('description', ['class' => 'form-control ckeditor', 'placeholder' => __('Description')]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-f">
                                <?php
                                echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                                echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                                echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                                ?>
								
								
                            </div>
							
                        </div>
						  </div>
                </div>
            </div>
        </div>
						
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> ".__('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'),'escape'=>false]); ?>
        </div>
    <?= $this->Form->end() ?>
</div>
</section>
<?php
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->css(['/assets/plugins/iCheck/square/blue.css'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['GalleryManager.common'], ['block' => true]);
$this->Html->script(['/assets/plugins/iCheck/icheck.min'], ['block' => true]);
$this->Html->script(['LocationManager.location', 'https://maps.google.com/maps/api/js?key=' . Configure::read('Setting.GOOGLE_MAP_KEY') . '&v=3&libraries=places&callback=initMap'], ['block' => true]);
?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    var locationTree = [];
<?php
if (!empty($locationTree)) {
    foreach ($locationTree as $loc) {
        ?>
            locationTree.push(<?php echo $loc->id; ?>);
        <?php
    }
}
?>

    var image_row = <?= ($key + 1) ?>;
    function addImage(language_id) {

        html = '<tr id="imageBox-' + image_row + '" class="imageBox"><input type="hidden" name="listing_catalogs[' + image_row + '][file_type]" value="2"/>';
        html += '  <td class="text-left"><textarea name="listing_catalogs[' + image_row + '][caption]" placeholder="Caption" class="form-control"></textarea></td>';
        html += '  <td class="text-left"><a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-center" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>"><img src="<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif" width="150" height="115"  data-placeholder="<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif" /></a><input type="hidden" name="listing_catalogs[' + image_row + '][file_name]" value="" id="input-image' + image_row + '" class="input-image" /></td>';
        html += '  <td class="text-left"><input type="text" name="listing_catalogs[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';
        html += '  <td class="text-right"><button type="button" onclick="$(\'#imageBox-' + image_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';
        $('table#bannerImages tbody').append(html);
        image_row++;

    }



    $(document).ready(function () {

        var dataError = <?php echo json_encode($dataerror);?>;
        $.each( dataError, function( key, value ) {
            console.log( key + ": " + value['_empty'] );
            var data = $( "input[name='"+key+"'], textarea[name='"+key+"']" ).closest( "div.tab-pane" ).attr("id");
            console.log(key);
            console.log(data);
             $('.nav-tabs a[href="#'+data+'"]').tab('show')
             return false;
         });

        $(document).on('change', '.parent', function () {

            $(this).closest('.column').nextAll('.column').remove();

            $('#show_sub_locations').append('<img src="<?php echo $this->request->getAttribute('webroot'); ?>img/loading.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
            var parent_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Url->build(['controller' => 'Locations', 'action' => 'getList', 'plugin' => 'LocationManager']); ?>",
                type: 'get',
                dataType: "json",
                data: {parent_id: parent_id, only_child: true},
                headers: {
                    "accept": "application/json",
                },
                success: function (response) {
                    setTimeout(function () {
                        finishAjax('show_sub_locations', response, parent_id);
                    }, 400);

                }
            });
           
            locations = getLocationsArray();

            setMapByAddress(locations.toString());



        });
    });
    function finishAjax(id, response, location_id) {
        $("#listinglocationId").val(location_id);
        $('#loader').remove();
        if (response.locations.length > 0) {
            var html = '<div class="col-md-12 column"><div class="form-group"><select name="sublocations[]" class="form-control parent">';
            html += '<option value=""> --- Please Select --- </option>';
            $.each(response.locations, function (index, value) {
                html += '<option value="' + value.id + '"> ' + value.title + ' </option>';
            });
            html += '</select></div></div>';
        } else {
            html = '';
            $("#listinglocationId").val(location_id);
        }

        $('#' + id).append(html);


    }
<?php if (!empty($location->id)) { ?>
    
        initMap('<?= $location->latitude; ?>', '<?= $location->longitude; ?>', 5);
<?php } ?>




    $('#address-line-1').on('blur', function () {

        locations = getLocationsArray();

        setMapByAddress(locations.toString());
    });

    function getLocationsArray() {
        var addr1 = [];
        $('.parent').each(function () {
            if ($(this).children('option:selected').text() != '') {
                addr1.push($(this).children('option:selected').text());
            }
        });


        var addr2 = $('#address-line-1').val();

        if (addr2 != '') {
            addr1.push(addr2);
        }

        if (addr1.length) {
            addr1.reverse();
        }


        var loc = [];
        $(addr1).each(function (index, val) {
            if (val != "") {
                loc.push(val.replace(/\_/g, ""));
            }
        });
        return loc;
    }



<?php $this->Html->scriptEnd(); ?>


</script>