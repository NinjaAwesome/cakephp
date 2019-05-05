<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $listing
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Listing'); ?>  <small>Listing Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="listings">
<div class="listings box">
    <div class="box-header">
            <h3 class="box-title"><?= h($listing->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Banner Image') ?></th>
            
            <td><?php  echo $this->Html->image($listing->banner_image != '' ? $listing->banner_image: 'no_image.gif', ['alt' => 'CakePHP', 'height' => 40, 'width' => 80]);  ?></td>
        </tr>
       
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td><?php  echo $this->Html->image($listing->logo != '' ? $listing->logo: 'no_image.gif', ['alt' => 'CakePHP', 'height' => 40, 'width' => 80]);  ?></td>
       
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($listing->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Name') ?></th>
            <td><?= h($listing->company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Mobile No') ?></th>
            <td><?= h($listing->company_mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Business Name') ?></th>
            <td><?= h($listing->business_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact Person Name') ?></th>
            <td><?= h($listing->contact_person_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact Person Designation') ?></th>
            <td><?= h($listing->contact_person_designation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact Person Email') ?></th>
            <td><?= h($listing->contact_person_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact Person Phone') ?></th>
            <td><?= h($listing->contact_person_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address Line 1') ?></th>
            <td><?= h($listing->address_line_1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address Line 2') ?></th>
            <td><?= h($listing->address_line_2) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Company Fax No') ?></th>
            <td><?= h($listing->company_fax_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Tollfree No') ?></th>
            <td><?= h($listing->company_tollfree_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Email') ?></th>
            <td><?= h($listing->company_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Website') ?></th>
            <td><?= h($listing->company_website) ?></td>
        </tr>
        
        
        <tr>
            <th scope="row"><?= __('Meta Title') ?></th>
            <td><?= h($listing->meta_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Keyword') ?></th>
            <td><?= h($listing->meta_keyword) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Postcode') ?></th>
            <td><?= $this->Number->format($listing->postcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= ($listing->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($listing->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $listing->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Short Description') ?></h4>
        <?= $this->Text->autoParagraph(h($listing->short_description)); ?>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($listing->description)); ?>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <h4><?= __('Meta Description') ?></h4>
        <?= $this->Text->autoParagraph(h($listing->meta_description)); ?>
    </div>
    </div>
    <div class="row related">
        <div class="col-md-12">
        <h4><?= __('') ?></h4>
        <?php if (!empty($listing->listing_catalogs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Listing Id') ?></th>
                <th scope="col"><?= __('Images') ?></th>
                <th scope="col"><?= __('Caption') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($listing->listing_catalogs as $listingCatalogs): ?>
            <tr>
                <td><?= h($listingCatalogs->id) ?></td>
                <td><?= h($listingCatalogs->listing_id) ?></td>
                <td><?= h($listingCatalogs->images) ?></td>
                <td><?= h($listingCatalogs->caption) ?></td>
                <td><?= h($listingCatalogs->sort_order) ?></td>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'ListingCatalogs', 'action' => 'view', $listingCatalogs->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'ListingCatalogs', 'action' => 'edit', $listingCatalogs->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    </div>

</div>
</section>
