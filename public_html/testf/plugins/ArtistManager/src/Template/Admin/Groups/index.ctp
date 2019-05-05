<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $groups
 */
?>
<section class="content-header">
    <h1>
        <?= __('Manage Artist Nickname') ?>  
        <small><?php echo __('Here you can manage the Artist Nickname'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content" data-table="groups">
    <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context']]) ?>
    <div class="box box-info">
        <div class="box-body table-responsive">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->control('search_keyword',['class' => 'form-control','placeholder' => 'Search Artist Name/NickName','label' => false,'autocomplete'=>'off']);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->control('artist', ['options' => $artists, 'empty'=>'--Select Artist--', 'class' => 'form-control','label' => false]);
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            echo $this->Form->button(__('<i class="fa fa-filter"></i> Filter'), ['class' => 'btn btn-success', 'title' => __('Search')]);
                            echo " ";
                            echo $this->Html->link("<i class='fa fa-fw fa-refresh'></i> ", ['action' => 'index'], ['class' => 'btn btn-warning', 'title' => __('Cancel'), 'escape' => false]);
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
    <div class="row groups">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>
                <?= $this->Form->create(null, ['url'=>['action'=>'deleteAll'], 'role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'post',]) ?>
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Artist Nickname') ?></span></h3>
                    <div class="box-tools">
                        <?php /* $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Group'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false])*/ ?>
                    </div>
                    <div class="box-tools">
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
                                <th scope="col"><?= $this->Paginator->sort('name','Nickname') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Artists.name','Artistname') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <?php /*<th scope="col" class="actions"><?= __('Actions') ?></th> */?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($groups->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($groups as $group):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $this->Form->checkbox('checks[]', ['value' => $group->id, 'hiddenField'=>false, 'class'=>'checkBoxClass']);
                                            ?>
                                        </td>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td><?= h($group->name) ?></td>
                                        <td><?= $group->artist ? h($group->artist->name) : '' ?></td>
                                        <td>
                                            <?php
                                            if ($group->created != "") {
                                                echo $group->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                            }
                                            ?>
                                        </td>
                                        <?php /*
                                        <td class="actions">
                                            
        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $group->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View group'), 'title' => __('View group')]) ?>
                                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'edit', $group->id], ['class' => 'btn btn-primary btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit group'), 'title' => __('Edit group')]) ?>
                                    <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $group->id], ['onClick' => 'confirmDelete(this, \'' . $group->id . '\')', 'class' => 'btn btn-danger btn-sm btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete group'), 'title' => __('Delete group')]) ?>
                                        </td> */?>
                                    </tr>
                                    <?php $i++;
                                endforeach; ?>
<?php else: ?>
                                <tr> <td colspan='5' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
});
<?php $this->Html->scriptEnd(); ?>
</script>