<?php
/*
 * Template Name: Dining
 */
?>
<?php get_header(); ?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<?php
			//d(get_fields());
		?>

		<?php show_hero_slides(); ?>

		<?php 
		
		echo '<div class="two-columns container clearfix">';
		
		$sub_heading = get_field('sub_heading');
		if ( $sub_heading ) {
			echo '<h2>' . $sub_heading . '</h2>';
			}

		$content = get_field('columns');

		if( $content ){
			if( $content[0]['left_column'] ){
				echo '<div class="column left-column">'. $content[0]['left_column'] .'</div>';
			}
			if( $content[0]['right_column'] ){
				echo '<div class="column right-column">'. $content[0]['right_column'] .'</div>';
			}
			echo '</div>';
		}


			echo '</div>'; 
			echo '<div class="container clearfix">&nbsp;</div>';		
		?>
        
        	<div class="separator-images clearfix">
			<div id="slider1" class="slider">
				<ul>
				<?php
				foreach ( get_field('separator_images') as $image ){
					if( $image['image'] ){
						echo '<li><img src="'. $image['image'] .'" alt="" /></li>';
					}
				}
				?>
				</ul>
			</div>
			<div class="controls">
				<a href="#" class="prev-slide">Prev Slide</a>
				<a href="#" class="next-slide">Next Slide</a>
			</div>
		</div>

		<!--<div class="open-soon">
			<span>Opening <br /><strong>Mid-2016</strong></span>
		</div>-->

		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>