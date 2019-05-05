<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $artist
 */
?>

<section class="content-header">
    <h1>
        <?php echo __('Manage Artist'); ?>  <small>Artist Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="artists">
    <div class="artists box">
        <div class="box-header">
            <h3 class="box-title"><?= h($artist->name) ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('S. No') ?></th>
                    <td>#<?= $this->Number->format($artist->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($artist->name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($artist->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($artist->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Status') ?></th>
                    <td><?= $artist->status ? __('Enable') : __('Disable'); ?></td>
                </tr>
            </table>
            <div class="row related">
                <div class="col-md-12">
                    <?php if (!empty($artist->groups)): ?>
                    <h4><?= __('Related NickName') ?></h4>
                        <table class="table table-hover table-striped" cellpadding="0" cellspacing="0">
                            <tr>
                                <th scope="col"><?= __('S. No.') ?></th>
                                <th scope="col"><?= __('Name') ?></th>
                                
                                <th scope="col"><?= __('Created') ?></th>
                                <!--<th scope="col" class="actions"><?= __('Actions') ?></th>-->
                            </tr>
                            <?php $i = 1; foreach ($artist->groups as $groups): ?>
                                <tr>
                                    <td><?= h($i) ?></td><?php $i++ ?>
                                    <td><?= h($groups->name) ?></td>
                                    <td><?= h($groups->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT'])) ?></td>
                                    <?php /* ?>
                                    <td class="actions">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'Groups', 'action' => 'view', $groups->id], ['class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View Detail'), 'title' => __('View Detail')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'Groups', 'action' => 'edit', $groups->id], ['class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit'), 'title' => __('Edit Detail')]) ?>

                                        <?= $this->Form->postLink("<i class=\"fa fa-trash-o\"></i>", ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groups->id), 'class' => 'btn btn-danger btn-xs deleteDbRecord', 'escape' => false]) ?>
                                    </td>
                                    <?php */ ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</section>
