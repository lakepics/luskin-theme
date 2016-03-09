<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Luskin
 * @since Luskin 2.0
 */

get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

			<div <?php post_class('container') ?> id="page-<?php the_ID(); ?>">

            	<h2 class="entry-title"><?php the_title(); ?></h2>

	            <div class="entry-content">

					<div class="entry-attachment">
					
						<?php echo wp_get_attachment_image( get_the_ID(), 'large' ); ?>

						<nav id="image-navigation" class="navigation image-navigation">
							<div class="nav-links">
								<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'luskintheme' ) ); ?></div>
								<div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'luskintheme' ) ); ?></div>
							</div>
						</nav>

					</div>

				</div>

	        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
