<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Bookings'), ['controller' => 'EventBookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Booking'), ['controller' => 'EventBookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Images'), ['controller' => 'EventDocuments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Image'), ['controller' => 'EventDocuments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Videos'), ['controller' => 'EventDocuments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Video'), ['controller' => 'EventDocuments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Documents'), ['controller' => 'EventDocuments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Document'), ['controller' => 'EventDocuments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Joins'), ['controller' => 'EventJoins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Join'), ['controller' => 'EventJoins', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Reviews'), ['controller' => 'EventReviews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Review'), ['controller' => 'EventReviews', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $event->has('user') ? $this->Html->link($event->user->id, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($event->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Description') ?></th>
            <td><?= h($event->short_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= h($event->location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organizar Name') ?></th>
            <td><?= h($event->organizar_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organizer Email') ?></th>
            <td><?= h($event->organizer_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Banner Image') ?></th>
            <td><?= h($event->banner_image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Title') ?></th>
            <td><?= h($event->meta_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meta Keyword') ?></th>
            <td><?= h($event->meta_keyword) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($event->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($event->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Participants') ?></th>
            <td><?= $this->Number->format($event->max_participants) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($event->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($event->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($event->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Join') ?></th>
            <td><?= $event->is_join ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Register') ?></th>
            <td><?= $event->is_register ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Paid') ?></th>
            <td><?= $event->is_paid ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $event->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($event->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Meta Description') ?></h4>
        <?= $this->Text->autoParagraph(h($event->meta_description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Bookings') ?></h4>
        <?php if (!empty($event->event_bookings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Discount') ?></th>
                <th scope="col"><?= __('Coupon Id') ?></th>
                <th scope="col"><?= __('Total Amount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->event_bookings as $eventBookings): ?>
            <tr>
                <td><?= h($eventBookings->id) ?></td>
                <td><?= h($eventBookings->event_id) ?></td>
                <td><?= h($eventBookings->first_name) ?></td>
                <td><?= h($eventBookings->last_name) ?></td>
                <td><?= h($eventBookings->email) ?></td>
                <td><?= h($eventBookings->mobile) ?></td>
                <td><?= h($eventBookings->address) ?></td>
                <td><?= h($eventBookings->amount) ?></td>
                <td><?= h($eventBookings->discount) ?></td>
                <td><?= h($eventBookings->coupon_id) ?></td>
                <td><?= h($eventBookings->total_amount) ?></td>
                <td><?= h($eventBookings->created) ?></td>
                <td><?= h($eventBookings->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventBookings', 'action' => 'view', $eventBookings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventBookings', 'action' => 'edit', $eventBookings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventBookings', 'action' => 'delete', $eventBookings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventBookings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Documents') ?></h4>
        <?php if (!empty($event->event_images)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('File Type') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Caption') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->event_images as $eventImages): ?>
            <tr>
                <td><?= h($eventImages->id) ?></td>
                <td><?= h($eventImages->event_id) ?></td>
                <td><?= h($eventImages->file_type) ?></td>
                <td><?= h($eventImages->file_name) ?></td>
                <td><?= h($eventImages->caption) ?></td>
                <td><?= h($eventImages->sort_order) ?></td>
                <td><?= h($eventImages->created) ?></td>
                <td><?= h($eventImages->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventDocuments', 'action' => 'view', $eventImages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventDocuments', 'action' => 'edit', $eventImages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventDocuments', 'action' => 'delete', $eventImages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventImages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Documents') ?></h4>
        <?php if (!empty($event->event_videos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('File Type') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Caption') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->event_videos as $eventVideos): ?>
            <tr>
                <td><?= h($eventVideos->id) ?></td>
                <td><?= h($eventVideos->event_id) ?></td>
                <td><?= h($eventVideos->file_type) ?></td>
                <td><?= h($eventVideos->file_name) ?></td>
                <td><?= h($eventVideos->caption) ?></td>
                <td><?= h($eventVideos->sort_order) ?></td>
                <td><?= h($eventVideos->created) ?></td>
                <td><?= h($eventVideos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventDocuments', 'action' => 'view', $eventVideos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventDocuments', 'action' => 'edit', $eventVideos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventDocuments', 'action' => 'delete', $eventVideos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventVideos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Documents') ?></h4>
        <?php if (!empty($event->event_documents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('File Type') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Caption') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->event_documents as $eventDocuments): ?>
            <tr>
                <td><?= h($eventDocuments->id) ?></td>
                <td><?= h($eventDocuments->event_id) ?></td>
                <td><?= h($eventDocuments->file_type) ?></td>
                <td><?= h($eventDocuments->file_name) ?></td>
                <td><?= h($eventDocuments->caption) ?></td>
                <td><?= h($eventDocuments->sort_order) ?></td>
                <td><?= h($eventDocuments->created) ?></td>
                <td><?= h($eventDocuments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventDocuments', 'action' => 'view', $eventDocuments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventDocuments', 'action' => 'edit', $eventDocuments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventDocuments', 'action' => 'delete', $eventDocuments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventDocuments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Joins') ?></h4>
        <?php if (!empty($event->event_joins)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Ip Address') ?></th>
                <th scope="col"><?= __('SessionId') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->event_joins as $eventJoins): ?>
            <tr>
                <td><?= h($eventJoins->id) ?></td>
                <td><?= h($eventJoins->event_id) ?></td>
                <td><?= h($eventJoins->user_id) ?></td>
                <td><?= h($eventJoins->ip_address) ?></td>
                <td><?= h($eventJoins->sessionId) ?></td>
                <td><?= h($eventJoins->created) ?></td>
                <td><?= h($eventJoins->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventJoins', 'action' => 'view', $eventJoins->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventJoins', 'action' => 'edit', $eventJoins->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventJoins', 'action' => 'delete', $eventJoins->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventJoins->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Event Reviews') ?></h4>
        <?php if (!empty($event->event_reviews)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Rating') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->event_reviews as $eventReviews): ?>
            <tr>
                <td><?= h($eventReviews->id) ?></td>
                <td><?= h($eventReviews->event_id) ?></td>
                <td><?= h($eventReviews->user_id) ?></td>
                <td><?= h($eventReviews->name) ?></td>
                <td><?= h($eventReviews->email) ?></td>
                <td><?= h($eventReviews->rating) ?></td>
                <td><?= h($eventReviews->status) ?></td>
                <td><?= h($eventReviews->created) ?></td>
                <td><?= h($eventReviews->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventReviews', 'action' => 'view', $eventReviews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventReviews', 'action' => 'edit', $eventReviews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventReviews', 'action' => 'delete', $eventReviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventReviews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
