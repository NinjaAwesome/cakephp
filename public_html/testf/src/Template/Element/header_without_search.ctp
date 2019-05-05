<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

//pr($this->request->query('search'));die;
?>
<nav class="navbar navbar-main fixed-top navbar-expand-lg navbar-light pt-0 pb-0 bg-white">
    <div class="container-fluid d-block pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row pt-3 pb-4 pb-md-2 pb-xl-3  align-items-center justify-content-end justify-content-md-end justify-content-lg-between flex-wrap flex-lg-nowrap">  
            <?= $this->Html->link($this->Html->image(Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => "" , "class" => "img-fluid"]), ['controller' => 'Collabeds', 'action' => 'index', 'plugin' => 'CollabedManager'], ['class' => 'navbar-brand col-6 col-sm-5 col-md-3 col-xl-2 text-center order-0 order-md-0 order-lg-0 mr-0 mr-lg-3 pl-0','escape' => false]); ?>
            
            <div class="col-3 col-md-4 col-lg-1 text-right order-1 order-md-1 order-lg-1 pr-0">
                <?= $this->Html->link('<span class="navbar-toggler-icon"></span>', ['controller' => 'Profile', 'action' => 'index', 'plugin' => false], ['class' => 'mr-0', 'title' => 'Profile', 'escape' => false]); ?>
            </div>
        </div>  
      </div>
  </nav>



<?php $like = $this->request->query('like'); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
  
<?php $this->Html->scriptEnd(); ?>
</script>
