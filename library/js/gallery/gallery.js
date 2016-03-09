'use strict';

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

    // masonry gallery
    $('#gallery-container .item > a').fancybox({
        padding: 3,
        margin: 0
    });

    //gallery controls position hack on tablet
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

    // fake select dropdown on gallery
    $(document).ready(function () {
        $('#gallery-filters').after('<span>' + $('option:selected', this).text() + '</span>');

        $('#gallery-filters').click(function (event) {
            $(this).siblings('span').remove();
            $(this).after('<span>' + $('option:selected', this).text() + '</span>');
        });
    });

    // set width by device function
    function widthByDevice(origWidth, multiplier, gutter) {

        var w = $('#gallery-container').width();
        var columnNum, colWidth, columnDiff, newWidth;

        if (w > 900) {
            columnNum = 3;
        } else if (w > 600) {
            columnNum = 2;
        } else if (w > 300) {
            columnNum = 1;
        }

        if (columnNum > 1) {
            colWidth = (w - gutter * (columnNum - 1)) / columnNum;
            columnDiff = 380 - colWidth;
            newWidth = origWidth - columnDiff * multiplier;
        } else {
            colWidth = w;
            columnDiff = 380 - colWidth;
            if (multiplier == 1) {
                newWidth = origWidth - columnDiff * multiplier;
            } else if (multiplier == 2) {
                newWidth = w / origWidth * origWidth;
            }
        }

        return Math.floor(newWidth);
    }

    // set resize gallery function
    function resizeGallery() {

        var gutter = 20,
            w1 = 380,
            w2 = 780,
            h1 = 180,
            h2 = 380;

        $('#gallery-container').find('.item img').each(function () {
            var $item = $(this),
                sizes = $item.attr('class').split(" "); // sizes[0] => image width, sizes[1] => image height

            // define image sizes for different classes by calling width by device function
            var origWidth, width;
            switch (sizes[0]) {
                case "w1":
                    origWidth = w1;
                    width = widthByDevice(origWidth, 1, gutter);
                    break;
                case "w2":
                    origWidth = w2;
                    width = widthByDevice(origWidth, 2, gutter);
                    break;
            }

            var origHeight;
            switch (sizes[1]) {
                case "h1":
                    origHeight = h1;
                    break;
                case "h2":
                    origHeight = h2;
                    break;
            }
            var aspectRatio = width / origWidth;

            var height = origHeight * aspectRatio;

            // setting the new image sizes
            $item.css({
                width: width,
                height: height
            });
        });
    }

    // get resize gallery function
    $(function () {

        // resize gallery
        resizeGallery();

        // resize gallery on window change
        $(window).resize(function () {
            resizeGallery();
        });

        // initializing isotope
        $('#gallery-container').isotope({
            itemSelector: '.item',
            masonry: {
                // columnWidth: 380,
                gutter: 20
            }
        });

        // bind filter on select change
        $('#gallery-filters').on('change', function () {
            // get filter value from option value
            var filterValue = this.value;
            // use filterFn if matches value
            // filterValue = filterFns[ filterValue ] || filterValue;
            $('#gallery-container').isotope({
                filter: filterValue
            });
        });
    });
})(jQuery);