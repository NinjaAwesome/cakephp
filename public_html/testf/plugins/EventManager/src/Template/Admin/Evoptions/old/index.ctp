<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $evoptions
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Evoption') ?>  
        <small><?php echo __('Here you can manage the evoptions'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="evoptions">   
    <div class="row evoptions">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Evoptions') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Evoption'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

    <div class="box-body table-responsive">    
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col"><?= $this->Paginator->sort('option_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sort_order') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php if (!empty($evoptions->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($evoptions as $evoption): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                <td><?= h($evoption->option_type) ?></td>
                <td><?= h($evoption->title) ?></td>
                <td><?= h($evoption->image) ?></td>
                <td><?= $this->Number->format($evoption->sort_order) ?></td>
            <td>
        <?php if ($evoption->created != "") {
                echo $evoption->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                }
                ?>
    </td>
                    <td class="actions">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $evoption->id],['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View evoption'),'title'=>__('View evoption')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $evoption->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit evoption'),'title'=>__('Edit evoption')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $evoption->id], ['onClick' => 'confirmDelete(this, \''.$evoption->id.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete evoption'),'title'=>__('Delete evoption')]) ?>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='7' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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