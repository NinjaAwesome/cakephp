<?php
use Cake\Core\Configure;
use Cake\Routing\Router;

$services = Configure::read('services');
$like = $this->request->query('like');
echo $this->Form->hidden('totalCollabeds', ['value'=>$allCollabeCount, 'id'=>'totalCollabeds']);
?>
<div id="collab-container" class="product-sec">
    <div class="container">
        <div id="results" class="row">
            <?php if (!empty($collabeds)): ?>
                <?php foreach ($collabeds as $key => $collabed): ?>
                    <?php $imageLink = $this->request->webroot . $_dir . $collabed->image; ?>
                    <?php $imageLinkShare = Router::fullbaseUrl().$this->Url->build(['controller'=>'Collab','action'=>'get', $collabed->url, 'plugin'=>false]);//Router::fullbaseUrl().Router::url('/').$_dir . $collabed->image; ?>
                    <?php $shareLink = DS . $_dir . $collabed->image; ?>
                    <div class="col-md-4">
                        <div class="product-col p-2 bg-light">
                            <div class="product-textarea-sec"  onclick="return likeOnly(<?= $collabed->id ?>,<?= $collabed->total ?>);" style="background-image: url(<?= $imageLink ?>)">
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
                            <div class="pro-share-box  w-100 pt-1 pr-1 pb-0 pl-1 ">
                                <ul class="pro-share-item  d-flex justify-content-between">
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
                <?php endforeach; ?>
            <?php else: ?>
            <div class="text-center" style="margin:0 auto">
                    <strong class="not_available">Record Not Available</strong>
                </div>
            <?php endif; ?>
        </div>
        <?php 
        $countCollabeds = Configure::read('Setting.FRONT_PAGE_LIMIT');
        
        if($allCollabeCount > $countCollabeds){
        ?>
<!--        <div class="text-center">
            <span id="loading">Loading Please wait...</span>
        </div><br>-->
        <div class="text-center">
            <?php echo $this->Html->link('Loading...', 'javascript:void(0);', ['escape'=>false, 'class'=>"btn btn-outline btn-primary",'id' =>'load-more', 'onclick'=>'getMoreCollabeds(event, this, '.$countCollabeds.')'])?>
        </div><br>
        <?php 
        }
        ?>
    </div>
    
</div>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    
    $(function(){
        $("#loading").hide();
        if('<?php echo $allCollabeCount ?>' < '<?php $countCollabeds ?>') {  
            $("#load-more").hide();  
        } 
    })
     
    $('#mySidenav').scroll(function() {
        
//        console.log('scroll- '+$(this).scrollTop());
//        console.log('Hight- '+$(this).innerHeight());
//        console.log('scroll top Hight- '+($(this).scrollTop() + $(this).innerHeight()));
//        console.log('Hight dd- '+$(this)[0].scrollHeight);
        
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            $("#load-more").trigger("click");
        }
    });
    function getMoreCollabeds(event, obj, offset){
        event.preventDefault();
        var totalCollabeds = jQuery('#totalCollabeds').val();
        var search = jQuery('#collabSearch').val();
        $.ajax({
            url: '<?php echo $this->Url->build(['controller'=>'Collabeds','action'=>'ajaxCollabe','plugin'=>'CollabedManager']); ?>',
            type: "get",
            dataType: "text",
            data: {'skipCollabeds': offset,'like':'<?= $like; ?>','search_keyword':search},
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                $("#loading").show();
            },  // Add this line
            complete: function(){
                $("#loading").hide();
            },
            success: function(data, textStatus, jQxhr){
                if(data){
                    offset = offset + <?= $countCollabeds ?>;
                    if(totalCollabeds > offset){
                        jQuery(obj).attr('onclick', 'getMoreCollabeds(event, this,'+offset+')');
                    } else {
                        
                        jQuery(obj).remove();
                    }
                    $('#results').append(data);
                    $("#loading").hide();
                } else {
                    
                    jQuery(obj).remove();
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    }
<?php $this->Html->scriptEnd(); ?>
</script>

