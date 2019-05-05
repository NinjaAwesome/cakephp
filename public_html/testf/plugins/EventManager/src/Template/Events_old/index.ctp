<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $events
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?></li>
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
<div class="events index large-9 medium-8 columns content">
    <h3><?= __('Events') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('short_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organizar_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('organizer_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('banner_image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('max_participants') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meta_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meta_keyword') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_join') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_register') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_paid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= $this->Number->format($event->id) ?></td>
                <td><?= $event->has('user') ? $this->Html->link($event->user->id, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?></td>
                <td><?= h($event->title) ?></td>
                <td><?= h($event->short_description) ?></td>
                <td><?= h($event->location) ?></td>
                <td><?= h($event->organizar_name) ?></td>
                <td><?= h($event->organizer_email) ?></td>
                <td><?= h($event->banner_image) ?></td>
                <td><?= $this->Number->format($event->amount) ?></td>
                <td><?= $this->Number->format($event->max_participants) ?></td>
                <td><?= h($event->start_date) ?></td>
                <td><?= h($event->end_date) ?></td>
                <td><?= h($event->meta_title) ?></td>
                <td><?= h($event->meta_keyword) ?></td>
                <td><?= h($event->is_join) ?></td>
                <td><?= h($event->is_register) ?></td>
                <td><?= h($event->is_paid) ?></td>
                <td><?= h($event->status) ?></td>
                <td><?= h($event->created) ?></td>
                <td><?= h($event->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $event->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
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
