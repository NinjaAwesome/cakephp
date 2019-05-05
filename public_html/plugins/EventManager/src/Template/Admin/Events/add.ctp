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
        <?php
        //dump($error);
        ?>
        <div class="box-body">
            <?php 
            $erArray = [];
            $errors = $this->Common->errorMessage($event->getErrors(), $erArray);
            if (!empty($errors)) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo "<p>".implode("</p><p>", $errors) ."</p>"; ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="tabA active"><a href="#tab-a" data-toggle="tab">General</a></li>
                            <li class="tabB"><a href="#tab-b" data-toggle="tab">Event Banner</a></li>
                            <li class="tabC"><a href="#tab-c" data-toggle="tab">Event Image</a></li>
                            <li class="tabD"><a href="#tab-d" data-toggle="tab">Description</a></li>
                            <li class="tabE"><a href="#tab-e" data-toggle="tab">Meta Data</a></li>
                            <li class="tabF"><a href="#tab-f" data-toggle="tab">Add ons</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-a">
                                <section>
                                    <div class="row fontawesome-icon-list">
                                        <!--                                        <div class="col-md-6">
                                        <?php //echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-control']);  ?>
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
                                            echo $this->Form->control('amount', ['type' => 'text', 'class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Amount')]);
                                            echo $this->Form->control('max_participants', ['type' => 'text', 'class' => 'form-control', 'required' => FALSE, 'placeholder' => __('Max Participants')]);
                                            echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                                            ?>
                                            <div class="checkbox icheck">
                                                <?php
                                                echo $this->Form->control('is_join', ['type' => 'checkbox', 'class' => 'minimal', 'label' => ['text' => ' &nbsp; Allow to join users', 'style' => 'display:block; font-weight:bold;', 'escape' => false],
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
                                                echo $this->Form->control('is_register', ['type' => 'checkbox', 'class' => 'minimal', 'label' => ['text' => ' &nbsp; Allow to registration', 'style' => 'display:block; font-weight:bold;', 'escape' => false],
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
                                                echo $this->Form->control('is_paid', ['type' => 'checkbox', 'class' => 'minimal', 'label' => ['text' => ' &nbsp; Allow payment options', 'style' => 'display:block; font-weight:bold;', 'escape' => false],
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
                                                if (!empty($event->event_images)) {
                                                    foreach ($event->event_images as $key => $bannerImg) {
                                                        ?>
                                                        <tr id="imageBox-<?= $key; ?>" class="row-<?= $bannerImg->id; ?> imageBox">
                                                            <td class="text-center">
                                                                <?php
                                                                echo $this->Form->control('event_images.' . $key . '.id', ['type' => 'hidden']);
                                                                echo $this->Form->control('event_images.' . $key . '.file_type', ['type' => 'hidden','value' => 1]);
                                                                echo $this->Form->control('event_images.' . $key . '.caption', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => __('caption'), 'label' => false, 'rows' => '2', 'cols' => '20',
                                                                    'templates' => ['error' => '<div class="error-message text-danger text-left">{{content}}</div>']]);
                                                                ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>">
                                                                    <?php echo $this->Glide->image(($bannerImg->file_name != '' ? $bannerImg->file_name : 'no_image.gif'), ['w' => '150', 'h' => '150'], ['style' => 'width:100%', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                                                </a>
                                                                <?php echo $this->Form->control('event_images.' . $key . '.file_name', ['type' => 'hidden', 'class' => 'form-control input-image']); ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?=
                                                                $this->Form->control('event_images.' . $key . '.sort_order', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Sort Order'), 'label' => false, 'templates' => [
                                                                        'error' => '<div class="col-md-12 error-message text-danger">{{content}}</div>',
                                                                        'input' => '<div class="col-md-6"><input type="{{type}}" name="{{name}}"{{attrs}}/></div>',
                                                                ]]);
                                                                ?>
                                                            </td>
                                                            <td class="text-right">
                                                                <?php if(isset($bannerImg->id)){ ?>
                                                                <button type="button" data-url="<?php echo $this->Url->build(["controller" => 'Events', "action" => "deleteImages", $bannerImg->id]); ?>" data-toggle="tooltip" data-title="<?= __('Add Banner') ?>" title="Remove" class="btn btn-danger deleteTableData">
                                                                    <i class="fa fa-minus-circle"></i>
                                                                </button>
                                                                <?php }else{ ?>
                                                                <button type="button" onclick="$('#imageBox-<?= $key; ?>').remove();"  data-toggle="tooltip" data-title="<?= __('Add Banner') ?>" title="Remove" class="btn btn-danger">
                                                                    <i class="fa fa-minus-circle"></i>
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

                                    <div class="col-md-12">
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
                                                $keyVideo = 0;
                                                if (!empty($event->event_videos)) {
                                                    foreach ($event->event_videos as $keyVideo => $video) {
                                                        ?>
                                                        <tr id="videoBox-<?= $keyVideo; ?>" class="row-<?= $video->id; ?> videoBox">
                                                            <td class="text-center">
                                                                <?php
                                                                echo $this->Form->control('event_videos.' . $keyVideo . '.id', ['type' => 'hidden']);
                                                                echo $this->Form->control('event_videos.' . $keyVideo . '.file_type', ['type' => 'hidden','value' => 2]);
                                                                echo $this->Form->control('event_videos.' . $keyVideo . '.caption', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => __('caption'), 'label' => false, 'rows' => '2', 'cols' => '20',
                                                                    'templates' => ['error' => '<div class="error-message text-danger text-left">{{content}}</div>']]);
                                                                ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?php echo $this->Form->control('event_videos.' . $keyVideo . '.file_name', ['type' => 'text', 'label' => false, 'class' => 'form-control']); ?>
                                                            </td>
                                                            <td class="text-left">
                                                                <?=
                                                                $this->Form->control('event_videos.' . $keyVideo . '.sort_order', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Sort Order'), 'label' => false, 'templates' => [
                                                                        'error' => '<div class="col-md-12 error-message text-danger">{{content}}</div>',
                                                                        'input' => '<div class="col-md-6"><input type="{{type}}" name="{{name}}"{{attrs}}/></div>',
                                                                ]]);
                                                                ?>
                                                            </td>
                                                            <td class="text-right">
                                                                <?php if(isset($video->id)){ ?>
                                                                <button type="button" data-url="<?php echo $this->Url->build(["controller" => 'Events', "action" => "deleteImages", $video->id]); ?>" data-toggle="tooltip" data-title="<?= __('Add Banner') ?>" title="Remove" class="btn btn-danger deleteTableData">
                                                                    <i class="fa fa-minus-circle"></i>
                                                                </button>
                                                                <?php }else{ ?>
                                                                <button type="button" onclick="$('#videoBox-<?= $keyVideo; ?>').remove();"  data-toggle="tooltip" data-title="<?= __('Add Video') ?>" title="Remove" class="btn btn-danger">
                                                                    <i class="fa fa-minus-circle"></i>
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
                                                        <button type="button" onclick="addVideo();" data-toggle="tooltip" title="<?= __('Add Video') ?>" class="btn btn-primary">
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
                            <div class="tab-pane" id="tab-f">
                                <h4 class="page-header">Add Ons services</h4>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <ul class="nav nav-pills nav-stacked" id="option">
                                            <?php $option_row = 0; ?>
                                            <?php if (isset($event->event_options)) {
                                                //dump($event->event_options);
                                                foreach ($event->event_options as $event_option) { ?>
                                                    <li <?php echo $option_row == 0 ? "class='active'" : ""; ?>>
                                                        <a href="#tab-option<?php echo $option_row; ?>" data-toggle="tab">
                                                            <?php if(isset($event_option->id) && !empty($event_option->id)){ ?>
                                                            <i class="fa fa-minus-circle" onclick='if (confirm("Are you sure you want to delete #<?php echo $event_option->value; ?> ?")) {
                                                                                            window.location.href = "<?php echo $this->Url->build(['controller' => 'Events', 'action' => 'eventOptionDelete', $event_option->id]); ?>";
                                                                                        }
                                                                                        event.returnValue = false;
                                                                                        return false;'>
                                                            </i> 
                                                            <?php }else{ ?>
                                                            <i class="fa fa-minus-circle" onclick='if (confirm("Are you sure you want to delete #<?php echo $event_option->value; ?> ?")) {
                                                                                           deleteOtionWithVal(<?php echo $option_row; ?>);
                                                                                          }
                                                                                        event.returnValue = false;
                                                                                        return false;'>
                                                            </i> 
                                                            <?php } ?>
                                                            <?php echo $event_option->evoption->title; ?></a></li>
                                                    <?php $option_row++; ?>
                                                <?php }
                                            } ?>
                                            <li>
                                        <?php echo $this->Form->control("option", ['class' => 'form-control', 'id' => 'input-option', 'placeholder' => 'Options', 'type' => 'text', 'label' => false]) ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="tab-content" id="tab-content">
                                            <?php
                                            $option_row = 0;
                                            ?>
                                            <?php
                                            $option_value_row = 0;
                                            $option_value_slab_row = 0;
                                            if (!empty($event->event_options)) {
                                                foreach ($event->event_options as $event_option) {
                                                    ?>
                                                    <div class="tab-pane<?php echo $option_row == 0 ? " active" : ""; ?>" id="tab-option<?php echo $option_row; ?>">
                                                        <?php
                                                        echo $this->Form->control("event_options." . $option_row . ".id", ['type' => 'hidden']);
                                                        echo $this->Form->control("event_options." . $option_row . ".evoption_id", ['type' => 'hidden', 'id' => 'option-id-' . $option_row]);
                                                        echo $this->Form->control("event_options." . $option_row . ".label", ['type' => 'hidden', 'id' => 'option-label-' . $option_row]);
                                                        ?>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-sm-2 control-label" for="input-required<?php echo $option_row; ?>">Required</label>
                                                                <div class="col-sm-10">
                                                        <?php echo $this->Form->control("event_options." . $option_row . ".is_required", ['options' => [1 => 'Yes', 0 => 'No'], 'id' => 'input-required' . $option_row, 'class' => 'form-control', 'label' => false]) ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table id="option-value<?php echo $option_row; ?>" class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr> 
                                                                        <th width="600">Option Value</th>         
                                                                    <?php if ($event_option->evoption->option_type == 'select' || $event_option->evoption->option_type == 'radio' || $event_option->evoption->option_type == 'checkbox') { ?>     
                                                                            <th width="50"></th>      
                                                                    <?php } ?>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="options">
                                                                    <?php
                                                                    $covInc = 0;
                                                                    if ($event_option->evoption->option_type == 'select' || $event_option->evoption->option_type == 'radio' || $event_option->evoption->option_type == 'checkbox') {
                                                                        foreach ($event_option->event_option_values as $event_option_value) {
                                                                            ?>
                                                                            <tr id="option-value-row<?php echo $option_value_row; ?>">
                                                                                    <td>
                                                                                    <?php
                                                                                    echo $this->Form->control("event_options." . $option_row . ".event_option_values." . $covInc . ".evoptions_value_id", ['options' => isset($option_values[$event_option_value->evoption_id]) ? $option_values[$event_option_value->evoption_id] : [], 'class' => 'form-control', 'label' => false]);
                                                                                    echo $this->Form->control("event_options." . $option_row . ".event_option_values." . $covInc . ".id", ['type' => 'hidden', 'label' => false]);
                                                                                    echo $this->Form->control("event_options." . $option_row . ".event_option_values." . $covInc . ".evoption_id", ['type' => 'hidden', 'label' => false]);
                                                                                    ?>
                                                                                    </td>
                                                                                    <td>
                                                                                    <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Remove Option Value" 
                                                                                       onclick="if (confirm('Are you sure you want to delete # 1?')) {
                                                                                                    window.location.href = '<?php echo $this->Url->build(['controller' => 'Events', 'action' => 'optionValueDelete', $event_option_value->id, $option_row]); ?>';
                                                                                                }
                                                                                                event.returnValue = false;
                                                                                                return false;"><i class="fa fa-minus-circle"></i>
                                                                                    </a>
                                                                                    </td>
                                                                                   
                                                                            </tr>
                                                                                    <?php $option_value_row++; ?>
                                                                                    <?php
                                                                                    $covInc++;
                                                                                }
                                                                            } else {
                                                                                ?>
                                                                                <tr id="option-value-row<?php echo $option_value_row; ?>">
                                                                                    <td>
                                                                                        <?php
                                                                                        echo $this->Form->control("event_options." . $option_row . ".value", ['type' => in_array($event_option->evoption->option_type, ["text","textarea"]) ? $event_option->evoption->option_type : "text", 'class' => 'form-control', 'label' => false]);
                                                                                        ?>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php
                                                                                $option_value_row++;
                                                                            }
                                                                        ?>
                                                                </tbody>
                                                                <?php if ($event_option->evoption->option_type == 'select' || $event_option->evoption->option_type == 'radio' || $event_option->evoption->option_type == 'checkbox') { ?>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td colspan="1"></td>
                                                                            <td class="text-left">
                                                                                <button type="button" onclick="addOptionValue('<?php echo $option_row; ?>');" data-toggle="tooltip" title="Add Option Values" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
        <?php } ?>
                                                            </table>
                                                        </div>
                                                    <?php echo $this->Form->control("ovi", ['options' => isset($option_values[$event_option->evoption_id]) ? $option_values[$event_option->evoption_id] : [], 'class' => 'form-control', 'id' => 'option-values' . $option_row, 'label' => false, 'style' => 'display: none;']); ?>
                                                    </div>
        <?php
        $option_row++;
    }
}

?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
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
//$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->css(['/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min'], ['block' => true]);
$this->Html->css(['/assets/plugins/iCheck/square/blue.css'], ['block' => true]);
//$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min'], ['block' => true]);
$this->Html->script(['GalleryManager.common'], ['block' => true]);
$this->Html->script(['/assets/plugins/iCheck/icheck.min'], ['block' => true]);
$this->Html->script(['/js/autocomplete'], ['block' => true]);
?>
<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>
    var start = new Date();
    // set end date to max one year period:
    var end = new Date(new Date().setYear(start.getFullYear() + 1));

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
    
    function deleteOtionWithVal(optionInc){
        $("#option a:first").tab("show");
        $("a[href='#tab-option"+ optionInc +"']").parent().remove(); 
        $("#tab-option"+ optionInc).remove();
        console.log(optionInc);
    }

    var image_row = <?= ($key + 1) ?>;
        function addImage(language_id) {
            html = '<tr id="imageBox-' + image_row + '" class="imageBox"><input type="hidden" name="event_images[' + image_row + '][file_type]" value="1"/>';
            html += '  <td class="text-left"><textarea name="event_images[' + image_row + '][caption]" placeholder="Caption" class="form-control"></textarea></td>';
            html += '  <td class="text-left"><a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-center" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>"><img src="<?php echo $this->request->getAttribute('webroot'); ?>images/no_image.gif?w=150&h=150" width="100%"  data-placeholder="<?php echo $this->request->getAttribute('webroot'); ?>images/no_image.gif" /></a><input type="hidden" name="event_images[' + image_row + '][file_name]" value="" id="input-image' + image_row + '" class="input-image" /></td>';
                    html += '  <td class="text-left"><div class="form-group"><div class="col-md-6"><input type="number" name="event_images[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></div></div></td>';
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

                        var video_row = <?= ($keyVideo + 1) ?>;
                            function addVideo(language_id) {
                                html = '<tr id="videoBox-' + video_row + '" class="videoBox"><input type="hidden" name="event_videos[' + video_row + '][file_type]" value="2"/>';
                                html += '  <td class="text-center"><textarea name="event_videos[' + video_row + '][caption]" placeholder="Caption" class="form-control"></textarea></td>';
                                html += '  <td class="text-left"><input type="text" name="event_videos[' + video_row + '][file_name]" value="" placeholder="Video Code" id="input-image' + video_row + '" class="form-control" /></td>';
                                html += '  <td class="text-center"><div class="form-group"><div class="col-md-6"><input type="number" name="event_videos[' + video_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></div></div></td>';
                                html += '  <td class="text-right"><button type="button" onclick="$(\'#videoBox-' + video_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';
        $('table#bannerVideo tbody').append(html);
                                video_row++;
    }
                                
///////////////////////////////////////////////////
var option_row = <?php echo $option_row; ?>;
//alert(option_row);
$('input[name=\'option\']').autocomplete({
    'source': function(request, response) {
            $.ajax({
                    url: '<?php echo $this->Url->build(['controller' => 'Evoptions', 'action' => 'autocomplete','plugin'=>'EventManager']); ?>',
                    type: 'post',
                    data: {value: encodeURIComponent(request), maxResults: 10},
                    dataType: 'json',
                    beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-Token', '<?php  echo $this->request->getParam('_csrfToken'); ?>');
                    },
                    success: function(json) {
                        //alert(json);
                        response($.map(json, function(item) {
                            return {
                                category: item['category'],
                                label: item['title'],
                                value: item['id'],
                                type: item['type'],
                                evoption_value: item['evoption_value']
                            }
                        }));
                    }
            });
	},
    'select': function(item) {
    console.log(item);
	console.log(item['type']);
        console.log(item['label']);
		html  = '<div class="tab-pane" id="tab-option' + option_row + '">';
		html += '<input type="hidden" name="event_options[' + option_row + '][evoption_id]" value="' + item['value'] + '" />';
		html += '<input type="hidden" name="event_options[' + option_row + '][label]" value="' + item['label'] + '" />';
		html += '<div class="form-group"><div class="row">';
		html += '<label class="col-sm-2 control-label" for="input-is_required' + option_row + '">Required</label>';
		html += '<div class="col-sm-10"><select name="event_options[' + option_row + '][is_required]" id="input-is_required' + option_row + '" class="form-control">';
		html += '<option value="1">Yes</option>';
		html += '<option value="0">No</option>';
		html += '</select></div>';
		html += '</div></div>';

		
		if (item['type'] == 'select' || item['type'] == 'radio' || item['type'] == 'checkbox') {
                    //alert('tetst');
			html += '<div class="table-responsive">';
			html += '  <table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
			html += '  	 <thead>';
			html += '      <tr>';
			html += '        <th width="600">Option Value</th>';
			html += '        <th width="50"></th>';
			html += '      </tr>';
			html += '  	 </thead>';
			html += '  	 <tbody class="options">';
			html += '    </tbody>';
			html += '    <tfoot>';
			html += '      <tr>';
			html += '        <td colspan="1"></td>';
			html += '        <td class="text-left"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="Option Value Add" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
			html += '      </tr>';
			html += '    </tfoot>';
			html += '  </table>';
			html += '</div>';

            html += '<select id="option-values' + option_row + '" style="display: none;">';
            //console.log(item['option_value']);
            for (i = 0; i < item['evoption_value'].length; i++) {
			html += '  <option value="' + item['evoption_value'][i]['id'] + '">' + item['evoption_value'][i]['title'] + '</option>';
            }

            html += '  </select>';
            html += '  <input type="hidden" value="' + item['value'] + '" id="option-id-' + option_row + '">';
			
		}else{
		
			html += '<div class="table-responsive">';
			html += '<table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
			html += '<thead>';
			html += '<tr>';
			html += '<th>Option Value</th>';
			html += '<td></td>';
			html += '</tr>';
			html += '</thead>';
			html += '<tbody>';
			
			html += '<tr>';
			html += '<td> ';
					
                        if (item['type'] != 'textarea') {
                        html += '<input type="text" name="event_options[' + option_row + '][value]" value="" placeholder="Option Value" id="input-value' + option_row + '" class="form-control" />';
                        }else{
                        html += '<textarea name="event_options[' + option_row + '][value]" rows="5" placeholder="Option Value" id="input-value' + option_row + '" class="form-control"></textarea>';
                        }
					
			html += '</td>';
					
			html += '</td>';
			
			html += '</tr>';
			html += '</tbody>';
					
			html += '</table>';
			html += '</div>';
		
		}
		
		
		$('#tab-f #tab-content').append(html);

		$('#option > li:last-child').before('<li><a href="#tab-option' + option_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick=" $(\'#option a:first\').tab(\'show\');$(\'a[href=\\\'#tab-option' + option_row + '\\\']\').parent().remove(); $(\'#tab-option' + option_row + '\').remove();"></i>' + item['label'] + '</a></li>');

		$('#option a[href=\'#tab-option' + option_row + '\']').tab('show');
		
		$('[data-toggle=\'tooltip\']').tooltip({
			container: 'body',
			html: true
		});

	option_row++;
	}
});

  var option_value_row = <?php echo $option_value_row; ?>;
    function addOptionValue(option_row) {
        html = '<tr id="option-value-row' + option_value_row + '">';
        var optval = $('#option-id-' + option_row).val();
        //alert(optval);
        html += '<td> ';
        html += '<select name="event_options[' + option_row + '][event_option_values][' + option_value_row + '][evoptions_value_id]" class="form-control ggg">';
        html += $('#option-values' + option_row).html();
        html += '  </select> ';
        html += ' <input name="event_options[' + option_row + '][event_option_values][' + option_value_row + '][evoption_id]" type="hidden" value="' + optval + '">';
        //html += ' <input name="event_options[' + option_row + '][event_option_values][' + option_value_row + '][option_value]" type="hidden" value="' + optval + '">';
        html += '</td>'; 

  

        html += '  <td><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#option-value' + option_row + ' tbody.options').append(html);
        $('[rel=tooltip]').tooltip();
		$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	  });
        option_value_row++;
    }
	
        
    $(document).ready(function(){
       var dataError = <?php echo json_encode($event->getErrors());?>;
        $.each( dataError, function( key, value ) {
            console.log( value );
            console.log( key + ": " + value['_empty'] );
            var data = $( "input[name='"+key+"'], textarea[name='"+key+"']" ).closest( "div.tab-pane" ).attr("id");
            console.log(key);
            console.log(data);
             $('.nav-tabs a[href="#'+data+'"]').tab('show')
             return false;
         }); 
    });    
<?php $this->Html->scriptEnd(); ?>
</script>

