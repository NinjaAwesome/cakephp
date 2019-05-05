<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $evoption
 */
?>

<section class="content-header">
    <h1>
       <?php echo __('Manage Evoption'); ?>  <small>Evoption Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>
    
<section class="content" data-table="evoptions">
<div class="evoptions box">
    <div class="box-header">
            <h3 class="box-title"><?= h($evoption->title) ?></h3>
    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
    </div>
    <div class="box-body">
    <table class="table table-hover table-striped">
        <tr>
            <th scope="row"><?= __('Option Type') ?></th>
            <td><?= h($evoption->option_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($evoption->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($evoption->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($evoption->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($evoption->sort_order) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($evoption->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($evoption->modified) ?></td>
        </tr>
    </table>
    </div>

</div>
</section>
