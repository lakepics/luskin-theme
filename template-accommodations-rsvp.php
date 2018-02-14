<?php
/*
 * Template Name: Accomodations - RSVP
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
    $intro_copy = get_field('intro_copy');
    if ($intro_copy) {
        echo '<div class="bottom-30">' . $intro_copy . '</div>';
    }
    if ( $content[0]['left_column'] ) {
        echo '<div class="intro-copy bottom-30">'. $content[0]['left_column'] .'</div>';
    }
    echo '</div>';
}

$secondary_slider = get_field( 'secondary_slider' );
if ( isset($secondary_slider[0]['image']) ) {
    echo '<div class="lemmonslider clearfix top-30">';
    echo '<div id="slider1" class="slider">';
    echo '<ul>';
    foreach ( $secondary_slider as $image ) {
        if ( $image['image'] ) {
            echo '<li><img src="'. $image['image'] .'" alt="" /></li>';
        }
    }
    echo '</ul>';
    echo '</div>
            <div class="controls">
                <a href="#" class="prev-slide">Prev Slide</a>
                <a href="#" class="next-slide">Next Slide</a>
            </div>
        </div>';
}

if ( get_field('reservation_policy')) {
    $reservation_policy = get_field( 'reservation_policy' );
    echo '<div class="reservation-policy">
            <div class="two-columns container clearfix"><h2>AFFILIATION & ELIGIBILITY POLICY</h2>';
    if ( $reservation_policy[0]['left_column'] ) {
        echo '<div class="column left-column">'. $reservation_policy[0]['left_column'] .'</div>';
    }
    if ( $reservation_policy[0]['right_column'] ) {
        echo '<div class="column right-column">'. $reservation_policy[0]['right_column'] .'</div>';
    }
    echo'</div>
        </div>';
}
?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
