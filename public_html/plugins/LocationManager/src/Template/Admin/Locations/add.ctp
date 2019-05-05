<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $location
 */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        <?php echo __('Manage Location'); ?> <small>
            <?php echo empty($location->id) ? __('Add New location') : __('Edit location'); ?>
        </small>
    </h1>
    <?= $this->element('breadcrumb'); ?>
</section>
<section class="content" data-table="locations">
    <div class="box box-info locations">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($location->id) ? 'Add Location' : 'Edit Location') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);

        ?>
        <?= $this->Form->create($location, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?php
                        echo $this->Form->control('parent_id', ['options' => $parentLocations, 'class' => 'form-control', 'empty' => 'Select Parent']);
                        echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                        echo $this->Form->control('iso_alpha2_code', ['class' => 'form-control', 'placeholder' => __('Iso Alpha2 Code')]);
                        echo $this->Form->control('iso_alpha3_code', ['class' => 'form-control', 'placeholder' => __('Iso Alpha3 Code')]);
                        echo $this->Form->control('iso_numeric_code', ['class' => 'form-control', 'placeholder' => __('Iso Numeric Code')]);
                        echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                        echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                        echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                    ?>
                </div>
                <div class="col-md-6">
                    <div id="map" style="width:100%;height:380px;border:1px solid #999;position:relative; margin-top:5;"></div>
                    <div class="row margin-top-10" style="margin-top: 10px;">
                        <div class="col-md-2">
                            <button class="btn btn-success btn-block validateAddress" type="button" id="validateAddress"><i class="fa fa-map-marker"></i> Locate</button>
                        </div>
                        <div class="col-md-5">
                            <?php echo $this->Form->control("latitude", array("type" => "text", "placeholder" => "Latitude", "class" => "form-control", "label" => false)); ?>
                        </div>
                        <div class="col-md-5">
                            <?php echo $this->Form->control("longitude", array("type" => "text", "placeholder" => "Longitude", "class" => "form-control", "label" => false)); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->Form->control('formatted_address', ['class' => 'form-control', 'placeholder' => __('Formatted Address')]); ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']); ?>
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
<?php $this->Html->script(['LocationManager.location','https://maps.google.com/maps/api/js?key='.Configure::read('Setting.GOOGLE_MAP_KEY').'&v=3&libraries=places&callback=initMap'], ['block' => true]); ?>

<?php $this->Html->scriptStart(['block' => true]); ?>

    <?php if(!empty($location->id)){ ?>
        initMap('<?= $location->latitude?>', '<?= $location->longitude?>', 15);
    <?php } ?>

     $('#validateAddress').on('click', function () {
        locations = getLocationsArray();
        setMapByAddress(locations.toString());
    });
    $('#title').on('blur change', function () {
        locations = getLocationsArray();
        setMapByAddress(locations.toString());
    });
    function getLocationsArray() {
        var addr1 = $('#parent-id').val() != "" ? $('#parent-id option:selected').text() : '';
        var addr2 = $('#title').val();
        locationArr = [addr1, addr2];
        var loc = [];
        $(locationArr).each(function (index, val) {
            if (val != "") {
                loc.push(val.replace(/\_/g,""));
            }
        });
        return loc;
    }
<?php $this->Html->scriptEnd(); ?>