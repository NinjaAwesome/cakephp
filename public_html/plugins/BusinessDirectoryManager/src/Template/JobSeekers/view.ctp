<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $jobSeeker
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Job Seeker'), ['action' => 'edit', $jobSeeker->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Job Seeker'), ['action' => 'delete', $jobSeeker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobSeeker->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Job Seekers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Job Seeker'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jobs'), ['controller' => 'Jobs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Job'), ['controller' => 'Jobs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="jobSeekers view large-9 medium-8 columns content">
    <h3><?= h($jobSeeker->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Job') ?></th>
            <td><?= $jobSeeker->has('job') ? $this->Html->link($jobSeeker->job->id, ['controller' => 'Jobs', 'action' => 'view', $jobSeeker->job->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($jobSeeker->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($jobSeeker->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($jobSeeker->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($jobSeeker->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attachment') ?></th>
            <td><?= h($jobSeeker->attachment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($jobSeeker->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($jobSeeker->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($jobSeeker->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($jobSeeker->message)); ?>
    </div>
</div>
