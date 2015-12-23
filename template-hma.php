<?php
/*
 * Template Name: HMA Opt-In
 */
?>

<?php get_header('hma'); ?>  

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class('container') ?> id="page-<?php the_ID(); ?>">
				<h2 class="entry-title hma-title">Join Our Email List</h2>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?> 