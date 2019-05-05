<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $banner
 */

?>
<section class="content-header">
    <h1>
       <?php echo __('Manage Banner'); ?>  <small>Banner Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="banners">
<div class="banners box">
    <div class="box-header">
            <h3 class="box-title"><?= h($banner->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
        <table class="table table-hover table-striped">
            <tr>
                <th scope="row"><?= __('S. No') ?></th>
                <td><?= $this->Number->format($banner->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($banner->title) ?></td>
            </tr>

            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($banner->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($banner->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Status') ?></th>
                <td><?= $banner->status ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
        <div class="row related">
            <div class="col-md-12">
                <h4><?= __('Related Banner Image') ?></h4>
                <?php if (!empty($banner->image)): ?>
                    <?= $this->Html->image('uploads/banners/'.$banner->image,['style' => 'width:100%']) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
</section>
