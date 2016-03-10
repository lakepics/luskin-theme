<?php
/*
 * Template Name: Meetings - Resources FAQ
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <div <?php post_class( array( 'container', 'clearfix', 'bottom-30' ) ) ?> id="page-<?php the_ID(); ?>">

        <?php
$section_content = get_field( 'responsive_column_with_header' );
if ( $section_content ) {
    foreach ( $section_content as $content_block ) {
        echo '<div class="container clearfix bottom-30">';
        echo '<h2 class="subhead">' . $content_block['section_heading'] . '</h2>';
        echo '<p>' . $content_block['section_copy'] . '</p>';
        echo '</div>';
    }
}
?>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
