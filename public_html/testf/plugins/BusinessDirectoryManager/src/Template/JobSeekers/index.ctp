<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $jobSeekers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Job Seeker'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jobs'), ['controller' => 'Jobs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Job'), ['controller' => 'Jobs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="jobSeekers index large-9 medium-8 columns content">
    <h3><?= __('Job Seekers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attachment') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobSeekers as $jobSeeker): ?>
                <tr>
                    <td><?= $this->Number->format($jobSeeker->id) ?></td>
                    <td><?= $jobSeeker->has('job') ? $this->Html->link($jobSeeker->job->id, ['controller' => 'Jobs', 'action' => 'view', $jobSeeker->job->id]) : '' ?></td>
                    <td><?= h($jobSeeker->first_name) ?></td>
                    <td><?= h($jobSeeker->last_name) ?></td>
                    <td><?= h($jobSeeker->email) ?></td>
                    <td><?= h($jobSeeker->mobile) ?></td>
                    <td><?= h($jobSeeker->attachment) ?></td>
                    <td><?= h($jobSeeker->created) ?></td>
                    <td><?= h($jobSeeker->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $jobSeeker->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $jobSeeker->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $jobSeeker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobSeeker->id)]) ?>
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
