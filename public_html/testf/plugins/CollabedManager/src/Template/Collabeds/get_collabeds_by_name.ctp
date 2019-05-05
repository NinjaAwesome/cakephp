<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$services = Configure::read('services');
?>
<?php if (!empty($collabeds)): ?>
<?php foreach ($collabeds as $key => $collabed){ ?>
<?php //pr($collabed); ?>
<?php if($key != 0) continue; ?>
<?php $total = $collabed->total; ?>
<?php $imageLink = $this->request->webroot.$_dir.$collabed->image; ?>
<?php $imageLinkShare = Router::fullbaseUrl().$this->Url->build(['controller'=>'Collab','action'=>'get', $collabed->url, 'plugin'=>false]);//Router::fullbaseUrl().Router::url('/').$_dir . $collabed->image; ?>
<?php $shareLink = DS.$_dir.$collabed->image; ?>
<div class="product-col-done">
    <div class="product-col  p-2 bg-light">
    <div class="product-textarea-sec" onclick="return likeOnly(<?= $collabed->id ?>,<?= $collabed->total ?>);" style="background-image: url(<?= $this->request->webroot.$_dir.$collabed->image ?>)">
        <?php if($collabed->status){ ?>
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
        <?php } ?>
    </div>
<?php if(($collabed->status) && ($collabed->artiststwo->status && $collabed->artistsone->status)){ ?>
    <?php $collabIs = true; ?>
    <div class="pro-share-box  w-100 pt-1 pr-1 pb-0 pl-1 ">
        <ul class="pro-share-item d-flex justify-content-between">
            <li>
                <a class="small text-dark like-count-<?= $collabed->id ?>" href="javascript:void(0)">
                    <?php echo $this->Common->numberFormatShort($collabed->total); ?>
                </a>
                <span>votes</span>
            </li>
            <li>
                <?php echo $this->cell('CollabedManager.Collabed::display', [$collabed->id]) ?>
            </li>
            <li><!-- data-toggle="modal" -->
                <a href="javascript:void(0)" class="check-open-model pl-1 pr-1"  data-mod="#myModal_<?= $collabed->id ?>">
                    <i class="fa fa-share "></i>
                </a>
                <?php if($user):?>
                    <!-- <a href="<?php echo $this->Url->build(['controller'=>'Collab','action'=>'get', $collabed->url, 'plugin'=>false]); ?>" class="pl-1 pr-1" >
                        <i class="fa fa-comment"></i>
                    </a> -->
                    <a href="javascript:void(0)" class="pl-1 pr-1 comment-modal-open" data-collab-url="<?= $collabed->url ?>">
                        <i class="fa fa-comment"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="this.classList.toggle('red-heart');return likeOnly(<?= $collabed->id ?>,<?= $collabed->total ?>,<?= $user['id'] ?>);" class="icon-like pl-1 pr-1 <?= $calss ?>">
                        <i class="fa fa-thumbs-up"></i>
                    </a>
                <?php else:?>
                    <a href="<?= Router::url('/login');?>" class="pl-1 pr-1">
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
    <span class="font-weight-bold">by:</span> <?php echo $collabed->users_soc->name ? $collabed->users_soc->name : 'Unknown user';?>
</div>  
<div class="sort-by-col text-center w-100 mt-3 text-nowrap d-none search-reset " id="search-reset" onclick="searchReset();">
    <!-- <span>Sort by:</span>  -->
    <a class="sortBtn font-weight-bold text-dark">
        <h3>Reset<small class="fa fa-redo-alt ml-2"></small></h3>
    </a>
</div>  
<?php }else { ?>
    <?php $collabIs = false; ?>
      <div class="pro-share-box">
        <div class="accept-col text-center pt-2">
            <a class="text-dark"><?= h(Configure::read('ALREADY_SENT_APPROVAL')) ?></a>
        </div>
    </div>  
<?php } ?>
</div>
    <div class="modal fade my-popup" id="myModal_<?= $collabed->id ?>">
        <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Share This Collabe</h4>
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
<?php } ?>
<?php else: ?>
    <?php if((!empty($artistone_name) && !empty($artisttwo_name))){ ?>
        <?php if((strtolower($artistone_name) != strtolower($artisttwo_name))){ ?>
        <div class="product-col p-2 bg-light">
            <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                <div class="mid-text-items">
                    <div class="pro-textarea-1 pro-textarea-item">
                        <?= $artisAname ? $artisAname : $artistone_name ?>
                    </div>
                    <div class="prot-textarea-2 mt-2 mb-2"><?= Configure::read('BANNER_MID_TEXT') ?></div>
                    <div class="pro-textarea-3 pro-textarea-item">
                        <?= $artisBname ? $artisBname : $artisttwo_name ?>
                    </div>
                </div>
            </div>
            <div class="pro-share-box pb-0">
                <div class="accept-col text-center">
                    <a id="create_collab" href="javascript:void(0)" data-a1="<?= $artisAname ? $artisAname : $artistone_name ?>" data-a2="<?= $artisBname ? $artisBname : $artisttwo_name ?>" data-url="<?= Router::url(['controller'=>'Collabeds', 'action'=>'collabeApprovel', 'plugin' => 'CollabedManager','?'  => ['aone' => $artisAname ? $artisAname : $artistone_name, 'atwo' => $artisBname ? $artisBname : $artisttwo_name,'banner'=>$banner_id]], true); ?>" class="lead text-primary font-weight-bold"><?= h('CREATE ') ?> <i class="fas fa-plus-circle"></i></a>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <div class="product-col-done">
                <div class="product-col p-2 bg-light">
                    <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                        <div class="mid-text-items">
                            <div class="pro-textarea-1 pro-textarea-item">
                                <?= $artisAname ? $artisAname : $artistone_name ?>
                            </div>
                            <div class="prot-textarea-2"><?= Configure::read('BANNER_MID_TEXT') ?></div>
                            <div class="pro-textarea-3 pro-textarea-item">
                                <?= $artisBname ? $artisBname : $artisttwo_name ?>
                            </div>
                        </div>
                    </div>
                    <div class="pro-share-box pb-1">
                        <div class="lead text-center text-dark">
                            <?= h('Artist 1 and Artist 2 can\'t be same') ?>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php } ?>
    <?php } elseif(!empty($artistone_name) && empty($artisttwo_name)) { ?>
        <div class="product-col p-2 bg-light">
            <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                <div class="mid-text-items">
                    <div class="pro-textarea-1 pro-textarea-item">
                        <?= $artisAname ? $artisAname : $artistone_name ?>
                    </div>
                    <div class="prot-textarea-2">1<?= Configure::read('BANNER_MID_TEXT') ?></div>
                    <div class="pro-textarea-3 pro-textarea-item">
                        <?= $artisBname ? $artisBname : $artisttwo_name ?>
                    </div>
                </div>
            </div>

            <!--<div class="pro-share-box">
                <div class="accept-col">
                    <a href="<?php //echo Router::url(['controller'=>'Collabeds', 'action'=>'create', 'plugin' => 'CollabedManager','?'  => ['aone' => $article_one->id, 'atwo' => $article_two->id,'banner'=>$banner_id]], true); ?>" class="color_white">ACCEPT</a>
                </div>
            </div>-->
        </div>
         <?php } elseif(!empty($artisttwo_name) && empty($artistone_name)) { ?>
        <div class="product-col p-2 bg-light">
            <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                <div class="mid-text-items">
                    <div class="pro-textarea-1 pro-textarea-item">
                        <?= $artisAname ? $artisAname : $artistone_name ?>
                    </div>
                    <div class="prot-textarea-2"><?= Configure::read('BANNER_MID_TEXT') ?></div>
                    <div class="pro-textarea-3 pro-textarea-item">
                        <?= $artisBname ? $artisBname : $artisttwo_name ?>
                    </div>
                </div>
            </div>
            <!--<div class="pro-share-box">
                <div class="accept-col">
                    <a href="<?php //echo Router::url(['controller'=>'Collabeds', 'action'=>'create', 'plugin' => 'CollabedManager','?'  => ['aone' => $article_one->id, 'atwo' => $article_two->id,'banner'=>$banner_id]], true); ?>" class="color_white">ACCEPT</a>
                </div>
            </div>-->
        </div>
    <?php } else { ?>
    <?php //pr($artistone_name); ?>
    <?php //pr($artisttwo_name); ?>
        <div class="product-col p-2 bg-light">
            <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                <div class="mid-text-items">
                <div class="prot-textarea-2" style="padding: 0 40px;">
                   <?= h(Configure::read('ALLREADY_COLLABE')) ?>
                </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php endif; ?>
<?php if(count($collabeds) == 0):?>
    <div id="collabsss" data-attr="no"></div>

<?php elseif(!empty($artistone_name) && empty($artisttwo_name)):?>
<div id="collabsss" data-attr="yes"></div>

<?php else:?>
    <div id="collabsss" data-attr="no"></div>

<?php endif;?>

