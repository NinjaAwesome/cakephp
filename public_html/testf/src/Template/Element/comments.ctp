<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

//pr($this->request->query('search'));die;
$services = Configure::read('services');
$title = $artist_one->name.' '.Configure::read('BANNER_MID_TEXT').' '.$artist_two->name;
$imageLink =  Router::fullbaseUrl().$this->request->webroot . 'img/uploads/collabeds/' . $collabed->image;
$imageLinkShare = Router::fullbaseUrl().$this->Url->build(['controller'=>'Collab','action'=>'get', $collabed->url, 'plugin'=>false]);//Router::fullbaseUrl().Router::url('/').$_dir . $collabeds->image;
?>

<div class="row">
    <div class="col-4 d-none d-md-block ">
        <div class="product-col p-2 bg-light">
            <div class="product-textarea-sec" style="background-image: url('<?= $imageLink ?>')">
                <?php 
                    $calss = '';
                    if($user)
                        if($this->Common->checkLike($collabed->id, $user['id'])){
                            $calss = 'red-heart';
                        }
                ?>
                <div class="pro-heart pro-collbe-<?= $collabed->id ?> <?= $calss ?>">
                    <!--<i class="fa fa-heart"></i>-->
                        
                </div>
            </div>
            <div class="pro-share-box w-100 pt-1 pr-1 pb-0 pl-1 ">
                <ul class="pro-share-item d-flex justify-content-between">
                    <li>
                        <a class="small text-dark like-count-<?= $collabed->id ?>" href="javascript:void(0)">
                            <?php echo $this->Common->numberFormatShort($likes); ?>
                        </a>
                        <span>votes</span>
                    </li>
                    <li>
                        <?php echo $this->cell('CollabedManager.Collabed::display', [$collabed->id]) ?>
                    </li>
                    <li><!-- data-toggle="modal" -->
                        <a href="javascript:void(0)" class="check-open-model pl-1 pr-1" data-mod="#myModal_<?= $collabed->id ?>">
                            <i class="fa fa-share "></i>
                        </a>
                        <?php if($user):?>
                            <a href="javascript:void(0)" class="pl-1 pr-1">
                                <i class="fa fa-comment"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="this.classList.toggle('red-heart');return likeOnly(<?= $collabed->id ?>,1,<?= $user['id'] ?>);" class="icon-like pl-1 pr-1 <?= $calss ?>">
                                <i class="fa fa-thumbs-up"></i>
                            </a>
                        <?php else:?>
                            <a href="javascript:void(0)" class="pl-1 pr-1">
                                <i class="fa fa-comment"></i>
                            </a>
                            <a href="<?= Router::url('/login');?>" class="icon-like pl-1 pr-1 <?= $calss ?>">
                                <i class="fa fa-thumbs-up"></i>
                            </a>
                        <?php endif;?>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="text-right mt-1">
            <span class="font-weight-bold">by:</span> <?php echo  $user_collab->name ?  $user_collab->name : 'Unknown user';?>
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
                                                if($service == 'facebook'){
                                                    //$sshareLink = Router::fullbaseUrl().Router::url(['controller' => 'Collabs','action' => 'index','plugin'=> false,$collabed->id]);
                                                    echo '<li id="' . $collabed->id . '">' . $this->SocialShare->fa(
                                                            $service, $imageLinkShare, ['icon_class' => $link,
                                                        'text' => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
                                                        'image' => $imageLink
                                                            ]
                                                    ) . '</li>';
                                                }else{
                                                    echo '<li id="' . $collabed->id . '">' . $this->SocialShare->fa(
                                                            $service, $imageLinkShare, ['icon_class' => $link,
                                                        'text' => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
                                                        'image' => $imageLink
                                                            ]
                                                    ) . '</li>';
                                                }
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
    </div>
    <div class="col-12 mb-4 d-md-none ">
        <p class="modal-title lead text-center text-nowrap title-comment"><?= $title ?></p>
    </div>
    <div class="col-12 col-md-8">
        <div class="row row-comment" style="">
            <div class="col-12 pl-4 pr-4" id="comments_cont">

                <?php foreach($comments as $comment):?>

                <div class="row justify-content-between flex-nowrap px-2 px-md-0">
                    <div class="mb-3 d-flex flex-nowrap">
                        <!-- <p class="d-inline-block d-md-none mb-0 mr-3 avatar rounded-circle border">
                        </p> -->
                        <p class="d-inline-block mt-1 mb-0 mr-2">
                            <span class="font-weight-bold mr-2"><?php echo $comment['userssoc']['name'];?></span>
                            <span><?php echo $comment['comment'];?></span>
                            <span class="d-block d-md-none text-opacity">
                                <span class="mr-4"><time class="timeago" datetime=<?php echo $comment['created'];?>></time></span>
                                <span id="countm<?php echo $comment['id'];?>"><?php echo $comment['count_like'];?></span> likes
                            </span>
                        </p>
                    </div>
                    <p class="col-2 text-nowrap text-right pt-2 pr-0 pr-md-2 mb-2 lead font-weight-bold like-block">
                        <span class="d-none d-md-inline" id="countd<?php echo $comment['id'];?>"><?php echo $comment['count_like'];?></span>    
                        <a href="javascript:void(0)" class=" comment-like text-dark" data-comment-id="<?php echo $comment['id'];?>" data-user-name="<?php echo $user['name'];?>">
                            <i class="fa fa-thumbs-up ml-md-2" ></i>
                        </a>
                        
                    </p>
                </div>
                <?php endforeach;?>

            </div>
            <div class="col-12 align-self-end px-2 pb-3 mt-3 mb-5">
                <?php if($user):?>
                    <input name="addComment"  type="text" class="form-control rounded-lg bg-light w-100" id="addComment" autocomplete="off"  placeholder="Add Comment..." data-collab-id="<?= $collabed->id ?>">
                <?php else:?>
                    <input name="addComment"  type="text" class="form-control rounded-lg bg-light w-100 text-opacity" disabled="true" id="addComment" autocomplete="off"  placeholder="Add Comment..." data-collab-id="<?= $collabed->id ?>">
                <?php endif;?>
            </div>
        </div>
    </div>
</div>