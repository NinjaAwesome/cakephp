<?php
use Cake\I18n\Time;
use Cake\I18n\Date;
?>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
//    (function(document) {
//       var shareButtons = document.querySelectorAll(".st-custom-button[data-network]");
//       for(var i = 0; i < shareButtons.length; i++) {
//          var shareButton = shareButtons[i];
//
//          shareButton.addEventListener("click", function(e) {
//             var elm = e.target;
//             var network = elm.dataset.network;
//
//             console.log("share click: " + network);
//          });
//       }
//    })(document);
//        $('.product-col').hover(
//            function() {
//              $( '.pro-heart' ).addClass( "active" );
//            }, function() {
//              $( '.pro-heart' ).removeClass( "active" );
//            }
//          );
                
		$(document).on({
		    mouseenter: function() {
		        $('.pro-heart', this).addClass('active');
                        setTimeout(function(){
                            $('.pro-heart').removeClass('active');
                        }, 2000);
		    }, 
                    mouseleave: function() {
		        $('.pro-heart', this).removeClass('active');
		    }
		},'.product-col');
//		$(document).ready(function() {
//		    $('.product-col').hover(
//		    function() {
//		        $('.pro-heart', this).addClass('active');
//		    }, function() {
//		        $('.pro-heart', this).removeClass('active');
//		    });
//		});
<?php $this->Html->scriptEnd(); ?>
</script>