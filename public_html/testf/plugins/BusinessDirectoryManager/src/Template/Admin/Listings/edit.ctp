<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $listing
 */
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
        </div><!-- /.box-header -->
        <?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);
        ?>
        <?= $this->Form->create($listing, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control']);
                    echo $this->Form->control('industry_id', ['options' => $industries, 'class' => 'form-control']);
                    echo $this->Form->control('location_id', ['options' => $locations, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('company_name', ['class' => 'form-control', 'placeholder' => __('Company Name')]);
                    echo $this->Form->control('company_mobile_no', ['class' => 'form-control', 'placeholder' => __('Company Mobile No')]);
                    echo $this->Form->control('business_name', ['class' => 'form-control', 'placeholder' => __('Business Name')]);
                    echo $this->Form->control('contact_person_name', ['class' => 'form-control', 'placeholder' => __('Contact Person Name')]);
                    echo $this->Form->control('contact_person_designation', ['class' => 'form-control', 'placeholder' => __('Contact Person Designation')]);
                    echo $this->Form->control('contact_person_email', ['class' => 'form-control', 'placeholder' => __('Contact Person Email')]);
                    echo $this->Form->control('contact_person_phone', ['class' => 'form-control', 'placeholder' => __('Contact Person Phone')]);
                    echo $this->Form->control('address_line_1', ['class' => 'form-control', 'placeholder' => __('Address Line 1')]);
                    echo $this->Form->control('address_line_2', ['class' => 'form-control', 'placeholder' => __('Address Line 2')]);
                    echo $this->Form->control('postcode', ['class' => 'form-control', 'placeholder' => __('Postcode')]);
                    echo $this->Form->control('latitude', ['class' => 'form-control', 'placeholder' => __('Latitude')]);
                    echo $this->Form->control('longitude', ['class' => 'form-control', 'placeholder' => __('Longitude')]);
                    echo $this->Form->control('company_fax_no', ['class' => 'form-control', 'placeholder' => __('Company Fax No')]);
                    echo $this->Form->control('company_tollfree_no', ['class' => 'form-control', 'placeholder' => __('Company Tollfree No')]);
                    echo $this->Form->control('company_email', ['class' => 'form-control', 'placeholder' => __('Company Email')]);
                    echo $this->Form->control('company_website', ['class' => 'form-control', 'placeholder' => __('Company Website')]);
                    echo $this->Form->control('video', ['class' => 'form-control', 'placeholder' => __('Video')]);
                    echo $this->Form->control('logo', ['class' => 'form-control', 'placeholder' => __('Logo')]);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                    echo $this->Form->control('sort_order', ['class' => 'form-control', 'placeholder' => __('Sort Order')]);
                    echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('banner_image', ['class' => 'form-control', 'placeholder' => __('Banner Image')]);
                    echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                    echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
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
