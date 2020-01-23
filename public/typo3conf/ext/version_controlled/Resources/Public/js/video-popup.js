$(document).ready(function(){

    // This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    $(document).on('click','.video-button', function(event){
        
        console.log('clicked video-button');

        // Grab the data-button contents
        var button = $(this).attr('data-button');
        // Turn the data-button attribute into a class
        var button = "." + button;

        // Clean up the name for data-tags
        var videoInfo = $(button);

        // Grab the uid and trailer information
        var uid = $(videoInfo).children(['[data-uid]']).attr('data-uid');
        var trailer = $(videoInfo).children('[data-trailer]').attr('data-trailer');

        if(trailer.indexOf('you') >= 0){
         
            if ( trailer != $('#ocular-slide-video-popup .video-frame').attr('data-video') && uid != $('#ocular-slide-video-popup .full-width-video').attr('data-uid') || $('#ocular-slide-video-popup .video-frame').attr('data-video') && $('#ocular-slide-video-popup .full-width-video').attr('data-uid') == '' ) {
                
                $('#ocular-slide-video-popup iframe, #ocular-slide-video-popup div.video-frame').remove();
                $('#ocular-slide-video-popup .full-width-video').append('<div class="video-frame"></div>');
    
                // Add attributes to lighbox elements
                $('#ocular-slide-video-popup .full-width-video').attr('data-pop', 'video-' + uid);
                $('#ocular-slide-video-popup .full-width-video').attr('data-uid', uid);
                $('#ocular-slide-video-popup .video-frame').attr('data-video', trailer);
                $('#ocular-slide-video-popup .video-frame').attr('id', 'video-frame-' + uid);
    
                onYouTubeIframeAPIReady();
            } else {
                playVideo();
            }
           
            // Show lightbox
            $('#ocular-slide-video-popup').fadeIn();

        } else if (trailer.indexOf('vim') >= 0) {

            $('#ocular-slide-video-popup iframe, #ocular-slide-video-popup div.video-frame').remove();
            $('#ocular-slide-video-popup .full-width-video').append('<div class="video-frame"></div>');

            // Add attributes to lighbox elements
            $('#ocular-slide-video-popup .full-width-video').attr('data-pop', 'video-' + uid);
            $('#ocular-slide-video-popup .full-width-video').attr('data-uid', uid);
            $('#ocular-slide-video-popup .video-frame').attr('data-video', trailer);
            $('#ocular-slide-video-popup .video-frame').attr('id', 'video-frame-' + uid);
            

            var videoName = $('.full-width-video .video-frame').attr('id');
            var src = $('.full-width-video .video-frame').attr('data-video');

            var id = getVimeoId(src);

            var iframe = '<iframe src="https://player.vimeo.com/video/'+ id +'?color=fff&title=0&byline=0&portrait=0&autoplay=1" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
            $('#ocular-slide-video-popup .video-frame').remove();
            $('#ocular-slide-video-popup .full-width-video').html(iframe);


            // Show lightbox
            $('#ocular-slide-video-popup').fadeIn();

        }
        
    });

    // Hide lightbox on click
    $('#ocular-slide-video-popup').click(function(){

        var src = $('#ocular-slide-video-popup iframe').attr('src')

        if ( src.indexOf('you') >= 0 ) {
            // Stop Video
            stopVideo();
        } else if ( src.indexOf('vim') >= 0 ) {
            $('#ocular-slide-video-popup iframe').remove();
        }

        // Hide lightbox
        $('#ocular-slide-video-popup').fadeOut();
    });

    // Stop the closing of lightbox when iframe is clicked
    $('#ocular-slide-video-popup iframe').click(function(e){
        e.stopPropagation();
    });

});

var player;
function onYouTubeIframeAPIReady() {
    var videoName = $('.full-width-video .video-frame').attr('id');
    var src = $('.full-width-video .video-frame').attr('data-video');

    if ( $('.full-width-video .video-frame[data-video]').length ) {
        
        var youtubeRegex = /^(?:(?:https?:\/\/)?(?:www\.)?)?(?:youtube\.com\/\S*(?:(?:\/e(?:mbed))?\/|watch\?(?:\S*?&?v\=))|youtu\.be\/)([a-zA-Z0-9_-]{6,11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:['"][^<>]*>|<\/a>))[?=&+%\w.-]*/g;
        var youtube = src.replace(youtubeRegex,'$1');
        if (src && youtube!=src){
            player = new YT.Player(videoName, {
            height: '720',
            width: '1200',
            videoId: youtube,
                events: {
                    'onReady' : playVideo
                }
            });
        }  
    }
}

// The API will call this function when the video player is ready.
function playVideo() {
    player.playVideo();
}

// Pause all videos
function pauseVideo() {
    player.pauseVideo();
}

// Stop all videos
function stopVideo() {
    player.stopVideo();
}

function getVimeoId( url ) {
    
    // Look for a string with 'vimeo', then whatever, then a
    // forward slash and a group of digits.
    var match = /vimeo.*\/(\d+)/i.exec( url );

    // If the match isn't null (i.e. it matched)
    if ( match ) {
    // The grouped/matched digits from the regex
    return match[1];
    }
}
