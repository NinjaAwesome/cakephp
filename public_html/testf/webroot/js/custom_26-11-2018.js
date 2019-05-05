
/************Main**Top*Menu******************************/


$(function() {
    var html = $('html, body'),
        navContainer = $('.nav-container'),
        navToggle = $('.nav-toggle'),
        navDropdownToggle = $('.has-dropdown');

    // Nav toggle
    navToggle.on('click', function(e) {
        var $this = $(this);
        e.preventDefault();
        $this.toggleClass('is-active');
        navContainer.toggleClass('is-visible');
        html.toggleClass('nav-open');
    });
  
    // Nav dropdown toggle
    navDropdownToggle.on('click', function() {
        var $this = $(this);
        $this.toggleClass('is-active').children('ul').toggleClass('is-visible');
    });
  
    // Prevent click events from firing on children of navDropdownToggle
    navDropdownToggle.on('click', '*', function(e) {
        e.stopPropagation();
    });
});


/*********************Section**************************/







/*******************************************/

/*******************************************/




/********Bootstrap**Modal****Start*************/	

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})

/********Bootstrap**Modal***End**************/	



$(function () {
    var div = $('.topSearchBar');
    $('#searchBtn').click(function () {
        div.fadeToggle(200);
		css.width== 0;
    });
});
	 
	 
	 
	 /*******************************
* ACCORDION WITH TOGGLE ICONS
*******************************/
	function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

	 