<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $collabed
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $collabed->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $collabed->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Collabeds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Banners'), ['controller' => 'Banners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Banner'), ['controller' => 'Banners', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="collabeds form large-9 medium-8 columns content">
    <?= $this->Form->create($collabed) ?>
    <fieldset>
        <legend><?= __('Edit Collabed') ?></legend>
        <?php
            echo $this->Form->control('artist_id_1');
            echo $this->Form->control('artist_id_2');
            echo $this->Form->control('banner_id', ['options' => $banners]);
            echo $this->Form->control('image');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
