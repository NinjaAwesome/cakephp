<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $banners
 */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
<?= __('Manage Banner') ?>  
        <small><?php echo __('Here you can manage the banners'); ?></small>
    </h1>
<?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="banners">  
<?php if (Configure::read('Setting.DEFAULT_BANNER') == NULL): ?>
        <div class="col-md-12">
            <div class="callout callout-danger">
                <h4>Please set default banner in <?= $this->Html->link("Settings", ['controller' => 'Settings', 'action' => 'index', 'plugin' => 'SettingManager']); ?> section.</h4>
                <p>Note: please use "DEFAULT_BANNER" slug for replace default home page banner in the system.</p>
            </div>
        </div>
<?php endif; ?>
    <div class="row banners">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Banners') ?></span></h3>
                    <div class="box-tools">
<?php /*echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Banner'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false])*/ ?>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('S. No.') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= __('Banner') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($banners->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($banners as $banner):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($banner->title) ?></td>
                                        <td>
                                            <?= $this->Form->checkbox('status', ['checked' => $banner->status == 1 ? true : false, 'class' => 'switch-status change-request', 'data-id' => $banner->id, 'data-field' => 'status', 'data-url' => $this->Url->build(['action' => 'changeFlag']), 'data-size' => 'mini']); ?>

                                        </td>
                                        <td>
                                            <?php if (!empty($banner->image)): ?>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-image-<?= $banner->id ?>">
                                            <?= $this->Html->image('uploads/banners/'.$banner->image,['width'=>'100px']) ?>
                                            </a>
                                            <div class="modal fade" id="modal-image-<?= $banner->id ?>" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                      <h4 class="modal-title">Images</h4>
                                                    </div>
                                                    <div class="modal-body parking-image">
                                                       <?= $this->Html->image('uploads/banners/'.$banner->image,['style' => 'width:100%']) ?>
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
                                            if ($banner->created != "") {
                                                echo $banner->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $banner->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit banner'), 'title' => __('Edit banner')]) ?>
                                            <?php /*echo $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $banner->id], ['onClick' => 'confirmDelete(this, \'' . $banner->id . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete banner'), 'title' => __('Delete banner')])*/ ?>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                endforeach;
                                ?>
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