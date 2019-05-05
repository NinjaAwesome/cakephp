<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $artistsGroups
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Artists Group') ?>  
        <small><?php echo __('Here you can manage the artists groups'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="artistsGroups">   
    <div class="row artistsGroups">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Artists Groups') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Artists Group'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

    <div class="box-body table-responsive">    
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col"><?= $this->Paginator->sort('artist_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('group_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php if (!empty($artistsGroups->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($artistsGroups as $artistsGroup): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                <td><?= $artistsGroup->has('artist') ? $this->Html->link($artistsGroup->artist->name, ['controller' => 'Artists', 'action' => 'view', $artistsGroup->artist->id]) : '' ?>
        </td>
                <td><?= $artistsGroup->has('group') ? $this->Html->link($artistsGroup->group->name, ['controller' => 'Groups', 'action' => 'view', $artistsGroup->group->id]) : '' ?>
        </td>
                    <td class="actions">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $artistsGroup->id],['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View artists group'),'title'=>__('View artists group')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $artistsGroup->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit artists group'),'title'=>__('Edit artists group')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $artistsGroup->id], ['onClick' => 'confirmDelete(this, \''.$artistsGroup->id.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete artists group'),'title'=>__('Delete artists group')]) ?>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='4' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>            

                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>            

            </div>
        </div>
    </div>
</section>