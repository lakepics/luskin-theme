<?php
/**
 * The template for displaying pages (default)
 *
 * @package WordPress
 * @subpackage Luskin
 * @since Luskin 2.0
 */

get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <div <?php post_class( 'container' ) ?> id="page-<?php the_ID(); ?>">

            <h2 class="entry-title"><?php the_title(); ?></h2>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
