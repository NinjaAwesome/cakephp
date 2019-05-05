<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <?php echo $this->element('breadcrumb', array('pageName' => 'Dashboard')); ?>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

      

        <!-- ./col -->


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $artisrs ?></h3>
                    <p>Total Artists</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fw fa-user"></i>
                </div>
                <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'Artists', 'action' => 'index', "plugin" => 'ArtistManager'], ['escape' => false, 'class' => 'small-box-footer']); ?>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $collabeds ?></h3>
                    <p>Total Collabeds</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fw fa-image"></i>
                </div>
                <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', 'javascript:void(0);', ['escape' => false, 'class' => 'small-box-footer']); ?>
            </div>
        </div>
        <!-- ./col -->
        
    </div><!-- /.row -->
    <div class="clearfix"></div>

</section>
