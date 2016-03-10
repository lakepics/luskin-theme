<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Luskin
 * @since Luskin 2.0
 */

get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <div <?php post_class( 'container' ) ?> id="page-<?php the_ID(); ?>">

            <h2 class="entry-title"><?php printf( __( 'Search Results for: %s', 'luskintheme' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>

            <?php get_search_form(); ?>

         <?php while ( have_posts() ) : the_post(); ?>

            <div class="entry-content">
                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </div>

         <?php endwhile; ?>

        </div>

        <?php
// Previous/next page navigation.
the_posts_pagination( array(
        'prev_text'          => __( 'Previous page', 'luskintheme' ),
        'next_text'          => __( 'Next page', 'luskintheme' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'luskintheme' ) . ' </span>',
    ) );
?>

    <?php else : ?>

    <div <?php post_class( 'container' ) ?> id="page-<?php the_ID(); ?>">

        <h2 class="entry-title"><?php printf( __( 'Search Results for: %s', 'luskintheme' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>

        <div class="entry-content">
            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'luskintheme' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

            <?php elseif ( is_search() ) : ?>

                <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'luskintheme' ); ?></p>
                <?php get_search_form(); ?>

            <?php else : ?>

                <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'luskintheme' ); ?></p>
                <?php get_search_form(); ?>

            <?php endif; ?>
        </div>

    </div>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
