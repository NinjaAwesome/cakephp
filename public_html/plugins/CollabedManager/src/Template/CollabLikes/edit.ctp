<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $collabLike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $collabLike->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $collabLike->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Collab Likes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="collabLikes form large-9 medium-8 columns content">
    <?= $this->Form->create($collabLike) ?>
    <fieldset>
        <legend><?= __('Edit Collab Like') ?></legend>
        <?php
            echo $this->Form->control('collab_id');
            echo $this->Form->control('ip_address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
