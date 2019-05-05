<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $collabeds
 */
?>
<section class="content-header">
    <h1>
        <?= __('Manage Collabed') ?>  
        <small><?php echo __('Here you can manage the collabeds'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="collabeds">
    <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context']]) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->select('status', [1 => "Active", 0 => "Inactive"], ['class' => 'form-control', 'empty' => 'Select Status']);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->select('artists', $artists, ['class' => 'form-control', 'empty' => 'Select Artist']);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
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
                            echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> " . __('Reset'), ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Cancel'), 'escape' => false]);

                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
    <div class="row collabeds">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>
            <?= $this->Form->create(null, ['url'=>['action'=>'deleteAll'], 'role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'post',]) ?>
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Collabeds') ?></span></h3>
                    <div class="box-tools">
                        <?php /* $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Collabed'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) */ ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                echo $this->Form->button(__('<i class="fa fa-trash"></i> Delete'), ['class' => 'btn btn-danger', 'title' => __('Delete')]);
                                echo " ";
                                echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> Refresh", ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Refresh'), 'escape' => false]);

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
                                <th scope="col"><?= $this->Paginator->sort('artist_id_1', 'Artist one') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('artist_id_2', 'Artist two') ?></th>
                                <th scope="col"><?= __('Status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('banner_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= __('Total Likes') ?></th>
                                <?php /*<th scope="col" class="actions"><?= __('Actions') ?></th>*/?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($collabeds->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($collabeds as $collabed):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $this->Form->checkbox('checks[]', ['value' => $collabed->id, 'hiddenField'=>false, 'class'=>'checkBoxClass']);
                                            ?>
                                        </td>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td>
                                            <?= h($collabed->artistsone->name) ?>
                                        </td>
                                        <td>
                                            <?= h($collabed->artiststwo->name) ?>
                                        </td>
                                        <td>
                                            <?= $this->Form->checkbox('status', ['checked' => $collabed->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $collabed->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>

                                        </td>
                                        <td>
                                            <?= $collabed->has('banner') ? $this->Html->link($collabed->banner->title, ['controller' => 'Banners', 'action' => 'view','plugin' =>'BannerManager', $collabed->banner->id]) : '' ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($collabed->image)): ?>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-image-<?= $collabed->id ?>">
                                                    <?= $this->Html->image('uploads/collabeds/' . $collabed->image, ['width' => '100px']) ?>
                                                </a>
                                                <div class="modal fade" id="modal-image-<?= $collabed->id ?>" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Images</h4>
                                                            </div>
                                                            <div class="modal-body parking-image">
                                                                <?= $this->Html->image('uploads/collabeds/' . $collabed->image, ['style' => 'width:100%']) ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                       
                                        <td>
                                            <?php
                                            if ($collabed->created != "") {
                                                echo $collabed->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>
                                         <td>
                                            <?= h($collabed->total) ?>
                                        </td>
                                        <?php  /*<td class="actions">
                                            $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $collabed->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View collabed'), 'title' => __('View collabed')])*/ ?>
                                            <?php /* $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $collabed->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit collabed'), 'title' => __('Edit collabed')])  ?>
                                            <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $collabed->id], ['onClick' => 'confirmDelete(this, \'' . $collabed->id . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete collabed'), 'title' => __('Delete collabed')])
                                        </td>*/ ?>
                                    </tr>
                                    <?php $i++;
                                endforeach;
                                ?>
                            <?php else: ?>
                                <tr> <td colspan='8' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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