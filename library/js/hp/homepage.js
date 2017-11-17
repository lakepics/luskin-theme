// Homepage JavaScript

(function ($) {

    $(window).load(function () {

        // homepage
        var page_h = $(window).height();

        var header_h = $('#header').height();
        $('#slideshow-container').height(page_h - header_h);

        $(window).resize(function () {
            var page_h = $(window).height();
            var header_h = $('#header').height();
            $('#slideshow-container').height(page_h - header_h);
        });

        // unhide the slideshow node
        $('#slideshow-container').css( "display", "block" );

        var slider = $('#slideshow').bxSlider({
            slideSelector: 'div.slide',
            mode: 'fade',
            auto: true,
            infiniteLoop: true,
            stopAuto: false,
            startSlide: 0,
            autoDelay: 50,
            preloadImages: 'all',
            pause: 8000,
            controls: true,
            pager: true,
            onSlideAfter: function onSlideAfter($slideElement, oldIndex, newIndex) {
                $($slideElement).siblings('.slide').find('.slide-overlay h3').css({
                    opacity: 0
                });
                $($slideElement).siblings('.slide').find('.slide-overlay h4').css({
                    opacity: 0
                });
                setTimeout(function () {
                    $($slideElement).find('.slide-overlay h3').animate({
                        opacity: 1
                    }, 1000);
                    $($slideElement).find('.slide-overlay h4').animate({
                        opacity: 1
                    }, 1000);
                }, 500);
            }
        });

        $('#slideshow-mobile').bxSlider({
            slideSelector: 'div.slide',
            mode: 'fade',
            auto: true,
            infiniteLoop: true,
            stopAuto: false,
            startSlide: 0,
            autoDelay: 500,
            preloadImages: 'all',
            pause: 4000,
            controls: true,
            pager: true,
            onSlideAfter: function onSlideAfter($slideElement, oldIndex, newIndex) {
                $($slideElement).siblings('.slide').find('.slide-overlay h3').css({
                    opacity: 0
                });
                setTimeout(function () {
                    $($slideElement).find('.slide-overlay h3').animate({
                        opacity: 1
                    }, 1000);
                }, 2000);
            }
        });

        $(document).on('click', '.bx-pager-link', function () {
            slider.stopAuto();
            slider.startAuto();
        });

    });
})(jQuery);
