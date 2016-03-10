<?php
/*
 * Template Name: Room Gallery
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <div id="gallery-container" class="container clearfix">

        <?php
    $pictures = get_field( 'room-images', 457 );
foreach ( $pictures as $picture ) {
    $picture_src = wp_get_attachment_image_src( $picture['room-image']['id'], 'full' );
    echo '<div class="item '. createSlug( $picture['category'] ) .'">';
    if ( $picture['large-room-image'] ) {
        if ( $picture['large-room-image']['caption'] != '' ) {
            $imgTitle = $picture['large-room-image']['caption'];
        } else {
            $imgTitle = '';
        }
        echo '<a href="'. $picture['large-room-image']['url'] .'" title="'. $imgTitle .'">';
        echo '<img class="'.$picture['room-gallery-css-class'].'" src="'. $picture_src[0] .'" alt="" />';
        echo '</a>';
    } else {
        echo '<img class="'.$picture['room-gallery-css-class'].'" src="'. $picture_src[0] .'" alt="" />';
    }

    echo '</div>';
}
?>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
