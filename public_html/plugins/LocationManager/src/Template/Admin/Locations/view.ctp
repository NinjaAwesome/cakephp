<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $location
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Location'); ?>  <small>Location Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="locations">
<div class="locations box">
    <div class="box-header">
            <h3 class="box-title"><?= h($location->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Parent Location') ?></th>
            <td><?= $this->cell('LocationManager.Location::getParentLocations', [$location->id],[ 'cache' => ['key' => 'cell_location_' . $location->id]]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($location->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= h($location->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= h($location->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iso Alpha2 Code') ?></th>
            <td><?= h($location->iso_alpha2_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iso Alpha3 Code') ?></th>
            <td><?= h($location->iso_alpha3_code) ?></td>
        </tr>
          <tr>
            <th scope="row"><?= __('Iso Numeric Code') ?></th>
            <td><?= $this->Number->format($location->iso_numeric_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Formatted Address') ?></th>
            <td><?= $this->Text->autoParagraph($location->formatted_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Title') ?></th>
            <td><?= h($location->meta_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Keyword') ?></th>
            <td><?= h($location->meta_keyword) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Description') ?></th>
            <td> <?= $this->Text->autoParagraph($location->meta_description); ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $location->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= $location->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $location->status ? __('Active') : __('Inactive'); ?></td>
        </tr>
    </table>
  </div>

</div>
</section>
