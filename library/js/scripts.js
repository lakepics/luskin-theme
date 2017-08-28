/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
 */
function updateViewportDimensions() {
    var w = window,
        d = document,
        e = d.documentElement,
        g = d.getElementsByTagName('body')[0],
        x = w.innerWidth || e.clientWidth || g.clientWidth,
        y = w.innerHeight || e.clientHeight || g.clientHeight;
    return {
        width: x,
        height: y
    };
}
// setting the viewport width
var viewport = updateViewportDimensions();

/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
 */
var waitForFinalEvent = function () {
    var timers = {};
    return function (callback, ms, uniqueId) {
        if (!uniqueId) {
            uniqueId = "Don't call this twice without a uniqueId";
        }
        if (timers[uniqueId]) {
            clearTimeout(timers[uniqueId]);
        }
        timers[uniqueId] = setTimeout(callback, ms);
    };
}();
// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;

/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
 */

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
 */
function loadGravatars() {
    // set the viewport using the function above
    viewport = updateViewportDimensions();
    // if the viewport is tablet or larger, we load in the gravatars
    if (viewport.width >= 768) {
        jQuery('.comment img[data-gravatar]').each(function () {
            jQuery(this).attr('src', jQuery(this).attr('data-gravatar'));
        });
    }
} // end function


/*
 * Put all of your script in here.
 */
(function ($) {
    /*
     * Let's fire off the gravatar function you can remove this if you don't need it
     */
    // loadGravatars();

    //---------------------------------- utils ---------------------------------//

    $('html').addClass('js');

    //add classes to form inputs based on their type
    for (var i = 0, len = document.getElementsByTagName('input').length; i < len; i++) {
        document.getElementsByTagName('input')[i].className += ' ' + document.getElementsByTagName('input')[i].type;
    }

    //open links in new window (target=_blank); checks if the url is external
    var hostname = window.location.hostname,
        links = document.getElementsByTagName('a'),
        pattern = /^https?:\/\/(www.)?/i;

    for (var j = 0, linklen = links.length; j < linklen; j++) {
        if (pattern.test(links[j].href) && links[j].href.toLowerCase().indexOf(hostname) == -1) {
            links[j].target = "_blank";
            links[j].className += ' external';
        }
    }

    //clear form fields on focus
    $('textarea, input:text').bind('focus click', function () {
        if (this.value == this.defaultValue) {
            this.value = '';
        }
    }).bind('blur', function () {
        if (this.value === '') {
            this.value = this.defaultValue;
        }
    });

    //equal height columns function
    function equalHeight(group) {
        var tallest = 0;
        group.each(function () {
            var thisHeight = $(this).height();
            if (thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }
    //equalHeight($("//here put the selector"));

    //------------------------------ other scripts -----------------------------//

    // mobile nav
    $('#main-navigation').clone().insertAfter('.mobile-navigation > a.logo-ucla-mobile').removeAttr('id');
    $('#toggle-menu').bind('click touch', function () {
        // if opened
        if ($('div.mobile-navigation').hasClass('open')) {
            $('div.mobile-navigation').animate({
                width: "0px"
            }, 300).removeClass('open').css({
                'display': 'hidden'
            });
            $('.mobile-navigation > .nav-menu, .mobile-navigation > .mobile-room-reservation').hide();
            $('#container, .not-frontpage #header').animate({
                left: "0px"
            }, 300);
            // if closed
        } else {
            $('div.mobile-navigation').animate({
                width: "300px"
            }, 300).addClass('open').css({
                'display': 'block'
            });
            $('.mobile-navigation > .nav-menu, .mobile-navigation > .mobile-room-reservation').fadeIn(1000);
            $('#container, .not-frontpage #header').animate({
                left: "300px"
            }, 300);
        }
    });

    // toogle room type
    $('.room-types-mobile .room-type-div-toggle').hide();
    $('.room-types-mobile .room-type-div-toggle-trigger').bind('click touch', function () {
        //  $(this).toggleClass('expanded');
        $(this).next('.room-type-div-toggle').slideToggle('fast');
    });

    //________________________________________ Make Videos Play onClick __________________________________//
    /* var video = document.getElementById('video');
    video.addEventListener('click', function () {
        video.play();
    }, false); */

    //---------------------------------------- Reserve Scripts ----------------------------------------//
    //if the submit button is clicked
    $('#submit').click(function (event) {

        /*
        if user selects Not Listed then refreshes page, I want to make sure
        submit button is disabled and message shows.
        */
        if ($('#NotListed').is(':checked')) {
            $('#note').show(300);
            $('input[type=submit]').hide();
            event.preventDefault();
        };

        //if radio is checked, but user didn't fill out group code.
        /* if($('#groupRes').is(':checked')) {

        	if($('input[name=groupCode]').val() == '') {
        		$('input[name=groupCode]').addClass('highlight')
        		return false;
         	}

        	if($('input[name=groupCode]').val().toUpperCase() == '021' || $('input[name=groupCode]').val().toUpperCase() == '15C' || $('input[name=groupCode]').val().toUpperCase() == '10H' || $('input[name=groupCode]').val().toUpperCase() == '02E' || $('input[name=groupCode]').val().toUpperCase() == 'AND12' || $('input[name=groupCode]').val().toUpperCase() == 'YLU2A' || $('input[name=groupCode]').val().toUpperCase() == 'CTA2P' || $('input[name=groupCode]').val().toUpperCase() == 'LEF2A' || $('input[name=groupCode]').val().toUpperCase() == 'MIM2A' || $('input[name=groupCode]').val().toUpperCase() == 'CUC2A' || $('input[name=groupCode]').val().toUpperCase() == 'GSA3B' || $('input[name=groupCode]').val().toUpperCase() == 'ISR1A' || $('input[name=groupCode]').val().toUpperCase() == 'NIH3X' || $('input[name=groupCode]').val().toUpperCase() == 'SBA3V' || $('input[name=groupCode]').val().toUpperCase() == 'TSA4A' || $('input[name=groupCode]').val().toUpperCase() == 'EBS14'

        	|| $('input[name=groupCode]').val().toUpperCase() == 'AIS16'
        	|| $('input[name=groupCode]').val().toUpperCase() == 'CGP16'
        	|| $('input[name=groupCode]').val().toUpperCase() == 'LEP16'
        	|| $('input[name=groupCode]').val().toUpperCase() == 'LIB6A')
        	}
        	else{
        		$('input[name=groupCode]').addClass('highlight')
        		return false;
        	} */
    });

    //if the user clicks inside text box, I remove the highlight class
    $('input[name=groupCode]').focus(function () {
        $(this).removeClass('highlight');
    });

    // hides affiliation note on page load
    $('#note,#gr-note,#ipam-note').hide();

    $('.myRadio').click(function () {
        $('#note').hide(300);
        $('#submit').show();
        $('input[name=groupCode]').removeClass('highlight')
    });

    // show affiliation note on click; hide for others
    $('#NotListed').click(function () {
        $('#note').show(300);
        $('input[type=submit]').hide();
        $('input[name=GroupCode]').removeClass('highlight')
    });

    /*
    if user selects Conference Code then display a note below the selection.
    */
    $('#groupRes').click(function () {
        $('#gr-note').show(300);
        $('#ipam-note').hide();
    });

    /*
    if user selects IPAM Code then display a note below the selection.
    */
    $('#IPAM').click(function () {
        $('#ipam-note').show(300);
        $('#gr-note').hide();
    });



}(jQuery));
