<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $event->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Bookings'), ['controller' => 'EventBookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Booking'), ['controller' => 'EventBookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Images'), ['controller' => 'EventDocuments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Image'), ['controller' => 'EventDocuments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Joins'), ['controller' => 'EventJoins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Join'), ['controller' => 'EventJoins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Reviews'), ['controller' => 'EventReviews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Review'), ['controller' => 'EventReviews', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Edit Event') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('title');
            echo $this->Form->control('short_description');
            echo $this->Form->control('description');
            echo $this->Form->control('location');
            echo $this->Form->control('organizar_name');
            echo $this->Form->control('organizer_email');
            echo $this->Form->control('banner_image');
            echo $this->Form->control('amount');
            echo $this->Form->control('max_participants');
            echo $this->Form->control('start_date');
            echo $this->Form->control('end_date');
            echo $this->Form->control('meta_title');
            echo $this->Form->control('meta_keyword');
            echo $this->Form->control('meta_description');
            echo $this->Form->control('is_join');
            echo $this->Form->control('is_register');
            echo $this->Form->control('is_paid');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
