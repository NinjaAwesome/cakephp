<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $jobSeeker
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?=
            $this->Form->postLink(
                    __('Delete'), ['action' => 'delete', $jobSeeker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jobSeeker->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Job Seekers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Jobs'), ['controller' => 'Jobs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Job'), ['controller' => 'Jobs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="jobSeekers form large-9 medium-8 columns content">
    <?= $this->Form->create($jobSeeker) ?>
    <fieldset>
        <legend><?= __('Edit Job Seeker') ?></legend>
        <?php
        echo $this->Form->control('job_id', ['options' => $jobs]);
        echo $this->Form->control('first_name');
        echo $this->Form->control('last_name');
        echo $this->Form->control('email');
        echo $this->Form->control('mobile');
        echo $this->Form->control('message');
        echo $this->Form->control('attachment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
