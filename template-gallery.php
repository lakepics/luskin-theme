<?php
/*
 * Template Name: Gallery
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php

        foreach ( get_field( 'images', 20 ) as $picture ) {
            $categories[createSlug( $picture['category'] )] =  $picture['category'];
        }

        ?>

        <div class="container clearfix">
            <div class="gallery-filters-wrapper">
                <ul id="gallery-filters">
                    <li><a class="*" href="#">show all</a></li>
                    <li><a class=".accommodations" href="#">Accommodations</a></li>
                    <li><a class=".meetings" href="#">Meetings</a></li>
                    <li><a class=".dining" href="#">Dining</a></li>
                    <li><a class=".conference-center" href="#">Conference Center</a></li>
                    <li><a class=".campus" href="#">Campus</a></li>
                </ul>
            </div>
        </div>

        <div id="gallery-container" class="container clearfix">

        <?php
        $pictures = get_field( 'images', 20 );
        foreach ( $pictures as $picture ) {
            $picture_src = wp_get_attachment_image_src( $picture['image']['id'], 'full' );
            echo '<div class="item '. $picture['css_class'] . ' ' . createSlug( $picture['category'] ) .'">';
            if ( $picture['large_image'] ) {
                if ( $picture['large_image']['caption'] != '' ) {
                    $imgTitle = $picture['large_image']['caption'];
                } else {
                    $imgTitle = '';
                }
                echo '<a href="'. $picture['large_image']['url'] .'" title="'. $imgTitle .'">';
                echo '<img class="" src="'. $picture_src[0] .'" alt="'. $imgTitle .'" />';
                echo '</a>';
            } else {
                echo '<img class="" src="'. $picture_src[0] .'" alt="'. $imgTitle .'" />';
            }
            echo '</div>';
        }
        ?>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
