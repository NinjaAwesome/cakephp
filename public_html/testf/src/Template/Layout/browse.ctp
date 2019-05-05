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
    $header_class = 'dextop-hide header-index';
}
?>

    <div class="header <?= $header_class ?>">
        <?php echo $this->element("header");  ?>
    </div>
    <div class="flash-masg-sec">
        <div class="container">
            <?= $this->Flash->render() ?>
        </div>
    </div>
    <div class="mainWpapContainer">
        <?= $this->fetch('content') ?>
    
    </div>
    <?php 
//        $this->Html->script([
//        '/js/jquery.min',
//        '/js/bootstrap',
//        '/js/custom.js',
//        //'/js/light-autocomplete.js',
//        'jquery-ui.js',
//        ]);
        ?>
     <?= $this->fetch('script') ?>
<script>
    $(function(){
        $("#loading").hide();
     
        $(document).on("click",".check-open-model", function(){ 
             if($("#mySidenav").hasClass("slide-on")){
                 $("#mySidenav").addClass("bbox");
             }
             $($(this).attr('data-mod')).modal('show'); 
        });
        $('.modal-header .close').on('click',function(){
            if($("#mySidenav").hasClass("slide-on")){
                 $("#mySidenav").removeClass("bbox");
             }
        });
        $('.my-popup').on('click',function(){
            if($("#mySidenav").hasClass("slide-on")){
                 $("#mySidenav").removeClass("bbox");
             }
        });
        
         
    })
    
    function likeOnly(collbe_id,likeCount,user_id){
        var url = '<?php echo $this->Url->build(['controller'=>'CollabedLikes','action'=>'ajaxIndex','plugin'=>'CollabedManager']); ?>';
       $.ajax({
           url: url,
           dataType: 'json',
           type: 'post',
           contentType: 'application/x-www-form-urlencoded',
           data: {
               'collbe_id':collbe_id,
               'user_id': user_id,
               'ajax':true,
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
