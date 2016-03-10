// Gallery JavaScript

(function ($) {

    // gallery slider
    var gallery_slider = $('.gallery > ul').bxSlider({
        mode: 'fade',
        controls: true,
        pagerCustom: '#gallery-bx-pager',
        adaptiveHeight: true,
        touchEnabled: false
    });

    // full width gallery slider
    $('.full-width-gallery > ul').bxSlider({
        mode: 'fade',
        controls: true,
        pager: true,
        adaptiveHeight: true,
        touchEnabled: false
    });

    // gallery controls position hack on tablet
    $(window).load(function () {
        var page_w = $(window).width();
        var img_h = $('.gallery li > img').height();
        //console.log(img_h);
        if (page_w <= 768) {
            $('.gallery .bx-prev, .gallery .bx-next').css('top', img_h / 2);
        } else {
            $('.gallery .bx-prev, .gallery .bx-next').removeAttr('style');
        }
    });

    $(window).resize(function () {
        var page_w = $(window).width();
        var img_h = $('.gallery li > img').height();
        //console.log(img_h);
        if (page_w <= 768) {
            $('.gallery .bx-prev, .gallery .bx-next').css('top', img_h / 2);
        } else {
            $('.gallery .bx-prev, .gallery .bx-next').removeAttr('style');
        }
    });

    // explore UCLA gallery slider mobile nav
    $('#mobile-gallery-nav > .mobile-gallery-nav-select').bind('click touch', function () {
        $(this).next('ul').slideToggle('fast');
    });

    var current_slide_name = $('.gallery ul > li:first-child > .overlay > h4').text();
    $('#mobile-gallery-nav > .mobile-gallery-nav-select').text(current_slide_name);

    $('#mobile-gallery-nav > ul > li').each(function (index) {
        $(this).bind('click touch', function () {
            var current_slide_name = $(this).text();
            $('#mobile-gallery-nav > .mobile-gallery-nav-select').text(current_slide_name);
            $(this).siblings().removeClass('current');
            $(this).addClass('current');
            $(this).parent('ul').slideUp('fast', function () {
                gallery_slider.goToSlide(index);
            });
        });
    });

})(jQuery);