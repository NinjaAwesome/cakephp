<?php use Cake\I18n\Date;?>
<!-- Start main-content -->
<div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="img/front/bg/bg2.jpg">
        <div class="container pt-30 pb-30">
            <!-- Section Content -->
            <div class="section-content text-center">
                <div class="row"> 
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <h3 class="text-theme-colored font-36">Event List</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: event calendar -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (!empty($events->toArray())) {
                        foreach ($events as $event) {
                            $dateStartDate = new Date($event->start_date);
                            $day = $dateStartDate->format('d');//date('d', strtotime($event->start_date));
                            $Month = $dateStartDate->format('M');//date('M', strtotime($event->start_date));
                            $year = $dateStartDate->format('Y');//date('Y', strtotime($event->start_date));
                            ?>
                            <div class="upcoming-events media maxwidth400 bg-light mb-20">
                                <div class="row equal-height">
                                    <div class="col-sm-4 pr-0 pr-sm-15">
                                        <div class="thumb p-15">
                                            <?php echo $this->Glide->image(($event->banner_image != '' ? $event->banner_image : 'https://placehold.it/220x160'), ['w' => '220', 'h' => '160'], ['class' => 'img-fullwidth','alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right pl-0 pl-sm-15">
                                        <div class="event-details p-15 mt-20">
                                            <h4 class="media-heading text-uppercase font-weight-500"><?php echo $event->title; ?></h4>
                                            <p><?php echo $event->short_description; ?></p>
                                            <?= $this->Html->link("Details <i class=\"fa fa-angle-double-right\"></i>", ['action' => 'view', $event->id], ['class' => 'btn btn-flat btn-dark btn-theme-colored btn-sm mt-10', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View event'), 'title' => __('View event')]) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="event-count p-15 mt-15">
                                            <ul class="event-date list-inline font-16 text-uppercase mt-10 mb-20">
                                                <li class="p-15 mr-5 bg-lightest"><?= ($Month)?$Month:''; ?></li>
                                                <li class="p-15 pl-20 pr-20 mr-5 bg-lightest"><?= ($day)?$day:''; ?></li>
                                                <li class="p-15 bg-lightest"><?= ($year)?$year:''; ?></li>
                                            </ul>
                                            <ul>
                                                <li class="text-theme-colored"><i class="fa fa-map-marker mr-5"></i> <?php echo $event->location; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <nav>
                                <ul class="pagination theme-colored pull-right xs-pull-center mb-xs-40">
                                    <li> <a href="#" aria-label="Previous"> <span aria-hidden="true">«</span> </a> </li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">...</a></li>
                                    <li> <a href="#" aria-label="Next"> <span aria-hidden="true">»</span> </a> </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- end main-content -->
