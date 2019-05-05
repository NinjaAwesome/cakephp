<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$services = Configure::read('services');
$title = $artist_one->name.' '.Configure::read('BANNER_MID_TEXT').' '.$artist_two->name;
$imageLink =  Router::fullbaseUrl().$this->request->webroot . 'img/uploads/collabeds/' . $collabed->image;
$imageLinkShare = Router::fullbaseUrl().$this->Url->build(['controller'=>'Collab','action'=>'get', $collabed->url, 'plugin'=>false]);//Router::fullbaseUrl().Router::url('/').$_dir . $collabeds->image;

$shareLink = DS . $_dir . $collabeds->image;

?>
          
    <?php echo $this->element("comments");  ?>
            
    <?= $this->fetch('script') ?>
<script>
    //$(function(){
       //$('.check-open-model').on('click',function(){
    $(document).on("ready", function() {
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
                    console.log(data);
                    if (data.id) {
                        $("#comments_cont").append(`
                            <div class="row justify-content-between flex-nowrap">
                                <div class="mb-3 d-flex flex-nowrap">
                                    <p class="d-inline-block d-md-none mb-0 mr-3 avatar rounded-circle border">
                                    </p>
                                    <p class="d-inline-block mt-1 mb-0 mr-2">
                                        <span class="font-weight-bold lead mr-2"><?php echo $user['name'] ? $user['name'] : 'Unknown' ?></span>
                                        <span>${comment}</span>
                                        <span class="d-block d-md-none text-opacity"><span class="mr-4">2h</span>0 likes</span>
                                    </p>
                                </div>
                                <p class="col-1 col-md-2 col-lg-1 text-nowrap text-right text-md-left pt-2 mb-2 lead font-weight-bold like-block">
                                    <i class="far fa-thumbs-up rotated mr-2"></i>
                                    <span class="d-none d-md-inline">0</span>
                                </p>
                            </div>
                        `);
                        $("#addComment").val("");
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });    
        })

    })
    
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
