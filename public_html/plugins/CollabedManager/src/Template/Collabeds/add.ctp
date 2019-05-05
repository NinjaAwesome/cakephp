<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
?>

<div class="product-sec product-detail-page" id="addCollab">
    <!-- <div class="container"> -->
        <div class="row justify-content-center">
            <div id="collabe_response_done" class="col-sm-10 col-md-7 col-lg-5 order-md-2 ">
                <div class="product-col edit-product-cal p-2 pb-5 bg-light">
                    <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                        <div class="mid-text-items">
                            <div class="pro-textarea-1 pro-textarea-item artist_one">
                                <input maxlength="30" autocomplete="off" id="artist_one" placeholder="Artist 1" class="w-100"/>
                                <div id="artist_one_match" class="match-data"></div>
                            </div>
                            <div class="prot-textarea-2 mt-2 mb-2"><?= Configure::read('BANNER_MID_TEXT') ?></div>
                            <div class="pro-textarea-3 pro-textarea-item artist_two">
                                <input maxlength="30" autocomplete="off" id="artist_two" placeholder="Artist 2" class="w-100"/>
                                <div id="artist_two_match" class="match-data"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collabe_response" class="col-md-4 col-lg-3 order-md-1 d-none d-md-block">
                <div class="product-col p-2 bg-light">
                    <!-- <div class="product-textarea-sec" style="background-image: url(<?= $this->request->webroot.$_banner.$banner->image ?>)">
                        <div class="mid-text-items"> -->
                            <div class="prot-textarea-2" style="padding: 0 40px;">
                              
                            </div>
                        <!-- </div>
                    </div> -->
                </div>
                
            </div>
        </div>
    </div>
</div>
<div id="mySidenav" class="sidenav_collbe">
</div>
<style>



</style>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    
    function openNav() {
        var main_url = '<?php echo $this->Url->build(['controller'=>'Collabeds','action'=>'index','plugin'=>'CollabedManager']); ?>';
        //document.getElementById("addCollab").style.display = "none";
        //document.getElementById("mySidenav").style.width = "100%";
        document.getElementById("mySidenav").classList.add("slide-on");
        window.history.pushState("data","Title",main_url);
//        setTimeout(function(){
//            $('#cover').fadeOut();
//            location.reload();
//        },3000);
   
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
    
    // $(function() {
    $(document).on("ready", function() {
        
        var browse_url = '<?php echo $this->Url->build(['controller'=>'Collabeds','action'=>'ajaxIndex','plugin'=>'CollabedManager']); ?>';
        $('#mySidenav').load(browse_url);
//        $('#browse_collbe').on("click",function(){		
//            $.ajax({
//                url: browse_url,
//                dataType: 'html',
//                slide: 'left',
//                 beforeSend: function (xhr) { // Add this line
//                    //$('#sidenav_loader').show();
//                },  
//                success: function(html) {	
//                    //$('.mainWpapContainer').show('slide', {direction: 'left'}, 1000).html(html);
//                    //$(this).parent().addClass('slide-btn').html(html);
//                    $('.mainWpapContainer').load(browse_url);
//                    //$('.mainWpapContainer').load(browse_url);
//                    //$('.mainWpapContainer').hide('slow').fadeIn().load(browse_url);
//                }
//            });
//            //.show('slide', {direction: 'left'}, 2000);
//        });
//		
		
		
        
        
        var url = '<?php echo $this->Url->build(['controller'=>'Collabeds','action'=>'getCollabedsByName','plugin'=>'CollabedManager']); ?>';
        
        /*** Request for Just Created or Random Collab ****/ 
        $.ajax({
            url: url,
            dataType: 'text',
            type: 'post',
            contentType: 'application/x-www-form-urlencoded',
            data: {
                'artistone_name': "<?php echo $collabed->artistsone->name ? $collabed->artistsone->name : "";?>",
                'artisttwo_name': "<?php echo $collabed->artiststwo->name ? $collabed->artiststwo->name :""?>",
                'type':'1',
                'banner_id':<?= $banner->id ?>},
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
            },  // Add this line
            success: function( data, textStatus, jQxhr ){
                $('#collabe_response').html(data);
                if ('<?php echo $collabed->id ?>') {
                    $('#collabe_response_done').children(".product-col").addClass("d-none");
                    $('#collabe_response_done').append(data);
                    $('#collabe_response').find(".search-reset").addClass("d-md-block");
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
        $("input#artist_one").focus();

        $('#artist_one').blur(function(){
             if($(this).val() == ''){
                $('#artist_one').css('border-color','#FF0000');
                return false;
            }else{
                $('#artist_one').css('border-color','#DDD');
            }
            
        });
        var urlgetartist = '<?php echo $this->Url->build(['controller'=>'Artists','action'=>'getArtists','plugin'=>'ArtistManager']); ?>';
        
        $("#artist_one").autocomplete({
            open: function(event, ui) {
                $('.ui-autocomplete').off('menufocus hover mouseover mouseenter');
            },
            source: function(request, response){
                var artist_name_not = $('#artist_two').val();
                $.ajax({
                    type: "POST",
                    url: urlgetartist,
                    data: {'artist_name':request.term,'artist_name_not':artist_name_not},
                    dataType: "json",
                    beforeSend: function (xhr) { // Add this line
                        xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                        
                    },  // Add this line
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.name,
                                value: item.name
                            }
                        }));
                    },
                    error: function (msg) {
                        console.log(msg.status + ' ' + msg.statusText);
                    }
                })
            },
            select: function( event, ui ) {
                if(ui.item){
                    var artisttwo_name = $('#artist_two').val();
                    $.ajax({
                        url: url,
                        dataType: 'html',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: {
                            'artistone_name':ui.item.label,
                            'artisttwo_name':artisttwo_name,
                            'type':'1',
                            'banner_id':<?= $banner->id ?>},
                        beforeSend: function (xhr) { // Add this line
                            xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                        },  // Add this line
                        success: function( data, textStatus, jQxhr ){
                            let collab_id1 = $(data).filter("#collabsss").data("attr");
                            // console.log(collab_id1);
                           if (collab_id1 == 'yes')
                                $('#collabe_response').html(data);
                            //}
                        },
                        error: function( jqXhr, textStatus, errorThrown ){
                            console.log( errorThrown );
                        }
                    });
                }
            },
        });

         /*Keyup function one*/
        $('#artist_one').keyup(function(){
            var artistone_name = $(this).val();
            var artisttwo_name = $('#artist_two').val();
            
            if(($(this).val() != '')&&($(this).val().length == 1)){
                $('#artist_one').css('border-color','#DDD');
             
                $.ajax({
                    url: url,
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: {
                        'artistone_name':artistone_name,
                        'artisttwo_name':artisttwo_name,
                        'type':'1',
                        'banner_id':<?= $banner->id ?>},
                    beforeSend: function (xhr) { // Add this line
                        xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                    },  // Add this line
                    success: function( data, textStatus, jQxhr ){
                        $('#collabe_response').html(data);
                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                    }
                });
            }
        });
        
        
        $("#artist_two").autocomplete({
            open: function(event, ui) {
                $('.ui-autocomplete').off('menufocus hover mouseover mouseenter');
            },
            source: function(request, response){
                var artist_name_not = $('#artist_one').val();
                $.ajax({
                    type: "POST",
                    url: urlgetartist,
                    data: {'artist_name':request.term,'artist_name_not':artist_name_not},
                    dataType: "json",
                    beforeSend: function (xhr) { // Add this line
                        xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                    },  // Add this line
                    success: function (data) {
                        //response($.parseJSON(msg.d).Records);
                        response($.map(data, function (item) {
                            //$('#artist_one').attr('data-val',item.id);
                            return {
                                label: item.name,
                                value: item.name
                            }
                        }));
                    },
                    error: function (msg) {
                        console.log(msg.status + ' ' + msg.statusText);
                    }
                })
            },
            select: function( event, ui ) {
                if(ui.item){
                    var artistone_name = $('#artist_one').val();
                    $.ajax({
                        url: url,
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: {
                            'artistone_name':artistone_name,
                            'artisttwo_name':ui.item.label,
                            'type':'1',
                            'banner_id':<?= $banner->id ?>},
                        beforeSend: function (xhr) { // Add this line
                            xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                        },  // Add this line
                        success: function( data, textStatus, jQxhr ){
                            let collab_id1 = $(data).filter("#collabsss").data("attr");
                            if (collab_id1 == 'true')
                                $('#collabe_response').prepend(data);
                            $('#collabe_response').children(".product-col").remove();
                            $('#collabe_response').children(".product-col-done").eq(1).remove();
                            $('#collabe_response').find(".search-reset").addClass("d-md-block");
                            $('#collabe_response_done').children(".product-col").addClass("d-none");
                            $('#collabe_response_done').append(data);
                            
                        },
                        error: function( jqXhr, textStatus, errorThrown ){
                            console.log( errorThrown );
                        }
                    });
                }
            },
        });
        
        
        $('#artist_two').blur(function(){
            
             if($(this).val() == ''){
                $('#artist_two').css('border-color','#FF0000');
                return false;
            }else{
                $('#artist_two').css('border-color','#DDD');
                var artistone_name = $('#artist_one').val();
                var artisttwo_name = $(this).val();
                    $.ajax({
                        url: url,
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: {
                            'artistone_name':artistone_name,
                            'artisttwo_name':artisttwo_name,
                            'type':'0',
                            'banner_id':<?= $banner->id ?>},
                        beforeSend: function (xhr) { // Add this line
                            xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                        },  // Add this line
                        success: function( data, textStatus, jQxhr ){                   
                            $('#collabe_response_done').children(".product-col").addClass("d-none");
                            $('#collabe_response_done').append(data);
                            $('#collabe_response').find(".search-reset").addClass("d-md-block");
                            // $('#collabe_response').html( data );
                        },
                        error: function( jqXhr, textStatus, errorThrown ){
                            console.log( errorThrown );
                        }
                    });  

            }
        });
        
        /*Keyup function two*/
        $('#artist_two').keyup(function(e){
        
            var artistone_name = $('#artist_one').val();
            if($('#artist_one').val() == ''){
                $('#artist_one').css('border-color','#FF0000');
            }
            var artisttwo_name = $(this).val();
            if($(this).val() != ''){
                $('#artist_two').css('border-color','#DDD');    
            }
            if (e.keyCode == 13) {
                $.ajax({
                    url: url,
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: {
                        'artistone_name':artistone_name,
                        'artisttwo_name':artisttwo_name,
                        'type':'0',
                        'banner_id':<?= $banner->id ?>},
                    beforeSend: function (xhr) { // Add this line
                        xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                    },  // Add this line
                    success: function( data, textStatus, jQxhr ){                   
                        $('#collabe_response_done').children(".product-col").addClass("d-none");
                        $('#collabe_response_done').append(data);
                        $('#collabe_response').find(".search-reset").addClass("d-md-block");
                        // $('#collabe_response').html( data );
                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                    }
                });  
            }          
        });
        


        // var clicked = false;
        $(document).on("click", "#create_collab", function(e) {
            var url = $(this).attr("data-url"); // will return the string "123"
            var artistone_name = $(this).attr("data-a1");
            var artisttwo_name = $(this).attr("data-a2");
            $(this).html('<?= h('CREATING...') ?>');
            // if(clicked===false){
            //     clicked = true;
                //window.location.href = url; 
                $.ajax({
                    url: url,
                    type: 'get',
                    beforeSend: function (xhr) { // Add this line
                        xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                    },  // Add this line
                    success: function( data, textStatus, jQxhr ){                   
                        if (data && data !== "") {
                            var url = '<?php echo $this->Url->build(['controller'=>'Collabeds','action'=>'getCollabedsByName','plugin'=>'CollabedManager']); ?>';
                            $.ajax({
                                url: url,
                                dataType: 'text',
                                type: 'post',
                                contentType: 'application/x-www-form-urlencoded',
                                data: {
                                    'artistone_name':artistone_name,
                                    'artisttwo_name':artisttwo_name,
                                    'type':'0',
                                    'banner_id':<?= $banner->id ?>},
                                beforeSend: function (xhr) { // Add this line
                                    xhr.setRequestHeader('X-CSRF-Token', CLIENT_TOKEN);
                                },  // Add this line
                                success: function( data, textStatus, jQxhr ){                   
                                    $('#collabe_response_done').children(".product-col").addClass("d-none");
                                    $('#collabe_response_done').append(data);
                                    $('#collabe_response').find(".search-reset").addClass("d-md-block");
                                    // $('#collabe_response').html( data );
                                },
                                error: function( jqXhr, textStatus, errorThrown ){
                                    console.log( errorThrown );
                                }
                            });
                        }
                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        console.log( errorThrown );
                    }
                });
            //  } else{
            //     e.preventDefault();
            //  }
             //alert(clicked);
        });
        // $(".search-reset").on("click", function() {
        //     searchReset();
        // })
    });

function searchReset() {
    $("input").val("");
    $('#collabe_response_done').find(".product-col-done").remove();
    $('#collabe_response_done').find(".product-col").not(".edit-product-cal").remove();
    $('#collabe_response_done').find(".product-col").removeClass("d-none");
    $("input#artist_one").focus();
    /* + add request for random collab */
}    
    
<?php $this->Html->scriptEnd(); ?>
</script>
 