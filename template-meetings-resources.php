<?php
/*
 * Template Name: Meetings - Resources
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <div <?php post_class( array('container', 'clearfix') ) ?> id="page-<?php the_ID(); ?>">

        <?php
        $intro_columns = get_field('responsive_columns');
        if( $intro_columns ){

            $section_heading = get_field ('sub_heading');
            if ( $section_heading ) {
                echo '<h2>'. $section_heading .'</h2>';
            }
            ?>

            <div class="bottom-30">
                <?php echo $intro_columns;?>
            </div>

        <?php
        }
        ?>

        <?php
        $event_planning_resources = get_field('event_planning_resources');
        if( $event_planning_resources ){
        ?>

            <div class="event-planning-resources container clearfix">
                <div class="three-columns clearfix bottom-30">
                <?php
                $resources_content = get_field('event_planning_resources');
                if ($resources_content) {
                    $left_column = $resources_content[0]['left_column'][0]['planner_resource'];
                    if ($left_column) { ?>
                    <div class="column left-column">
                        <div class="inner-wrapper">
                            <h3>Meeting Planning Resources</h3>
                            <ul>
                                <?php
                                foreach($left_column as $resource) {
                                    echo '<li><a ';
                                    if ($resource['icon']) {
                                        echo 'class="' . $resource['icon'] . '"';
                                    }
                                    echo 'href="' . $resource['url'] . '">' . $resource['title'] . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    }
                    $middle_column = $resources_content[0]['middle_column'];
                    if ($middle_column) {
                        echo '<div class="column middle-column">' . $middle_column . '</div>';
                    }
                    $right_column = $resources_content[0]['right_column'];
                    if ($right_column) {
                        echo '<div class="column right-column">' . $right_column . '</div>';
                    }

                }
                ?>
                </div>
            </div>

        </div>


        <div class="lax-directions clearfix">
            <div class="lax-dir-wrapper">
                <?php
                if( $event_planning_resources[0]['directions_from_la_airport'][0]['map_image'] ){
                    echo '<img class="map-directions" src="'. $event_planning_resources[0]['directions_from_la_airport'][0]['map_image'] .'" alt="" />';
                }
                if( $event_planning_resources[0]['directions_from_la_airport'][0]['map_image_tablet_landscape'] ){
                    echo '<img class="map-directions map-directions-tablet map-directions-tablet-landscape" src="'. $event_planning_resources[0]['directions_from_la_airport'][0]['map_image_tablet_landscape'] .'" alt="LAX directions map" />';
                }
                if( $event_planning_resources[0]['directions_from_la_airport'][0]['map_image_mobile_landscape'] ){
                    echo '<img class="map-directions map-directions-mobile map-directions-mobile-landscape" src="'. $event_planning_resources[0]['directions_from_la_airport'][0]['map_image_mobile_landscape'] .'" alt="LAX directions map" />';
                }
                if( $event_planning_resources[0]['directions_from_la_airport'][0]['map_image_mobile_portrait'] ){
                    echo '<img class="map-directions map-directions-mobile map-directions-mobile-portrait" src="'. $event_planning_resources[0]['directions_from_la_airport'][0]['map_image_mobile_portrait'] .'" alt="LAX directions map" />';
                }
                ?>
                <div class="textbox">
                <?php
                    if( $event_planning_resources[0]['directions_from_la_airport'][0]['content'] ){
                        echo '<div class="directions-info-block">'. $event_planning_resources[0]['directions_from_la_airport'][0]['content'] .'</div>';
                    }
                ?>
                </div>
            </div>
        </div>

        <?php
        }
        ?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
