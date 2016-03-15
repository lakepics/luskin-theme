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
                <select id="gallery-filters">
                    <option selected="selected" value="*">show all</option>
                    <option value=".accommodations">Accommodations</option>
                    <option value=".meetings">Meetings</option>
                    <option value=".dining">Dining</option>
                    <option value=".conference-center">Conference Center</option>
                    <option value=".campus">Campus</option>
                </select>
            </div>
        </div>

        <div id="gallery-container" class="container clearfix">
            <div class="sizer"></div>

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
