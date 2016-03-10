<?php
/*
 * Template Name: Accomodations - Amenities
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides();

$content = get_field( 'content' );
if ( $content ) {
    echo '<div class="two-columns container clearfix">';
    $subhead = get_field( 'subhead' );
    if ( $subhead ) {
        echo '<h2>' . $subhead . '</h2>';
    }
    if ( $content[0]['left_column'] ) {
        echo '<div class="column left-column">'. $content[0]['left_column'] .'</div>';
    }
    if ( $content[0]['right_column'] ) {
        echo '<div class="column right-column">'. $content[0]['right_column'] .'</div>';
    }
    echo '</div>';
}
?>

        <?php
$amenities = get_field( 'guest_services' );
if ( $amenities ) {
?>
        <div class="container guest-services amenities clearfix">
            <div class="amenities-description">
                <?php echo $amenities[0]['content']; ?>
            </div>
            <div class="services clearfix">
                <?php
    $amenities[0]['amenities'];
    $amenities_count = 0;
    foreach ( $amenities[0]['amenities'] as $service ) {
        if ( $amenities_count%2 == 0 ) {
            echo '<div class="service-wrapper even">';
        } else {
            echo '<div class="service-wrapper odd">';
        }
        echo '<div class="service '. createSlug( $service['icon'] ) .'"><span class="icon"></span><span class="service-name"><span>'. $service['title'] .'</span></span></div>';
        echo '</div>';
        $amenities_count++;
    }
?>
            </div>
        </div>
        <?php
}
?>

        <div class="lemmonslider clearfix">
            <div id="slider1" class="slider">
                <ul>
                <?php
foreach ( get_field( 'separator_images' ) as $image ) {
    if ( $image['image'] ) {
        echo '<li><img src="'. $image['image'] .'" alt="" /></li>';
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
