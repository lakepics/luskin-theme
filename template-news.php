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
		<?php 
		if( get_field('slides') ) {
			while( has_sub_field('slides') ) { 
				$caption = get_sub_field('caption');
				if ($caption) { 
					echo '<div class="container"><span class="caption">' . $caption . '</span></div>';
					echo '<div class="container clearfix"></div>';
					}
				}
			}
			$heading = get_field('heading');
			echo '<div class="news"><h1>'. $heading .'</h1></div>';
		?>
        <?php 
		$sub_head = get_field('sub_head');
		if ( $sub_head ) {
			echo '<div class="container clearfix">' . $sub_head . '</div>';
			}
		?>
		<div class="two-columns container clearfix">
		<?php
			$article = get_field('article');
				echo '<div class="news-content news-columns">'. $article .'</div>';
		?>
		</div>
		<div class="container clearfix"><br><br>

		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>