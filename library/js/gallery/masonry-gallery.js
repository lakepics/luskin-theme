(function ($) {

    $(window).load(function () {

        // initializing fancybox
        $('#gallery-container .item > a')
            .addClass( "fancybox" )
            .attr('rel', 'gallery');
        $('.fancybox')
            .fancybox({
                padding     : 0,
                margin      : [20, 60, 20, 60] // Increase left/right margin
            });

        // initializing isotope
        $('#gallery-container').isotope({
            itemSelector: '.item',
            masonry: {
                // columnWidth: 380,
                gutter: 20
            }
        });

        // fake select dropdown on gallery
        $('#gallery-filters').after('<span>' + $('option:selected', this).text() + '</span>');
        $('#gallery-filters').click(function (event) {
            $(this).siblings('span').remove();
            $(this).after('<span>' + $('option:selected', this).text() + '</span>');
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

        // resize gallery on window change
        $(window).resize(function () {
            resizeGallery();
        });

        // resize gallery initial call
        resizeGallery();

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

})(jQuery);