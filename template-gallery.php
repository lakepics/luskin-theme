<?php
/*
 * Template Name: Gallery
 */
?>
<?php get_header(); ?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<?php

			foreach (get_field('images', 20) as $picture){
				$categories[create_slug( $picture['category'])] =  $picture['category'];
			}
			
		?>
		<div class="container clearfix">
			<div class="gallery-filters-wrapper">
				<select id="gallery-filters">
					<option selected="selected" value="*">show all</option>
                    <option value=".accommodations">Accommodations</option>
                    <option value=".meetings">Meetings</option>
					<option value=".dining">Dining</option><option value=".conference-center">Conference Center</option><option value=".campus">Campus</option></select>
			</div>

            
            
				<!-- <select id="gallery-filters">
					<option selected="selected" value="*">show all</option>
					<?php


					foreach ($categories as $key => $value) {
						echo '<option value=".' . $key . '">' . $value .'</option>';
					}
					?>
				</select>
			</div> -->
		</div>

		<div id="gallery-container" class="container clearfix">
		<?php
			$pictures = get_field('images', 20);
			foreach ($pictures as $picture){
				//d($picture);
				$picture_src = wp_get_attachment_image_src($picture['image']['id'], 'full');
				echo '<div class="item '. create_slug( $picture['category'] ) .'">';
				if( $picture['large_image'] ){
					if ($picture['large_image']['caption'] != '') {
						$imgTitle = $picture['large_image']['caption'];
					} else {
						$imgTitle = ' ';
					}
					echo '<a href="'. $picture['large_image']['url'] .'" title="'. $imgTitle .'" rel="masonry-gallery">';
						echo '<img class="'.$picture['css_class'].'" src="'. $picture_src[0] .'" alt="" />';
					echo '</a>';
				} else {
					echo '<img class="'.$picture['css_class'].'" src="'. $picture_src[0] .'" alt="" />';
				}

				echo '</div>';
			}
		?>
		</div>

		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->


<script type="text/javascript">
	/**
	 * [widthByDevice description]
	 * @param  {[type]} origWidth  [description]
	 * @param  {[type]} multiplier [description]
	 * @param  {[type]} gutter     [description]
	 * @return {[type]}            [description]
	 */
	function widthByDevice(origWidth, multiplier, gutter) {
		w = $('#gallery-container').width();
		var columnNum;

		if (w > 900) {
			columnNum = 3;
		} else if (w > 600){
			columnNum = 2;
		} else if (w > 300) {
			columnNum = 1;
		}

		if (columnNum > 1) {
			colWidth = (w - (gutter*(columnNum-1))) / columnNum;
			columnDiff = 380 - colWidth;
			newWidth = origWidth-(columnDiff*multiplier);
		} else {
			colWidth = w;
			columnDiff = 380 - colWidth;
			if (multiplier == 1) {
				newWidth = origWidth-(columnDiff*multiplier);
			} else if (multiplier == 2) {
				newWidth = (w/origWidth)*origWidth;
			}
		}

		return Math.floor(newWidth);
	}

	function resizeGallery() {

		var gutter = 20, w1 = 380, w2 = 780, h1 = 180, h2 = 380;

        $('#gallery-container').find('.item img').each(function() {
            var $item = $(this),
            	sizes = $item.attr('class').split(" ");	// sizes[0] => image width, sizes[1] => image height


	        // define image sizes for different classes
			switch (sizes[0]) {
			    case "w1": origWidth = w1; width = widthByDevice(origWidth, 1, gutter); break;
			    case "w2": origWidth = w2; width = widthByDevice(origWidth, 2, gutter); break;
			}

			switch (sizes[1]) {
			    case "h1": origHeight = h1; break;
			    case "h2": origHeight = h2; break;
			}
			aspectRatio = width / origWidth;

			height = origHeight * aspectRatio;

			// setting the new image sizes
			$item.css({
				width: width,
				height: height
			});
        });
	}

	$( function() {

		resizeGallery();
		$(window).resize(function() {
			resizeGallery()
		});

        // initializing isotope
		$('#gallery-container').isotope({
		  itemSelector: '.item',
			masonry: {
			  // columnWidth: 380,
			  gutter: 20
			}
		})

		// bind filter on select change
		$('#gallery-filters').on( 'change', function() {
			// get filter value from option value
			var filterValue = this.value;
			// use filterFn if matches value
			// filterValue = filterFns[ filterValue ] || filterValue;
			$('#gallery-container').isotope({ filter: filterValue });
		});

	});


</script>

<?php get_footer(); ?>
