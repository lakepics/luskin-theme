(function ($) {

    $(document).ready(function () {

        //bind filter on select change
        $('#gallery-filters li').on('click', function () {
            // get filter value from option value
            var filterValue = this.className;
            // use filterFn if matches value
            // filterValue = filterFns[ filterValue ] || filterValue;
            $('#gallery-container').isotope({
                filter: filterValue
            });
        });

    });

    $(window).load(function () {

        // initializing fancybox
        $('#gallery-container .item > a')
            .addClass( "fancybox" )
            .attr('rel', 'gallery');
        $('.fancybox').fancybox({
            padding     : 0,
            margin      : [20, 60, 20, 60], // Increase left/right margin
            closeBtn  : true
        });
        $('.fancybox-media').fancybox({
            padding: 0,
            margin: [20, 60, 20, 60],
            closeBtn: true,
            openEffect  : 'none',
            closeEffect : 'none',
            maxHeight: 460,
            autoSize: false,
            helpers : {
                media : {}
            }
        })
        .removeClass("external")
        .removeAttr("target");

        // isotope
        // $('#gallery-container').isotope({
        //     itemSelector: '.item',
        //     masonry: {
        //       gutter: 20
        //     }
        // });

        // // init Isotope
        // var $grid = $('#gallery-container').isotope({
        //     // options...
        //     itemSelector: '.item',
        //     masonry: {
        //       gutter: 20
        //     }
        // });

        // // layout Isotope after each image loads
        // $grid.imagesLoaded().progress( function() {
        //   $grid.isotope('layout');
        // });



        var $grid = $('#gallery-container').imagesLoaded( function() {
          // init Isotope after all images have loaded
          $grid.isotope({
            // options...
            itemSelector: '.item',
            masonry: {
              gutter: 20
            }
          });
        });

        

        //resize gallery on window change
        $(window).resize(function () {
            resizeGallery();
        });

        //resize gallery initial call
        resizeGallery();

    });

    // set width by device function
    function widthByDevice(origWidth, multiplier, gutter) {

        // create variables
        var columnNum,
            colWidth,
            columnDiff,
            newWidth,
            viewport = $('#gallery-container').width();

        // determine column count
        if (viewport > 900) {

            columnNum = 3;

        } else if (viewport > 600) {

            columnNum = 2;

        } else if (viewport > 300) {

            columnNum = 1;

        }

        // dtermine column spacing
        if (columnNum > 1) {

            colWidth = (viewport - (gutter * (columnNum - 1))) / columnNum;

            columnDiff = 380 - colWidth;

            newWidth = origWidth - (columnDiff * multiplier);
        
        } else {

            columnDiff = 380 - viewport;
            
            // scenario for item--width1;
            if (multiplier == 1) {

                newWidth = origWidth - (columnDiff * multiplier);

            // scenario for item--width2;
            } else if (multiplier == 2) {

                newWidth = (viewport / origWidth) * origWidth;

            }

        }

        // return width
        return Math.floor(newWidth);
    }

    // set resize gallery function
    function resizeGallery() {

        //new classes...
        //galleryHeight01 = h1
        //galleryHeight02 = h2
        //galleryWidth01 = w1
        //galleryWidth02 = w2

        var gutter = 20,
                w1 = 380,
                w2 = 780,
                h1 = 180,
                h2 = 380,
                origWidth, 
                origHeight,
                width;


        $('#gallery-container').find('.item').each(function() {

            if ( $(this).attr('class') ) {

                var classes = $(this).attr('class').split(" "),
                    aspectRatio,
                    height;


                for ( var i = 0, l = classes.length; i<l; ++i ) {

                    // look at the classes assigned to the item
                    // should look something like 'class="item item--width1 item--height1 dining"'

                    // set the width by looking at the second position
                    // for 'item--width1' or 'item--width2'
                    switch (classes[1]) {

                        case "item--width1":
                            origWidth = w1;
                            width = widthByDevice(origWidth, 1, gutter);
                            break;
                        case "item--width2":
                            origWidth = w2;
                            width = widthByDevice(origWidth, 2, gutter);
                            break;
                        default:
                            origWidth = w1;
                            width = widthByDevice(origWidth, 1, gutter);
                            break;

                    }

                    // set the height by looking at the third position 
                    // for 'item--height1' or 'item--height2'
                    switch (classes[2]) {

                        case "item--height1":
                            origHeight = h1;
                            break;
                        case "item--height2":
                            origHeight = h2;
                            break;
                        default:
                            origHeight = h1;
                            break;

                    }
                    
                    // set an aspecdt ratio
                    aspectRatio = width / origWidth;

                    // set the new height
                    height = origHeight * aspectRatio;

                    // set the new image sizes
                    $(this).find('img').css({
                        height:  Math.floor(height),
                        width:  Math.floor(width)
                    });

                }

            }

            // var $item = $(this),
            //     sizes = $item.attr('class').split(' '); // sizes[0] => image width, sizes[1] => image height

            
        });
    }

})(jQuery);
