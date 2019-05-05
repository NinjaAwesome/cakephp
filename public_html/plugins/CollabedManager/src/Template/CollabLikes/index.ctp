<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $collabLikes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Collab Like'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="collabLikes index large-9 medium-8 columns content">
    <h3><?= __('Collab Likes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('collab_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($collabLikes as $collabLike): ?>
            <tr>
                <td><?= $this->Number->format($collabLike->id) ?></td>
                <td><?= $this->Number->format($collabLike->collab_id) ?></td>
                <td><?= h($collabLike->ip_address) ?></td>
                <td><?= h($collabLike->created) ?></td>
                <td><?= h($collabLike->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $collabLike->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $collabLike->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $collabLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $collabLike->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
