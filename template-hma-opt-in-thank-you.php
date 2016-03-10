<?php
/*
 * Template Name: HMA Opt-In Thank You
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php
echo '<div class="restaurants">';
echo '<div class="two-columns container clearfix bottom-30"><h1>Welcome to the UCLA Meyer &amp; Renee Luskin Conference Center Family!</h1>';

$content = get_field( 'columns-hma-ty' );

if ( $content ) {
    if ( $content[0]['left_column'] ) {
        echo '<div class="column left-column">'. $content[0]['left_column'] .'</div>';
    }
    if ( $content[0]['right_column'] ) {
        echo '<div class="column right-column">'. $content[0]['right_column'] .'</div>';
    }
    echo '</div>';
}


echo '</div>';
echo '</div>';

?>

        <div class="lemmonslider clearfix">
            <div id="slider2" class="slider">
                <ul>
                <?php
foreach ( get_field( 'separator_images_ty' ) as $image ) {
    if ( $image['image-ty'] ) {
        echo '<li><img src="'. $image['image-ty'] .'" alt="" /></li>';
    }
}
?>
                </ul>
            </div>
            <div class="controls">
                <a href="#" class="prev-slide">Prev Slide</a>
                <a href="#" class="next-slide">Next Slide</a>
            </div>
        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
