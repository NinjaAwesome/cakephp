<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>

<section class="content-header">
    <h1>
        <?php echo __('Manage Event'); ?>  <small>Event Detail</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="events">
    <div class="listings box">
        <div class="box-header">
            <h3 class="box-title"><?= h('General Details') ?></h3>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Title') ?></th>
                    <td><?= h($event->title) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Location') ?></th>
                    <td><?= h($event->location) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Organizar Name') ?></th>
                    <td><?= h($event->organizar_name) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Organizer Email') ?></th>
                    <td><?= h($event->organizer_email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($event->amount) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Max Participants') ?></th>
                    <td><?= $this->Number->format($event->max_participants).' Members'; ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Start Date') ?></th>
                    <td><?= ($event->start_date) ? $event->start_date->format($ConfigSettings['ADMIN_DATE_FORMAT']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('End Date') ?></th>
                    <td><?= ($event->end_date) ? $event->end_date->format($ConfigSettings['ADMIN_DATE_FORMAT']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= ($event->created) ? $event->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= ($event->modified) ? $event->modified->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Status') ?></th>
                    <td><?= $event->status ? __('Active') : __('Deactive'); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="listings box">
        <div class="box-header">
            <h3 class="box-title"><?= h('Allow') ?></h3>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Allow to join users') ?></th>
                    <td><?= $event->is_join ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Allow to registration') ?></th>
                    <td><?= $event->is_register ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Allow payment options') ?></th>
                    <td><?= $event->is_paid ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="listings box">
        <div class="box-header">
            <h3 class="box-title"><?= h('Event Banner') ?></h3>
        </div>
        <div class="box-body">
            <div class="box-body">
                <div class="row">  
                    <div class="col-md-2">
                        <?php echo $this->Glide->image(($event->banner_image != '' ? $event->banner_image : 'no_image.gif'), ['w' => '150', 'h' => '150'], ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="listings box">
        <div class="box-header">
            <h3 class="box-title"><?= h('Event Image') ?></h3>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <div class="box-body">
                    <div class="row">
                        <?php
                        if (!empty($event->event_documents)) {
                            //dump($event->event_documents);
                            foreach ($event->event_documents as $eventDocuments):
                                if ($eventDocuments->file_type == 1) {
                                    ?>  
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Glide->image(($eventDocuments->file_name != '' ? $eventDocuments->file_name : 'no_image.gif'), ['w' => '150', 'h' => '150'], ['style' => 'width:150px', 'class' => 'img-rounded', 'data-placeholder' => $this->Url->image('no_image.gif')]);
                                        ?>
                                    </div>
                                    <?php
                                }
                            endforeach;
                        } else {
                            echo $this->Glide->image('no_image.gif', ['w' => '250', 'h' => '200', 'fit' => 'fill'], ["class" => "img-thumbnail"]);
                        }
                        ?>
                    </div>
                </div>
            </table>
        </div>
    </div>

    <div class="listings box">
        <div class="box-header">
            <h3 class="box-title"><?= h('Description') ?></h3>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Short Description') ?></th>
                    <td><?= h($event->short_description) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Description') ?></th>
                    <td><?= h($event->description) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="listings box">
        <div class="box-header">
            <h3 class="box-title"><?= h('Meta Data') ?></h3>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('Meta Title') ?></th>
                    <td><?= h($event->meta_title) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Meta Keyword') ?></th>
                    <td><?= h($event->meta_keyword) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Short Description') ?></th>
                    <td><?= h($event->meta_description ) ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="listings box">
        <div class="box-header">
            <h3 class="box-title"><?= h('Add ons') ?></h3>
        </div>
        <div class="box-body">
            
        </div>
    </div>
</section>
