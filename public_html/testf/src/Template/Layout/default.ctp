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

use Cake\Utility\Text;
use Cake\Utility\Inflector;
$act = strtolower(trim($this->request->getParam('action')));
$ctrl = Text::slug(Inflector::underscore($this->request->getParam('controller')));
$slugedAct = Text::slug(Inflector::underscore($this->request->getParam('action')));
$header_class = '';
if($slugedAct == 'add' && $ctrl == 'collabeds'){
    $header_class = ' header-index';
}
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        #collabthem | <?php echo isset($title_new) ? $title_new : $this->fetch('title'); ?>
    </title>
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
<body>
    <div class="header <?= $header_class ?>">
        <?php echo $this->element("header");  ?>
    </div>
    <div class="mainWpapContainer container-fluid">
        
        <?= $this->fetch('content') ?>
        <a class="fas fa-long-arrow-alt-up btn-up d-none"></a>

        <!-- The Modal -->
        <div class="modal fade modal-comment" id="modalComment">
            <div class="modal-dialog modal-lg m-0 mx-md-auto my-md-5">
                <div class="modal-content border-0">

                <!-- Modal Header -->
                <div class="modal-header align-items-center py-2 px-1 d-flex d-md-none">
                    <a href="" class="close mx-0 col-2" data-dismiss="modal">
                        <i class="fas fa-angle-left lead"></i>
                    </a>
                    <p class="modal-title lead col-8 text-center">Comments</p> 
                    <p class="col-2"></p>  
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    
                    
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->

                </div>
            </div>
        </div>
        

    </div>
    <footer>
        <?php echo $this->element("footer");  ?>
    </footer>
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
   
   $(document).on("click",".comment-modal-open", function(){
        
        var collab_url = $(this).data("collab-url");
        var url = "<?php echo $this->Url->build(['controller'=>'Collab','action'=>'popup', 'plugin'=>false]); ?>" + "/" + collab_url;
        $.ajax({
            url: url,
            success: function(data, textStatus, jQxhr){
                $("#modalComment").modal("show");
                $("#modalComment").find(".modal-body").html(data);
                $("time.timeago").timeago();
            }
        })
   })

   $(document).on("change", "#addComment", function() {
        var collab_id = $(this).data("collab-id");
        var url = "<?php echo $this->Url->build(['controller'=>'Comments','action'=>'add', 'plugin'=>false]); ?>" + "/" + collab_id;
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
                console.log(data);
                if (data.id) {
                    $("#comments_cont").append(`
                        <div class="row justify-content-between flex-nowrap px-2 px-md-0">
                            <div class="mb-3 d-flex flex-nowrap">
                                <!-- <p class="d-inline-block d-md-none mb-0 mr-3 avatar rounded-circle border">
                                </p> -->
                                <p class="d-inline-block mt-1 mb-0 mr-2">
                                    <span class="font-weight-bold mr-2"><?php echo $user['name'] ? $user['name'] : 'Unknown' ?></span>
                                    <span>${comment}</span>
                                    <span class="d-block d-md-none text-opacity">
                                        <span class="mr-4"><time class="timeago">Jusn now</time></span>
                                        <span id="countm${data.id}?>">0</span> likes
                                    </span>
                                </p>
                            </div>
                            <p class="col-2text-nowrap text-right pt-2 pr-0 pr-md-2 mb-2 lead font-weight-bold like-block">
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

    $(document).on("click", ".comment-like", function() {
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
                        // console.log($(`#countd${comment_id}`));
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

</script>
</body>
</html>
