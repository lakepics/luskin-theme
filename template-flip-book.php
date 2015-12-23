<?php
/*
 * Template Name: Flip Book
 */
?>
<?php get_header('fb'); ?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<div class="clearfix">
		<?php
			$flipbook = get_field('content');
				echo $flipbook;
		?>
		</div>
		<div class="container clearfix"><br><br>

		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>