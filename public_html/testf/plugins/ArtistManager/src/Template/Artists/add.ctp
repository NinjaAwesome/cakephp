<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $artist
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Artists'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="artists form large-9 medium-8 columns content">
    <?= $this->Form->create($artist) ?>
    <fieldset>
        <legend><?= __('Add Artist') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('status');
            echo $this->Form->control('groups._ids', ['options' => $groups]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
