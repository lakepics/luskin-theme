<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Luskin
 * @since Luskin 2.0
 */

get_header(); ?>

<div id="main-content teeee" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <div <?php post_class( 'container' ) ?> id="page-<?php the_ID(); ?>">

            <h2 class="entry-title"><?php the_title(); ?></h2>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        </div>

        <?php endwhile; ?>

        <?php
        // Previous/next page navigation.
        the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'luskintheme' ),
                'next_text'          => __( 'Next page', 'luskintheme' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'luskintheme' ) . ' </span>',
            ) );
        ?>

        <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
