<?php
/*
 * Template Name: Meetings - Amenities
 */
?>
<?php get_header(); ?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<?php

		show_hero_slides();

		$intro_columns = get_field('responsive_columns');
		if( $intro_columns ){
		?>
		<div class="container clearfix">
			<div class="res-columns">
				<?php echo $intro_columns;?>
			</div>
		</div>
		<?php
		}
		?>

		<?php
		$amenities = get_field('event_services_amenities');
		if( $amenities ){
		?>
		<div class="amenities">
			<div class="container clearfix">
				<div class="amenities-description">
					<?php echo $amenities[0]['content']; ?>
				</div>
				<div class="services clearfix">
                <h2>
                <?php $amenities_header = get_field('amenities_header');
					if ($amenities_header) { echo $amenities_header; }
					?></h2>

					<?php
					$amenities[0]['amenities'];
					$amenities_count = 0;
					foreach ( $amenities[0]['amenities'] as $service ){
						if( $amenities_count%2 == 0 ){
							echo '<div class="service-wrapper even">';
						} else {
							echo '<div class="service-wrapper odd">';
						}

							echo '<div class="service '. create_slug($service['icon']) .'"><span class="icon"></span><span class="service-name"><span>'. $service['title'] .'</span></span></div>';
						echo '</div>';
						$amenities_count++;
					}
					?>
				</div>
			</div>
		</div>
		<?php
		}
		?>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>