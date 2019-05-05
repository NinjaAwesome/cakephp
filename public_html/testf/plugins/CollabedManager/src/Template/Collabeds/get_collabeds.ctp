<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$services = Configure::read('services');
?>
<?php if (!empty($collabeds)): ?>
<?php foreach ($collabeds as $collabed){ ?>
    <?php $total = ($collabed->collabed_likes) ? $collabed->collabed_likes[0]->total : '0'; ?>
    <?php $imageLink = $this->request->webroot.$_dir.$collabed->image; ?>
    <?php $shareLink = DS.$_dir.$collabed->image; ?>
<div class="product-col">
    <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_dir.$collabed->image ?>)">
        <div class="product-logo">
            <?= $this->Html->image(Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => ""]); ?>
        </div>
    </div>
    <div class="pro-share-box">
        <ul class="pro-share-item">
             <li>
                 <a class="like-count-<?= $collabed->id ?>" href="javascript:void(0)">
                    <?= $collabed->total; ?>
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
<div class="modal fade my-popup" id="myModal_<?= $collabed->id ?>">
    <div class="modal-dialog modal-sm">
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
                                <ul class="share-social text-center">
                                <?php foreach ($services as $service => $link) {
                                        if($service == 'facebook'){
                                            $sshareLink = Router::fullbaseUrl().Router::url(['controller' => 'Collabs','action' => 'index','plugin'=> false,$collabed->id]);
                                            echo '<li id="' . $collabed->id . '">' . $this->SocialShare->fa(
                                                    $service, $sshareLink, ['icon_class' => $link,
                                                'text' => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
                                                'image' => $sshareLink
                                                    ]
                                            ) . '</li>';
                                        }else{
                                            echo '<li id="' . $collabed->id . '">' . $this->SocialShare->fa(
                                                    $service, $shareLink, ['icon_class' => $link,
                                                'text' => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
                                                'image' => $shareLink
                                                    ]
                                            ) . '</li>';
                                        }
                                    } ?>
                                    </ul>
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
<?php else: ?>
    <?php if(!empty($article_one) && !empty($article_two)){ ?>
        <?php if($article_one->id != $article_two->id) { ?>
        <div class="product-col">
            <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                <div class="mid-text-items">
                    <div class="pro-textarea-1 pro-textarea-item"><?= $article_one->name ?></div>
                    <div class="prot-textarea-2"><?= Configure::read('BANNER_MID_TEXT') ?></div>
                    <div class="pro-textarea-3 pro-textarea-item"><?= $article_two->name ?></div>
                </div>
                <div class="product-logo">
                    <?= $this->Html->image(Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => ""]); ?>
                </div>
            </div>
            <div class="pro-share-box">
                <div class="accept-col">
                    <a href="<?= Router::url(['controller'=>'Collabeds', 'action'=>'create', 'plugin' => 'CollabedManager','?'  => ['aone' => $article_one->id, 'atwo' => $article_two->id,'banner'=>$banner_id]], true); ?>" class="color_white">ACCEPT</a>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <div class="product-col">
                <div class="product-textarea-sec">
                    <div class="mid-text-items">
                    <div class="prot-textarea-2">
                       <?= h('Artist 1 and Artist 2 can\'t be same') ?>
                    </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <?php if(empty($article_one) && empty($article_two)){ ?>
            <div class="product-col">
                <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                    <div class="mid-text-items">
                        <div class="pro-textarea-1 pro-textarea-item"><?= $artistone_name ?></div>
                        <div class="prot-textarea-2"><?= Configure::read('BANNER_MID_TEXT') ?></div>
                        <div class="pro-textarea-3 pro-textarea-item"><?= $artisttwo_name ?></div>
                    </div>
                    <div class="product-logo">
                        <?= $this->Html->image(Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => ""]); ?>
                    </div>
                </div>
                <div class="pro-share-box">
                    <div class="accept-col">
                        <a href="<?= Router::url(['controller'=>'Collabeds', 'action'=>'collabeApprovel', 'plugin' => 'CollabedManager','?'  => ['aone' => $artistone_name, 'atwo' => $artisttwo_name,'banner'=>$banner_id]], true); ?>" class="color_white">ACCEPT</a>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
        <div class="product-col">
            <div class="product-textarea-sec">
                <div class="mid-text-items">
                <div class="prot-textarea-2" style="padding: 0 40px;">
                   <?= Configure::read('ALLREADY_COLLABE') ?>
                </div>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php } ?>
<?php endif; ?>
