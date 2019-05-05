<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $banner
 */

?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Banner'); ?> <small>
            <?php echo empty($banner->id) ? __('Add New banner') : __('Edit banner'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="banners">
    <div class="box box-info banners">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($banner->id) ? 'Add Banner' : 'Edit Banner') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'horizontal_form',
        ]);

        ?>
        <?= $this->Form->create($banner, ['novalidate' => true,'role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                    echo $this->Form->control('image_file', ['type' => 'file', 'class' => 'form-control', 'placeholder' => __('Upload png image')]);

                    ?>
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
<?php $this->Html->script(['GalleryManager.common'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    var image_row = <?= ($key+1)?>;
    function addImage(language_id) {
    html = '<tr id="imageBox-' + image_row + '" class="imageBox">';
    html += '  <td class="text-left"><input type="text" name="banner_images[' + image_row + '][title]" placeholder="Title" class="form-control" /></td>';
    html += '  <td class="text-left"><input type="text" name="banner_images[' + image_row + '][external_link]" placeholder="Link" class="form-control" /></td>';
    html += '  <td class="text-left"><textarea name="banner_images[' + image_row + '][description]" placeholder="Description" class="form-control"></textarea></td>';
    
    html += '  <td class="text-center"><a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url="<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>"><img src="<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif" style="width:100px" data-placeholder="<?php echo $this->request->getAttribute('webroot'); ?>img/no_image.gif" /></a><input type="hidden" name="banner_images[' + image_row + '][image]" value="" id="input-image' + image_row + '" class="input-image" /></td>';
    
    html += '  <td class="text-right"><input type="text" name="banner_images[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';
    
    html += '  <td class="text-left"><button type="button" onclick="$(\'#imageBox-' + image_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';
    $('table#bannewrImages tbody').append(html);
    image_row++;
    }
<?php $this->Html->scriptEnd(); ?>
</script>