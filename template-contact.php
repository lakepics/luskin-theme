<?php
/*
 * Template Name: Contact
 */
?>
<?php get_header(); ?>

<?php

		wp_dequeue_style('gforms_css');

?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<?php
			//d(get_fields());
		?>
		<?php $columns = get_field('columns'); ?>

		<div class="two-columns container clearfix" style="padding-top: 40px;">
	        	<div class="column left-column">
				<?php gravity_form( 3, true, true, false, '', false ); ?>
			</div>
			<div class="column right-column">
				<?php
					$c = 0;
					foreach ($columns[0]['left_column'] as $block) {
						if ($c > 0) {
							$noPrint = 'no-print';
						}

						echo '<div class="contact-block '.$noPrint.'" id="' . $block['id'] .'">';
							echo '<h2>'. $block['title'] .'</h2>';
							echo '<div class="content clearfix">'. $block['content'] .'</div>';
						echo '</div>';
						$c++;
					}
				?>
			</div>
		</div>


<div class="two-columns container clearfix"><p>&nbsp;</p></div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>