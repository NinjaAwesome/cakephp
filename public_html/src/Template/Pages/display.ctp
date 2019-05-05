<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;
$services = Configure::read('services');
?>

<div class="product-sec">
    <div class="container">
         <div id="results" class="row">
            <?php if(count($collabeds) > 0){ ?>
            <?php foreach($collabeds as $collabed){ ?>
            <?php $imageLink = $this->request->webroot.$_dir.$collabed->image; ?>
            <?php $imageLinkShare = Router::fullbaseUrl().Router::url('/').$_dir . $collabed->image; ?>
            <?php $shareLink = DS.$_dir.$collabed->image; ?>
            <div class="col-md-4">
                <div class="product-col">
                    <div class="product-textarea-sec" style="background-image: url(<?= $imageLink ?>)">
                        <div class="product-logo">
                           <?php echo $this->Html->image('logo-a.png', ["alt" => "logo", "style" => ""]); ?>
                        </div>
                        <?php 
                        $calss = '';
                        if($this->Common->checkLike($collabed->id)){
                            $calss = 'red-heart';
                        }
                        ?>
                        <div class="pro-heart pro-collbe-<?= $collabed->id ?> <?= $calss ?>">
                            <i class="fa fa-heart"></i>
                        </div>
                    </div>
                    <div class="pro-share-box">
                        <ul class="pro-share-item">
                            <li>
                                <a class="like-count-<?= $collabed->id ?>" href="javascript:void(0)">
                                    <?= $collabed->total ?>
                                </a>
                            </li>
                            <li>
                            <?php echo $this->cell('CollabedManager.Collabed::display', [$collabed->id]) ?>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_<?= $collabed->id ?>">
                                    <i class="fa fa-share"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal fade my-popup" id="myModal_<?= $collabed->id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?= $collabed->artistsone ? $collabed->artistsone->name : '' ?>
                                feat 
                                <?= $collabed->artiststwo ? $collabed->artiststwo->name : '' ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="my-popup-content">
                                <div class="conversation-list">
                                    <div class="conversation-text">
                                        <br>
                                        <div class="right-pres-btn-col">
                                            <div class="topSocial">
                                            <ul class="share-social text-center">
                                                <?php
                                                foreach ($services as $service => $link) {
                                                    echo '<li id="' . $collabed->id . '">' . $this->SocialShare->fa(
                                                            $service, $shareLink, ['icon_class' => $link,
                                                        'text' => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
                                                        'image' => $shareLink
                                                            ]
                                                    ) . '</li>';
                                                }
                                                ?>
                                            </ul>
                                            </div>
                                            <div class="collbe-link">
                                                <input id="imageLinkShare_<?= $collabed->id ?>" name="" type="text" readonly="readonly" value="<?= $imageLinkShare ?>"/>
                                            </div>
                                            <div class="collbe-link">
                                                <button onclick="copyToClipboard('#imageLinkShare_<?= $collabed->id ?>')" class="copy_link"><span>Copy link</span></button>
                                            </div>
                                            <div class="product-logo">
                                                <?php echo $this->Html->image('popup_logo.png', ["alt" => "logo", "style" => ""]); ?>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>