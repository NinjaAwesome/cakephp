<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Event'); ?> <small>
            <?php echo empty($event->id) ? __('Add New event') : __('Edit event'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>


<!-- Main content -->
<section class="content" data-table="events">
    <div class="box box-info events">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($event->id) ? 'Add Event' : 'Edit Event') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php $this->loadHelper('Form', ['templates' => 'default_form']); ?>
        <?= $this->Form->create($event, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-a" data-toggle="tab">General</a></li>
                            <li><a href="#tab-b" data-toggle="tab">Event Banner</a></li>
                            <li><a href="#tab-c" data-toggle="tab">Event Image</a></li>
                            <li><a href="#tab-d" data-toggle="tab">Description</a></li>
                            <li><a href="#tab-e" data-toggle="tab">Meta Data</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-a">
                                <section>
                                    <div class="row fontawesome-icon-list">
                                        <!--                                        <div class="col-md-6">
                                        <?php //echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-control']); ?>
                                                                                </div>-->
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->control('title', ['class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Title')]);
                                            echo $this->Form->control('start_date', ['type' => 'text', 'class' => 'form-control datepicker', 'required' => FALSE, 'placeholder' => 'YYYY-mm-dd', 'readonly' => true]);
                                            echo $this->Form->control('end_date', ['type' => 'text', 'class' => 'form-control datepicker', 'required' => FALSE, 'placeholder' => 'YYYY-mm-dd', 'readonly' => true]);
                                            echo $this->Form->control('organizar_name', ['class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Organizar Name')]);
                                            echo $this->Form->control('organizer_email', ['class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Organizer Email')]);
                                            ?>
                                        </div>                                                                             
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->control('location', ['class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Location')]);
                                            ?>
                                                <?php
                                            echo $this->Form->control('amount', ['type' => 'text', 'class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Amount')]);
                                            echo $this->Form->control('max_participants', ['type' => 'text', 'class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Max Participants')]);
                                            echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                                            //echo $this->Form->control('is_join', ['type' => 'checkbox', 'class' => 'minimal']);
                                            //echo $this->Form->control('is_register', ['type' => 'checkbox', 'class' => 'minimal']);
                                            //echo $this->Form->control('is_paid', ['type' => 'checkbox', 'class' => 'minimal']);
                                            ?>
                                            <div class="checkbox icheck">
                                                <?php
                                                echo $this->Form->input('is_join', ['type' => 'checkbox', 'class' => 'minimal', 'label' => ['text' => ' &nbsp; Is Join', 'style' => 'display:block; font-weight:bold;', 'escape' => false],
                                                    'templates' => [
                                                        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                                        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
                                                        'inputContainer' => '{{content}}',
                                                        'error' => '<div class="col-md-8 error-message text-danger">{{content}}</div>',
                                                ]]);
                                                ?>
                                            </div>
                                            <div class="checkbox icheck">
                                                <?php
                                                echo $this->Form->input('is_register', ['type' => 'checkbox', 'class' => 'minimal', 'label' => ['text' => ' &nbsp; Is Register', 'style' => 'display:block; font-weight:bold;', 'escape' => false],
                                                    'templates' => [
                                                        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                                        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
                                                        'inputContainer' => '{{content}}',
                                                        'error' => '<div class="col-md-8 error-message text-danger">{{content}}</div>',
                                                ]]);
                                                ?>
                                            </div>
                                            <div class="checkbox icheck">
                                                <?php
                                                echo $this->Form->input('is_paid', ['type' => 'checkbox', 'class' => 'minimal', 'label' => ['text' => ' &nbsp; Is Paid', 'style' => 'display:block; font-weight:bold;', 'escape' => false],
                                                    'templates' => [
                                                        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                                        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
                                                        'inputContainer' => '{{content}}',
                                                        'error' => '<div class="col-md-8 error-message text-danger">{{content}}</div>',
                                                ]]);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane" id="tab-b">
                                <div class="row fontawesome-icon-list">
                                    <div class="col-md-12 imageBox" id="imageBox-0">
                                        <h4>Event Banner</h4>
                                        <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                            <?php echo $this->Glide->image(($event->banner_image != '' ? $event->banner_image : 'no_image.gif'), ['w' => '150', 'h' => '150'], ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                        </a>
                                        <?php echo $this->Form->control('banner_image', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-c">
                                <div class="row fontawesome-icon-list">
                                    <div class="col-md-12">
                                        <h4>Event Image</h4>
                                        <table id="bannewrImages" class="table table-striped table-bordered table-hover">
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
                                                //pr($event->event_documents);
                                                if (!empty($event->event_documents)) {
                                                    foreach ($event->event_documents as $key => $bannerImg) {
                                                        ?>
                                                        <tr id="imageBox-<?= $key; ?>" class="row-<?= $bannerImg->id; ?> imageBox">
                                                            <td class="text-center">
                                                                <?php
                                                                echo $this->Form->control('event_documents.' . $key . '.id', ['type' => 'hidden']);
                                                                echo $this->Form->control('event_documents.' . $key . '.caption', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => __('caption'), 'label' => false, 'rows' => '2', 'cols' => '20']);
                                                                ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>">
                                                                    <?php echo $this->Glide->image(($bannerImg->file_name != '' ? $bannerImg->file_name : 'no_image.gif'), ['w' => '150', 'h' => '150'], ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                                                </a>
                                                                <?php echo $this->Form->control('event_documents.' . $key . '.file_name', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?=
                                                                $this->Form->control('event_documents.' . $key . '.sort_order', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Sort Order'), 'label' => false, 'templates' => [
                                                                        'error' => '<div class="col-md-6 error-message text-danger">{{content}}</div>',
                                                                        'input' => '<div class="col-md-6"><input type="{{type}}" name="{{name}}"{{attrs}}/></div>',
                                                                ]]);
                                                                ?>
                                                            </td>
                                                            <td class="text-right">
                                                                <button type="button" data-url="<?php echo $this->Url->build(["controller" => 'Banners', "action" => "deleteImages", $bannerImg->id]); ?>" data-toggle="tooltip" data-title="<?= __('Add Banner') ?>" title="Remove" class="btn btn-danger deleteTableData">
                                                                    <i class="fa fa-minus-circle"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        //$key++;  
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

                                    <!--                                    <div class="col-md-12">
                                                                            <h4>Event Video</h4>
                                                                            <table id="bannerVideo" class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-left" style="width: 30%;">Caption</th>
                                                                                        <th class="text-left" style="width: 20%;">Video Code</th>
                                                                                        <th class="text-left" style="width: 30%;">Sort Order</th>
                                                                                        <th  style="width: 20%;"></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                    <?php
                                    //$key = 0;
                                    ?>
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <td class="text-right" colspan="5">
                                                                                            <button type="button" onclick="addVideo();" data-toggle="tooltip" title="<?= __('Add Video') ?>" class="btn btn-primary">
                                                                                                <i class="fa fa-plus-circle"></i>
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>-->
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-d">
                                <div class="row fontawesome-icon-list">
                                    <div class="col-md-12">
                                        <?php
                                        echo $this->Form->control('short_description', ['type' => 'textarea', 'class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Short Description')]);
                                        echo $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control ckeditor', 'required' => FALSE, 'placeholder' => __('Description')]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-e">
                                <div class="row fontawesome-icon-list">
                                    <div class="col-md-12">
                                        <?php
                                        echo $this->Form->control('meta_title', ['class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Meta Title')]);
                                        echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Meta Keyword')]);
                                        echo $this->Form->control('meta_description', ['class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Meta Description')]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit')]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
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
?>
<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>
    $('.datepicker').datetimepicker({
        minView: 2,
        format: 'yyyy-mm-dd',
        'showTimepicker': false,
        autoclose: true,
    });
    var image_row     = <?= ($key + 1) ?>;
            function addImage(language_id) {
            html = '<tr id="imageBox-' + image_row + '" class="imageBox"><input type="hidden" name="event_documents[' + image_row + '][file_type]" value="1"/>';
            html += '  <td class="text-left"><textarea name="event_documents[' + image_row + '][caption]" placeholder="Caption" class="form-control"></textarea></td>';
            html += '  <td class="text-left"><a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-center" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>"><img src="<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif" width="150" height="115"  data-placeholder="<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif" /></a><input type="hidden" name="event_documents[' + image_row + '][file_name]" value="" id="input-image' + image_row + '" class="input-image" /></td>';
            html += '  <td class="text-left"><input type="text" name="event_documents[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';
            html += '  <td class="text-right"><button type="button" onclick="$(\'#imageBox-' + image_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';
            $('table#bannewrImages tbody').append(html);
        image_row++;
        }
            $(document).ready(function () {
                $('input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_minimal-blue',
            increaseArea: '20%' // optional
        });
    });

//    function addVideo(language_id) {
//        html = '<tr id="imageBox-' + image_row + '" class="imageBox"><input type="hidden" name="event_documents[' + image_row + '][file_type]" value="2"/>';
//        html += '  <td class="text-center"><textarea name="event_documents[' + image_row + '][caption]" placeholder="Caption" class="form-control"></textarea></td>';
//        html += '  <td class="text-left"><input type="text" name="event_documents[' + image_row + '][file_name]" value="" placeholder="Video Code" id="input-image' + image_row + '" class="form-control" /></td>';
//        html += '  <td class="text-center"><input type="text" name="event_documents[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';
//        html += '  <td class="text-right"><button type="button" onclick="$(\'#imageBox-' + image_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
//        html += '</tr>';
//        $('table#bannerVideo tbody').append(html);
//        image_row++;
//    }
////    $(document).ready(function () {
////        $(".box-footer").on("click", function () {
////            //var text = $(".tab-content").find(".error-message").text();
////            var text = $(".tab-content").hasClass("error-message");
////            alert(text);
////        });
////    });
<?php $this->Html->scriptEnd(); ?>
</script>

