<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $collabed
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Collabed'); ?>  <small>Collabed Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="collabeds">
<div class="collabeds box">
    <div class="box-header">
            <h3 class="box-title"><?= h($collabed->id) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('S. No.') ?></th>
            <td><?= $this->Number->format($collabed->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Banner') ?></th>
            <td><?= $collabed->has('banner') ? $this->Html->link($collabed->banner->title, ['controller' => 'Banners', 'action' => 'view','plugin'=>'BannerManager', $collabed->banner->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($collabed->image) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Artist 1') ?></th>
            <td><?= $this->Number->format($collabed->artist_1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Artist 2') ?></th>
            <td><?= $this->Number->format($collabed->artist_2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($collabed->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($collabed->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $collabed->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    </div>

</div>
</section>
