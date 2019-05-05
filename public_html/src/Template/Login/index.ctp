<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

//pr($this->request->query('search'));die;
?>
<div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row flex-column justify-content-between row-signin">
        <div class="text-center">
            <p class="lead text-center mb-4">
                Join to create new music collabs, refresh the old ones and inspire remixes.

            </p>
            <p class="d-inline-block text-left">
                <a class="lead text-center text-dark" href="<?= $login_url_fb;?>">
                    Log in with Facebook
                </a>
                <br>
                <a class="lead text-center text-dark" href="<?= $login_url_insta;?>">
                    Log in with Instagram
                </a>
                <br>
                <a class="lead text-center text-dark" href="<?= $login_url_tw;?>">
                    Log in with Twitter
                </a>
            </p>     
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
            <p class="text-center text-md-right mt-5 d-flex flex-wrap justify-content-center  justify-content-lg-end footer-menu">
                <!-- <a  class="lead text-dark" href="">Privacy Policy</a>  -->
                <?= $this->Html->link('Privacy Policy', ['controller' => 'PrivacyPolicy', 'action' => 'index', 'plugin' => false], ['class' => 'lead text-dark border-right pl-1 pr-2 text-nowrap', 'title' => 'PrivacyPolicy', 'escape' => false]); ?>
                <?= $this->Html->link('Our Mission', ['controller' => 'OurMission', 'action' => 'index', 'plugin' => false], ['class' => 'lead text-dark border-right pl-1 pr-2 text-nowrap', 'title' => 'OurMission', 'escape' => false]); ?>
                <a class="lead text-dark pl-1 pr-2 text-nowrap" href="http://m.me/collabthem" target="blank">Support</a>
            </p>
        </div>
    </div>
</div>