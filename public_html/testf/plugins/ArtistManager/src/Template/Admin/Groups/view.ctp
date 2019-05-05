<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $group
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Group'); ?>  <small>Group Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="groups">
<div class="groups box">
    <div class="box-header">
            <h3 class="box-title"><?= h($group->name) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('S. No') ?></th>
            <td><?= $this->Number->format($group->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($group->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($group->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($group->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $group->status ? __('Enable') : __('Disable'); ?></td>
        </tr>
    </table>
    <div class="row related">
        <div class="col-md-12">
        <?php if (!empty($group->artists)): ?>
        <h4><?= __('Related Artists') ?></h4>
        <table class="table table-hover table-striped" cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('S. No.') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <!--<th scope="col" class="actions"><?= __('Actions') ?></th>-->
            </tr>
            <?php foreach ($group->artists as $artists): ?>
            <tr>
                <td><?= h($artists->id) ?></td>
                <td><?= h($artists->name) ?></td>
                <td><?= h($artists->status ? __('Enable') : __('Disable')) ?></td>
                <td><?= h($artists->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
                <?php /* ?>
                <td class="actions">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'Artists', 'action' => 'view', $artists->id],['class' => 'btn btn-warning btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Detail'),'title'=>__('View Detail')]) ?>
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'Artists', 'action' => 'edit', $artists->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit'),'title'=>__('Edit Detail')]) ?>
                    
                    <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'Artists', 'action' => 'delete', $artists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $artists->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                </td>
                <?php */ ?>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
    </div>
    </div>

</div>
</section>
