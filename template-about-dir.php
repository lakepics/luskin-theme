<?php
/*
 * Template Name: About - Directions
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <div class="container clearfix bottom-30">
            <div id="gmd-button" class="about-buttons"><a class="button external" target="_blank" href="https://goo.gl/maps/5N55B3oQTKN2">Google Map Directions</a></div>
        </div>
        <?php $page_sub_heading = get_field( 'page_sub_heading' );
if ( $page_sub_heading ) {
    echo '<div class="container clearfix">';
    echo '<h2>' . $page_sub_heading . '</h2>';
    echo '';
    echo '</div>';
}
$columns = get_field( 'columns' );
if ( 'columns' ) {
    echo '<div class="container clearfix two-columns bottom-30">';
    if ( $columns[0]['left_column'] ) {
        echo '<div class="column left-column">'. $columns[0]['left_column'] .'</div>';
    }
    if ( $columns[0]['right_column'] ) {
        echo '<div class="column right-column">'. $columns[0]['right_column'] .'</div>';
    }
    echo '</div>';
}
?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
