<?php
/*
 * Template Name: News
 */
?>
<?php get_header(); ?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<?php show_hero_slides(); ?>
		<?php $heading = get_field('heading');
				echo '<div class="news"><h1>'. $heading .'</h1></div>';
				?>
		<div class="two-columns container clearfix">
		<?php
			$columns = get_field('columns');
			if( $columns[0]['left_column'] ){
				echo '<div class="news-content column left-column">'. $columns[0]['left_column'] .'</div>';
			}
			if( $columns[0]['right_column'] ){
				echo '<div class="news-content column right-column">'. $columns[0]['right_column'] .'</div>';
			}
		?>
		</div>
		<div class="container clearfix"><br><br>

		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>