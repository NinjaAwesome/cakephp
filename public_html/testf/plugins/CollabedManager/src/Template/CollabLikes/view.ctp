<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $collabLike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Collab Like'), ['action' => 'edit', $collabLike->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Collab Like'), ['action' => 'delete', $collabLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $collabLike->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Collab Likes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Collab Like'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="collabLikes view large-9 medium-8 columns content">
    <h3><?= h($collabLike->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ip Address') ?></th>
            <td><?= h($collabLike->ip_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($collabLike->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Collab Id') ?></th>
            <td><?= $this->Number->format($collabLike->collab_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($collabLike->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($collabLike->modified) ?></td>
        </tr>
    </table>
</div>
