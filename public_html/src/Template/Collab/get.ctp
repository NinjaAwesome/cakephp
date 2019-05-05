<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$services = Configure::read('services');
$title = $artist_one->name.' '.Configure::read('BANNER_MID_TEXT').' '.$artist_two->name;
$imageLink =  Router::fullbaseUrl().$this->request->webroot . 'img/uploads/collabeds/' . $collabed->image;
$imageLinkShare = Router::fullbaseUrl().$this->Url->build(['controller'=>'Collab','action'=>'get', $collabed->url, 'plugin'=>false]);//Router::fullbaseUrl().Router::url('/').$_dir . $collabeds->image;

$shareLink = DS . $_dir . $collabeds->image;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css([
        // 'bootstrap.min.css', //Bootstrap 3.3.7
        //'/assets/bower_components/select2/dist/select2.min', 
        //'/assets/bower_components/select2/dist/select2-bootstrap.min', 
        //'base.css',
        'jquery-ui.css',
        'animate.css',
        'main.css',
        'style.css',
        'developer.css',
        
    ]) ?>
    <?= $this->fetch('css') ?>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <title>
        #collabthem | <?= $title ?>
    </title>
    <meta property="og:title" content="Vote for : <?= $title ?> "/>
    <meta property="og:url" content="https://collabthem.com/collab" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?= $imageLink ?>"/>
    <meta property="og:image:width" content="200" />
    <meta property="og:image:height" content="200" />
    <meta property="og:site_name" content="<?= Configure::read("Setting.SYSTEM_APPLICATION_NAME") ?>"/>
    <meta property="og:description" content="Found On #collabthem"/>
    <script type="text/javascript">
        var baseurl = '<?php echo $this->request->getAttribute("webroot"); ?>';
        var CLIENT_TOKEN   =   '<?php  echo $this->request->getParam('_csrfToken'); ?>';
    </script>
    <style>
        #cover {
            background: url("http://www.aveva.com/Images/ajax-loader.gif") no-repeat scroll center center #FFF;
            position: absolute;
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<!-- <!DOCTYPE html>
<html>
    <head>
        <meta property="og:title" content="Vote for : Artist1 feat Artist2 "/>
        <meta property="og:image" content="https://collabthem.com/testf/img/uploads/collabeds/1436073886-09-04-2019.png"/>
        <meta property="og:site_name" content="<?= Configure::read("Setting.SYSTEM_APPLICATION_NAME") ?>"/>
        <meta property="og:description" content="Found On #collabthem"/>
    </head> -->
    <body>
        <div class="header <?= $header_class ?>">
            <?php echo $this->element("header");  ?>
        </div>
        <div class="mainWpapContainer container-fluid">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 pt-4">
                
                <?php echo $this->element("comments");  ?>
            </div>
        </div>

        <?= $this->Html->script([
        '/js/jquery.min',
        '/js/bootstrap',
        '/js/custom.js',
        //'/js/light-autocomplete.js',
        'jquery-ui.js',
        ]); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.6/jquery.timeago.js"></script>
    <?= $this->fetch('script') ?>
<script>
    //$(function(){
       //$('.check-open-model').on('click',function(){
    $(document).on("ready", function() {
        $("time.timeago").timeago();
        $("#addComment").on("change", function() {
            
            var url = "<?php echo $this->Url->build(['controller'=>'Comments','action'=>'add', $collabed->id, 'plugin'=>false]); ?>";
            var comment = $("#addComment").val();
            $.ajax({
                url: url,
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: {
                    'comment': comment,
                },
                beforeSend: function (xhr) { // Add this line
                    xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                },  // Add this line
                success: function( data, textStatus, jQxhr ){
                    if (data.id) {
                        $("#comments_cont").append(`
                            <div class="row justify-content-between flex-nowrap px-2 px-md-0">
                                <div class="mb-3 d-flex flex-nowrap">
                                    <!-- <p class="d-inline-block d-md-none mb-0 mr-3 avatar rounded-circle border">
                                    </p> -->
                                    <p class="d-inline-block mt-1 mb-0 mr-2">
                                        <span class="font-weight-bold mr-2"><?php echo $user['name'] ? $user['name'] : 'Unknown' ?></span>
                                        <span>${comment}</span>
                                        <span class="d-block  text-opacity">
                                        <span class="mr-4"><time class="timeago">Jusn now</time></span>
                                            <span id="countm${data.id}?>" class="d-inline d-md-none">0</span> <span class="d-inline d-md-none">likes</span>
                                        </span>
                                    </p>
                                </div>
                                <p class="col-2 text-nowrap text-right pt-2 pr-0 pr-md-2 mb-2 lead font-weight-bold like-block">
                                    <span class="d-none d-md-inline" id="countd${data.id}">0</span>    
                                    <a href="javascript:void(0)" class=" comment-like text-dark" data-comment-id="${data.id}">
                                        <i class="fa fa-thumbs-up ml-md-2" ></i>
                                    </a>
                                    
                                </p>
                            </div>
                        `);
                        $("#addComment").val("");
                        $("#addComment").trigger("blur");
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });    
        })

        $(".comment-like").on("click", function() {
            var user_name = $(this).data("user-name"); 
            if (user_name) {
                var comment_id = $(this).data("comment-id"); 
                var url = "<?php echo $this->Url->build(['controller'=>'Comments','action'=>'like', 'plugin'=>false]); ?>" + "/" + comment_id;
                var self = $(this);
                $.ajax({
                    url: url,
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    beforeSend: function (xhr) { // Add this line
                        xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                    },  // Add this line
                    success: function( data, textStatus, jQxhr ){
                        // console.log(data);
                        if (data.success) {
                            console.log($(`#countd${comment_id}`));
                            $(`#countd${comment_id}`).html(data.count);
                            $(`#countm${comment_id}`).html(data.count);
                            self.toggleClass("red-heart");
                        }

                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                    }
                });  
            }
              

        })



    })
        $(document).on("click",".check-open-model", function(){ 
            if($("#mySidenav").hasClass("slide-on")){
                $("#mySidenav").addClass("bbox");
            }
            $($(this).attr('data-mod')).modal('show'); 

            
            
       });
    //});
    
    function likeOnly(collbe_id,likeCount, user_id){
            
        var url = '<?php echo $this->Url->build(['controller'=>'CollabedLikes','action'=>'ajaxIndex','plugin'=>'CollabedManager']); ?>';
       $.ajax({
           url: url,
           dataType: 'json',
           type: 'post',
           contentType: 'application/x-www-form-urlencoded',
           data: {
               'collbe_id':collbe_id,
               'ajax':true,
               'user_id': user_id,
               'likeCount':likeCount,
           },
           beforeSend: function (xhr) { // Add this line
               xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
           },  // Add this line
           success: function( data, textStatus, jQxhr ){
               if(data.success){
                    $('.like-'+collbe_id+' i.fa').css('color','red');
                    $('.like-count-'+collbe_id).html(data.likeCount);
                    $('.pro-collbe-'+collbe_id).addClass('red-heart');
                }else{
                    $('.like-'+collbe_id+' i.fa').css('color','#FFF');
                    $('.like-count-'+collbe_id).html(data.likeCount);
                    $('.pro-collbe-'+collbe_id).removeClass('red-heart');
                }
           },
           error: function( jqXhr, textStatus, errorThrown ){
               console.log( errorThrown );
           }
       });
   }
</script>
    </body>
</html>
