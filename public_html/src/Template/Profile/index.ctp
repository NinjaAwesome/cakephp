<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

//pr($this->request->query('search'));die;
?>
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row flex-column justify-content-between row-signin">
        <div class="text-center">
            <p class="lead text-center mb-4">
                Welcome <?php echo $username;?>!
            </p>
            <p class="text-left">
                <a class="lead text-dark d-inline-block mb-2 mb-md-1" href="/?mycollab=true">
                    - My invented collabs
                </a>
                <br>
                <!-- <a class="lead text-dark d-inline-block mb-2 mb-md-1" href="">
                    - The collabs I voted for
                </a> -->
                <br>
                <?= $this->Html->link('- Sign out', ['controller' => 'Signout', 'action' => 'index', 'plugin' => false], ['class' => 'lead  text-dark d-inline-block mb-2 mb-md-1', 'escape' => false]); ?>
            </p>
            <div class="text-center create-collab-btn-col mt-5 text-uppercase">
                <?= $this->Html->link('Create collab', ['controller' => 'Collabeds', 'action' => 'add', 'plugin' => 'CollabedManager', Configure::read('BANNER_ID')], ['class' => 'btn-info text-dark create-collab', 'escape' => false]); ?>
            </div>    
        </div>
        
        <div class="text-center">
            <p class="lead text-center mb-3">
                follow #collabthem
            </p>
            <div class="topSocial">
                <?php $social_link = json_decode(Configure::read("Setting.SOCIAL_LINKS")) ?>
                <ul>
                    <?php foreach ($social_link as $link) { ?>
                        <li>
                            <a href="<?= $link->url ?>" target="_blank" class="<?= $link->icon ?> bg-dark text-white" alt="<?= $link->title ?>" title=""></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <p class="text-center text-md-right mt-5">
                <!-- <a  class="lead text-dark" href="">Privacy Policy</a>  -->
                <?= $this->Html->link('Privacy Policy', ['controller' => 'PrivacyPolicy', 'action' => 'index', 'plugin' => false], ['class' => 'lead text-dark', 'title' => 'PrivacyPolicy', 'escape' => false]); ?>
                <?= $this->Html->link('Our Mission', ['controller' => 'OurMission', 'action' => 'index', 'plugin' => false], ['class' => 'lead text-dark', 'title' => 'OurMission', 'escape' => false]); ?>
            </p>
        </div>
    </div>
</div>