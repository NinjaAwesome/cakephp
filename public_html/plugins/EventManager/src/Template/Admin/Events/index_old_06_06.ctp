<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $events
*/
?>
<section class="content-header">
    <h1>
        <?= __('Manage Event') ?>  
        <small><?php echo __('Here you can manage the events'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="events">   
    <div class="row events">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Events') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->html->link("<i class=\"fa fa-plus\"></i> " . __('New Event'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                </div><!-- /.box-header -->

    <div class="box-body table-responsive">    
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
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
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
                <?php if (!empty($events->toArray())): 
                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                foreach ($events as $event): ?>
                <tr>
                    <td><?= $this->Number->format($i) ?>.</td>
                <td><?= $event->has('user') ? $this->Html->link($event->user->id, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?>
        </td>
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
            <td>
            <?php if ($event->is_join == 1) {
                    echo "Yes";
                }else{
                    echo "No";
                }
            ?>
        </td>
            <td>
            <?php if ($event->is_register == 1) {
                    echo "Yes";
                }else{
                    echo "No";
                }
            ?>
        </td>
            <td>
            <?php if ($event->is_paid == 1) {
                    echo "Yes";
                }else{
                    echo "No";
                }
            ?>
        </td>
                <td>
                    <?= $this->Form->checkbox('status', ['checked' => $event->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $event->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action'=>'changeFlag']), 'data-size' => 'mini']); ?>
                   
            </td>
            <td>
        <?php if ($event->created != "") {
                echo $event->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                }
                ?>
    </td>
                    <td class="actions">
                                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $event->id],['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View event'),'title'=>__('View event')]) ?>
                                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $event->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit event'),'title'=>__('Edit event')]) ?>
                                        <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $event->id], ['onClick' => 'confirmDelete(this, \''.$event->id.'\')','class' => 'btn btn-danger btn-sm btn-flat','data-toggle'=>'tooltip', 'escape' => false,'alt'=>__('Delete event'),'title'=>__('Delete event')]) ?>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='20' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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