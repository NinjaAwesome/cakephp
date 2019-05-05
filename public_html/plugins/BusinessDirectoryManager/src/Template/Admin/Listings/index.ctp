<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $listings
 */
?>
<section class="content-header">
    <h1>
        <?= __('Manage Listing') ?>  
        <small><?php echo __('Here you can manage the listings'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="listings"> 
    <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get', 'valueSources' => ['query', 'context']]) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">

                            <?php
                            echo $this->Form->select(
                                    'status', [1 => "Yes", 0 => "No"], ['class' => 'form-control', 'empty' => 'Select  Status']
                            );
                            ?>



                        </div>
                    </div>
					
                    <div class="col-md-3">
                        <div class="form-group">

                            <?php echo $this->Form->control("keyword", ['type' => 'text', 'class' => 'form-control input-small', 'placeholder' => 'keyword e.g: title,info_link,description', 'label' => false]); ?>


                        </div>
                    </div>
                       

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->button(__('<i class="fa fa-filter"></i> Filter'), ['class' => 'btn btn-success', 'title' => __('Search')]);
                            echo " ";
                            echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> " . __('Reset'), ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Cancel'), 'escape' => false]);
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <?= $this->Form->end() ?>
    <div class="row listings">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Listings') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Listing'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('company_name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('business_name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($listings->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($listings as $listing):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($listing->company_name) ?></td>

                                        <td><?= h($listing->business_name) ?></td>

                                        <td>
                                             
                                            <?= $this->Form->checkbox('status', ['checked' => $listing->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $listing->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($listing->created != "") {
                                                echo $listing->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $listing->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View listing'), 'title' => __('View listing')]) ?>
                                            <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $listing->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit listing'), 'title' => __('Edit listing')]) ?>
                                            <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $listing->id], ['onClick' => 'confirmDelete(this, \'' . $listing->title . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete listing'), 'title' => __('Delete listing')]) ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            <?php else: ?>
                                <tr> <td colspan='30' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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

