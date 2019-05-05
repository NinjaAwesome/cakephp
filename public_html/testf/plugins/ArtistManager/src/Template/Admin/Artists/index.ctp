<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $artists
 */
?>
<section class="content-header">
    <h1>
        <?= __('Manage Artist') ?>  
        <small><?php echo __('Here you can manage the artists'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="artists">
    <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context']]) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->control('search_keyword',['class' => 'form-control','placeholder' => 'Search Artist Name','label' => false,'autocomplete'=>'off']);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->select('status', [1 => "Active", 0 => "Inactive"], ['class' => 'form-control', 'empty' => 'Select Status']);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control("start_date", ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'Start date', 'label' => false,'autocomplete'=>'off']); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo $this->Form->control("end_date", ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'End date', 'label' => false,'autocomplete'=>'off']); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->button(__('<i class="fa fa-filter"></i> Filter'), ['class' => 'btn btn-success', 'title' => __('Search')]);
                            echo " ";
                            echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> ", ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Cancel'), 'escape' => false]);
                            echo " ";
                            echo $this->Html->link("<i class='fa fa-fw fa-file'></i> " . __('Import'), ['action' => 'import'], ['class' => 'btn btn-warning', 'title' => __('Cancel'), 'escape' => false]);

                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
    <div class="row artists">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>
                <?= $this->Form->create(null, ['url'=>['action'=>'deleteAll'], 'role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'post',]) ?>
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Artists') ?></span></h3>
                    <div class="box-tools">
                        <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Artist'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                    </div>
                    <div class="box-tools" style="right: 100px;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                echo $this->Form->button(__('<i class="fa fa-trash"></i> Delete'), ['class' => 'btn btn-danger', 'title' => __('Delete')]);
                                echo " ";
                                echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> ", ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Refresh'), 'escape' => false]);

                                ?>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <td><input type="checkbox" id="ckbCheckAll" /></td>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($artists->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($artists as $artist):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $this->Form->checkbox('checks[]', ['value' => $artist->id, 'hiddenField'=>false, 'class'=>'checkBoxClass']);
                                            ?>
                                        </td>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($artist->name) ?></td>
                                        <td>
                                            <?= $this->Form->checkbox('status', ['checked' => $artist->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $artist->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>

                                        </td>
                                        <td>
                                            <?php
                                            if ($artist->created != "") {
                                                echo $artist->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $artist->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View artist'), 'title' => __('View artist')]) ?>
                                            <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $artist->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit artist'), 'title' => __('Edit artist')]) ?>
                                            <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $artist->id], ['onClick' => 'confirmDelete(this, \'' . $artist->id . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete artist'), 'title' => __('Delete artist')]) ?>
                                            <?= $this->Html->link("<i class=\"fa fa-fw fa-users\"></i>", ['controller' => 'Groups','action' => 'index','?' =>['artist' => $artist->id]], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View Nick name'), 'title' => __('View Nick name')]) ?>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                endforeach; ?>
                            <?php else: ?>
                                <tr> 
                                    <td colspan='5' align='center' class="tbodyNotFound" style="text-align:center;">
                                        <strong>Record Not Available</strong> 
                                    </td> 
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>            
                <?= $this->Form->end() ?>
                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>            
            </div>
        </div>
    </div>
</section>
<?php
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);

?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkBoxClass").click(function(){
        var change = true;
        $(".checkBoxClass").each(function(){
            if($(this).prop('checked') == false){
                change = false;
            }
        });
         $("#ckbCheckAll").prop('checked', change);
    });
    $('.datepicker').datetimepicker({
        minView: 2,
        format: 'yyyy-mm-dd', 
        showTimepicker: false,
        autoclose: true, 
    });

});
<?php $this->Html->scriptEnd(); ?>
</script>