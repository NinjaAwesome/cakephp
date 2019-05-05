<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $collabed
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Collabed'), ['action' => 'edit', $collabed->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Collabed'), ['action' => 'delete', $collabed->id], ['confirm' => __('Are you sure you want to delete # {0}?', $collabed->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Collabeds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Collabed'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Banners'), ['controller' => 'Banners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Banner'), ['controller' => 'Banners', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="collabeds view large-9 medium-8 columns content">
    <h3><?= h($collabed->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Banner') ?></th>
            <td><?= $collabed->has('banner') ? $this->Html->link($collabed->banner->title, ['controller' => 'Banners', 'action' => 'view', $collabed->banner->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($collabed->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($collabed->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Artist Id 1') ?></th>
            <td><?= $this->Number->format($collabed->artist_id_1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Artist Id 2') ?></th>
            <td><?= $this->Number->format($collabed->artist_id_2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($collabed->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($collabed->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $collabed->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
