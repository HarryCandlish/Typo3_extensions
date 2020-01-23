$(document).ready(function(){

});

// Fixed from top
$(window).on('resize load', function(){
    $('header').removeClass('fixed');
    var headerSize = $('header.header').height();
    $('.body-bg').css({'padding-top' : headerSize });
    $('header').addClass('fixed');
});

// Fixed after a banner
$(window).scroll(function() {  
    var revealPoint = $('#banner').next().offset().top; 
    var scroll = $(window).scrollTop();  

    if (scroll >= revealPoint) {
        $('header').addClass('fixed');
    }

    if (scroll < revealPoint) {
        $('header').removeClass('fixed');
    }
});
