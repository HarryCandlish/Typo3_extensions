$(document).ready(function(){

    // Write javascript on load here
    // Your Screen Size
    var myScreen = $('html').width();

    // Desktop Screen Sizes
    var mdScreenHigh = '975';
    var mdScreenLow = '974';

    // Smaller Screen Sizes
    var smScreenHigh = '751';
    var smScreenLow = '750';

});

$(window).on('resize load', function(){

    if (!$('#menuToggle').is(':visible')) {
        $('.navigation .menu, .sub-menu').css('display', '');
    }

});

// Nav menu toggle
$('#menuToggle').click(function(e) {
    $('.navigation .menu').fadeToggle('fast');
});

$('#menuToggle, .navigation .menu').click(function(e) {
    e.stopPropagation();
});

$('body').click(function(e) {
    if ($('#menuToggle').is(':visible')) {
        $('.navigation .menu').fadeOut('fast');
    }
});

$('.sub-menu-toggle').click(function(e) {
    e.preventDefault();
    $(this).parent().siblings('.sub-menu').toggle();
});


// Sticky nav

var topBarHeight = $('#topBar').height();
var navBarHeight = $('header.header').height();
var scroll = $(window).scrollTop();

$(window).scroll(function() {

    topBarHeight = $('#topBar').height();
    navBarHeight = $('header.header').height();
    scroll = $(window).scrollTop();

    if (scroll >= topBarHeight) {
        $('header.header').addClass('fixed');
        $('#content').css('padding-top', navBarHeight);
    } else {
        $('header.header').removeClass('fixed');
        $('#content').css('padding-top', '');
    }
});

function isIE() {
    if (navigator.appName == 'Microsoft Internet Explorer' || !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv:11/)) || (typeof $.browser !== "undefined" && $.browser.msie == 1)) {
        return true;
    } else {
        return false;
    }
}

function isEdge() {
    if (navigator.userAgent.match(/Edge/)) {
        return true;
    } else {
        return false;
    }
}

if (isIE()) {
    $('html').addClass('ie');
}

if (isEdge()) {
    $('html').addClass('edge');
}
