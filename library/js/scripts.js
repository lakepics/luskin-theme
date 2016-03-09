'use strict';

/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
 */

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
 * Put all of your regular jQuery in here.
 */
jQuery(document).ready(function ($) {

    /*
     * Let's fire off the gravatar function
     * You can remove this if you don't need it
     */
    // loadGravatars();

    /*
     * Theme functions
     *
     * Contains handlers for navigation, accessibility, header sizing
     * footer widgets and Featured Content slider
     */
    var body = $('body'),
        _window = $(window),
        nav,
        button,
        menu;

    nav = $('#primary-navigation');
    button = nav.find('.menu-toggle');
    menu = nav.find('.nav-menu');

    // Enable menu toggle for small screens.
    (function () {
        if (!nav || !button) {
            return;
        }

        // Hide button if menu is missing or empty.
        if (!menu || !menu.children().length) {
            button.hide();
            return;
        }

        button.on('click.twentyfourteen', function () {
            nav.toggleClass('toggled-on');
            if (nav.hasClass('toggled-on')) {
                $(this).attr('aria-expanded', 'true');
                menu.attr('aria-expanded', 'true');
            } else {
                $(this).attr('aria-expanded', 'false');
                menu.attr('aria-expanded', 'false');
            }
        });
    })();

    /*
     * Makes "skip to content" link work correctly in IE9 and Chrome for better
     * accessibility.
     *
     * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
     */
    _window.on('hashchange.twentyfourteen', function () {
        var hash = location.hash.substring(1),
            element;

        if (!hash) {
            return;
        }

        element = document.getElementById(hash);

        if (element) {
            if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
                element.tabIndex = -1;
            }

            element.focus();

            // Repositions the window on jump-to-anchor to account for header height.
            window.scrollBy(0, -80);
        }
    });

    $(function () {

        // Search toggle.
        $('.search-toggle').on('click.twentyfourteen', function (event) {
            var that = $(this),
                wrapper = $('#search-container'),
                container = that.find('a');

            that.toggleClass('active');
            wrapper.toggleClass('hide');

            if (that.hasClass('active')) {
                container.attr('aria-expanded', 'true');
            } else {
                container.attr('aria-expanded', 'false');
            }

            if (that.is('.active') || $('.search-toggle .screen-reader-text')[0] === event.target) {
                wrapper.find('.search-field').focus();
            }
        });

        /*
         * Fixed header for large screen.
         * If the header becomes more than 48px tall, unfix the header.
         *
         * The callback on the scroll event is only added if there is a header
         * image and we are not on mobile.
         */
        if (_window.width() > 781) {
            var mastheadHeight = $('#masthead').height(),
                toolbarOffset,
                mastheadOffset;

            if (mastheadHeight > 48) {
                body.removeClass('masthead-fixed');
            }

            if (body.is('.header-image')) {
                toolbarOffset = body.is('.admin-bar') ? $('#wpadminbar').height() : 0;
                mastheadOffset = $('#masthead').offset().top - toolbarOffset;

                _window.on('scroll.twentyfourteen', function () {
                    if (_window.scrollTop() > mastheadOffset && mastheadHeight < 49) {
                        body.addClass('masthead-fixed');
                    } else {
                        body.removeClass('masthead-fixed');
                    }
                });
            }
        }

        // Focus styles for menus.
        $('.primary-navigation, .secondary-navigation').find('a').on('focus.twentyfourteen blur.twentyfourteen', function () {
            $(this).parents().toggleClass('focus');
        });
    });

    /**
     * @summary Add or remove ARIA attributes.
     * Uses jQuery's width() function to determine the size of the window and add
     * the default ARIA attributes for the menu toggle if it's visible.
     * @since Twenty Fourteen 1.4
     */
    function onResizeARIA() {

        if (781 > _window.width()) {
            button.attr('aria-expanded', 'false');
            menu.attr('aria-expanded', 'false');
            button.attr('aria-controls', 'primary-menu');
        } else {
            button.removeAttr('aria-expanded');
            menu.removeAttr('aria-expanded');
            button.removeAttr('aria-controls');
        }
    }

    _window.on('load.twentyfourteen', onResizeARIA).on('resize.twentyfourteen', function () {
        onResizeARIA();
    });

    _window.load(function () {
        // Arrange footer widgets vertically.
        if ($.isFunction($.fn.masonry)) {
            $('#footer-sidebar').masonry({
                itemSelector: '.widget',
                columnWidth: function columnWidth(containerWidth) {
                    return containerWidth / 4;
                },
                gutterWidth: 0,
                isResizable: true,
                isRTL: $('body').is('.rtl')
            });
        }

        // Initialize Featured Content slider.
        if (body.is('.slider')) {
            $('.featured-content').featuredslider({
                selector: '.featured-content-inner > article',
                controlsContainer: '.featured-content'
            });
        }
    });

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

    for (var i = 0, len = links.length; i < len; i++) {
        if (pattern.test(links[i].href) && links[i].href.toLowerCase().indexOf(hostname) == -1) {
            links[i].target = "_blank";
            links[i].className += ' external';
        }
    }

    //clear form fields on focus
    $('textarea, input:text').bind('focus click', function () {
        if (this.value == this.defaultValue) {
            this.value = '';
        }
    }).bind('blur', function () {
        if (this.value == '') {
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
        if ($('div.mobile-navigation').hasClass('open')) {
            $('div.mobile-navigation').animate({
                width: "0px"
            }, 300).removeClass('open').css({
                'display': 'hidden'
            });
            $('#container, .not-frontpage #header').animate({
                left: "0px"
            }, 300);
        } else {
            $('div.mobile-navigation').animate({
                width: "300px"
            }, 300).addClass('open').css({
                'display': 'block'
            });;
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

    // imgCentering
    (function () {
        // $(".lax-dir-wrapper img").imgCentering({
        //   'forceSmart': true,   //centering without showing background
        //   //'forceWidth': true,   //centering with fix width
        //   //'forceHeight': true,  //centering with fix height
        //   'bgColor': '#CCC'     //empty space color
        // });
    })();

    $(function () {});
});