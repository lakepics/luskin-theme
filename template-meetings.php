<?php
/*
 * Template Name: Meetings
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides();

$meeting_rooms = get_field( 'content' );
if ( $meeting_rooms ) {
?>
        <div class="meeting-rooms">
            <div class="two-columns container clearfix bottom-30">
                <?php
    if ( get_field( 'content_title' ) ) {
        echo '<h2>'. get_field( 'content_title' ) .'</h2>';
    }
    if ( $meeting_rooms[0]['left_column'] ) {
        echo '<div class="column left-column">'. $meeting_rooms[0]['left_column'] .'</div>';
    }
    if ( $meeting_rooms[0]['right_column'] ) {
        echo '<div class="column right-column">'. $meeting_rooms[0]['right_column'] .'</div>';
    }
?>
            </div>
        </div>
        <?php
}
?>


        <?php
$floorplan = get_field( 'floor_plan' );
if ( $floorplan ) {
?>
        <div class="floorplan">
            <div class="clearfix">
            <?php $section_title = get_field( 'section_title' );
    if ( $section_title ) {
        echo '<h2 class="floorplan-heading">' . $section_title . '</h2>';
    }
?>
                <div class="container floorplan-content clearfix">
                <?php
    if ( $floorplan[0]['floor_plans'] ) {
        echo '<div class="floorplan-plan">';
        //d($floorplan[0]['floor_plans']);
        echo '<div id="floorplans">';
        foreach ( $floorplan[0]['floor_plans'] as $plan ) {
            echo '<div class="floorplan">';
            echo '<h3>'. $plan['caption'] .'</h3>';
            echo '<div class="floorplan-image"><img src="'. $plan['image'] .'" alt="" width="580" height="580" /></div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
    if ( $floorplan[0]['right_column'] ) {
        echo '<div class="floorplan-plan">';
        echo '<div id="floorplans">';
        foreach ( $floorplan[0]['right_column'] as $plan ) {
            echo '<div class="floorplan">';
            echo '<h3>'. $plan['caption'] .'</h3>';
            echo '<div class="floorplan-image"><img src="'. $plan['image'] .'" alt="" width="580" height="580" /></div>';
            echo '</div>';
        }
        echo '<br><div class="centered"><a class="button-alt" title="Download Meeting Room Floor Plans" href="/wp-content/uploads/2015/10/floorplans-and-meeting-room-capacities-151019.pdf" target="_blank">Download Floor Plans and Capacity Chart</a></div>';
        echo '</div>';
        echo '</div>';
    }
?>
                </div>
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

        <?php
$amenities = get_field( 'event_services_amenities' );
if ( $amenities ) {
?>
        <div class="amenities">
            <div class="container clearfix">
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
        </div>
        <?php
}
?>
        <?php $section_text = get_field( 'section_copy' );
if ( $section_text ) {
    echo '<div class="reservation-policy">';
    echo '<div class="two-columns container clearfix">';
    $page_sub_head = get_field( 'section_sub_head' );
    if ( $page_sub_head ) {
        echo '<h2>' . $page_sub_head . '</h2>';
    }
    echo '<div class="res-content res-columns">'. $section_text .'</div>';
    echo '</div>';
    echo '</div>';
}
?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
