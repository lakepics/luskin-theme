<?php
/*
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<?php
			$buttons = get_field('sidebar_buttons');
			$slides = get_field('slides');

			if($slides){
				echo '<div id="slideshow-container">';

					if($buttons){
						$action_count = 1;
						echo '<div class="action-buttons">';
						foreach ($buttons as $button){
							if( $action_count % 2 == 0 ){
								$action_zebra = 'even';
							} else {
								$action_zebra = 'odd';
							}
							echo '<div class="action-button-wrapper '. $action_zebra .'"><a class="'. create_slug($button['button_type']) .'" href="'. $button['url'] .'"><span><span>'. $button['text'] .'</span></span></a></div>';
							$action_count++;
						}
						echo '</div>';
					}


					echo '<div class="slideshow"><div id="slideshow" class="home-slideshow">';
					foreach ($slides as $slide){
						$image = wp_get_attachment($slide['image']['id']);
						$portrait_image = wp_get_attachment($slide['portrait_image']['id']);

						echo '<div class="slide" style="background-image: url('. $image['src'] .');">';
							echo '<div class="slide-overlay">';
								echo '<h2>'. $slide['title'] .'</h2>';
								echo '<h3 class="tk-adobe-caslon-pro">'. $slide['subtitle'] .'</h3>';
								echo '<h4>'. $slide['orange_title'] .'</h4>';
							echo '</div>';
							echo '<span class="slide-description">'. $slide['description'] .'</span>';
						echo '</div>';
					}
					echo '</div></div>';

					echo '<div class="slideshow-portrait"><div id="slideshow-mobile" class="home-slideshow">';
						foreach ($slides as $slide){
							$portrait_image = wp_get_attachment($slide['portrait_image']['id']);

							echo '<div class="slide" style="background-image: url('. $portrait_image['src'] .');">';
								echo '<div class="slide-overlay">';
									echo '<h2>'. $slide['title'] .'</h2>';
									echo '<h3>'. $slide['subtitle'] .'</h3>';
									echo '<h4>'. $slide['orange_title'] .'</h4>';
								echo '</div>';
								echo '<span class="slide-description">'. $slide['description'] .'</span>';
							echo '</div>';
						}
					echo '</div></div>';

				echo '</div>';
			}
		?>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
