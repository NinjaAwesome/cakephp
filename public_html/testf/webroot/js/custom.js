
/************Main**Top*Menu******************************/


$(function () {
    var html = $('html, body'),
            navContainer = $('.nav-container'),
            navToggle = $('.nav-toggle'),
            navDropdownToggle = $('.has-dropdown');

    // Nav toggle
    navToggle.on('click', function (e) {
        var $this = $(this);
        e.preventDefault();
        $this.toggleClass('is-active');
        navContainer.toggleClass('is-visible');
        html.toggleClass('nav-open');
    });

    // Nav dropdown toggle
    navDropdownToggle.on('click', function () {
        var $this = $(this);
        $this.toggleClass('is-active').children('ul').toggleClass('is-visible');
    });

    // Prevent click events from firing on children of navDropdownToggle
    navDropdownToggle.on('click', '*', function (e) {
        e.stopPropagation();
    });
});


/*********************Section**************************/






/**************header***Fix***Start********************/
var position = $(window).scrollTop(); 
var currentScrollPosition = 0; //for iOS input focus
var clicked = false;
$(window).scroll(function (e) {
    var scroll = $(window).scrollTop();
    currentScrollPosition = scroll; //for iOS input focus
    if (window.innerWidth < 768) {
        if ((scroll > position) && (scroll > 80)) {
            /*** open search on scroll if not sign in/profile page ****/
            if (!$(".navbar-main").hasClass("no-show-search"))
                $(".navbar-main").addClass("show-search");
        } else if (clicked && (scroll < position)) {
            $(".navbar-main").removeClass("show-search");
            $("#collabSearch").autocomplete("close");
        } else if ((scroll < position) ) {
            $(".navbar-main").removeClass("show-search");
            $("#collabSearch").autocomplete("close");
        }
        position = scroll;
    } else {
    }

    /**** scroll to start button show/hide *****/
    if ((window.innerWidth > 992) && (scroll > 50)) {
        $(".btn-up").removeClass("d-none");
    } else {
        $(".btn-up").addClass("d-none");
    }

    if (scroll > 1) {
        $(".navbar-main").addClass("border-bottom");
    } else {
        $(".navbar-main").removeClass("border-bottom");
    }

});
/**** for iOS input focus: ****/
$("#collabSearch").focus(function(){
    $(window).scrollTop(currentScrollPosition);
});
$("#artist_one").click(function(){
    if (window.innerWidth < 768) {
        $(window).scrollTop(170);
    }
});
$("#artist_two").click(function(){
    if (window.innerWidth < 768) {
        $(window).scrollTop(170);
    }
});
/**** enable open/close search on click ****/
$(".icon-search").on("click touch", function() {
    if (window.innerWidth < 768) {   
        if ($(".navbar-main").hasClass("show-search")) {
            $(".navbar-main").removeClass("show-search");
            clicked = false;
         } else {
            $(".navbar-main").addClass("show-search");
            clicked = true;
        }
    }     
})

/**** hide search on resize *****/
$(window).resize(function () {
    if (window.innerWidth > 767) {
        $(".navbar-main").removeClass("show-search");
    }
});

/**** scroll to start button click *****/
$(".btn-up").on("click", function() {
    $(window).scrollTop(0);
})

$(function () {
    var div = $('.sort-menu');
    $('.sortBtn').click(function () {
        div.fadeToggle(200);
        // css.width == 0;
    });
});

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
}