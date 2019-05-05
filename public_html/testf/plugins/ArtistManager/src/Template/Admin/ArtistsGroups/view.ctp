<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $artistsGroup
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Artists Group'); ?>  <small>Artists Group Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="artistsGroups">
<div class="artistsGroups box">
    <div class="box-header">
            <h3 class="box-title"><?= h($artistsGroup->id) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Artist') ?></th>
            <td><?= $artistsGroup->has('artist') ? $this->Html->link($artistsGroup->artist->name, ['controller' => 'Artists', 'action' => 'view', $artistsGroup->artist->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Group') ?></th>
            <td><?= $artistsGroup->has('group') ? $this->Html->link($artistsGroup->group->name, ['controller' => 'Groups', 'action' => 'view', $artistsGroup->group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($artistsGroup->id) ?></td>
        </tr>
    </table>
    </div>

</div>
</section>
