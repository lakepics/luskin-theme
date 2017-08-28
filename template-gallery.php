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

        $page_title = get_field('page_title');
        $intro_text = get_field('intro_text');

        if ($page_title) {
            echo '<div class="container clearfix bottom-30"><h1>' . $page_title . '</h1>';
        }

        if ($intro_text) {
            echo '<div>' . $intro_text . '</div></div>';
        }

        foreach ( get_field( 'images', 20 ) as $picture ) {
            $categories[createSlug( $picture['category'] )] =  $picture['category'];
        }

        ?>

        <div class="container clearfix">
            <div class="gallery-filters-wrapper">
               <h2 class="sort-photos">Sort By:</h2>
                <ul id="gallery-filters">
                    <li class="*">show all</li>
                    <li class=".accommodations">Accommodations</li>
                    <li class=".meetings">Meetings</li>
                    <li class=".dining">Dining</li>
                    <li class=".conference-center">Conference Center</li>
                    <li class=".campus">Campus</li>
                    <li class=".video">Video</li>
                </ul>
            </div>
        </div>

        <div id="gallery-container" class="container clearfix">

        <?php
        $pictures = get_field( 'images', 20 );
            // echo '<!-- '. var_dump($picture) . '-->';
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
                  echo '<div class="caption-photos">' . $picture['caption_photo'] . '</div>';
                echo '</a>';
            }
            elseif ( $picture['video'] ) {
                if ( $picture['large_image']['caption'] != '' ) {
                    $imgTitle = $picture['large_image']['caption'];
                } else {
                    $imgTitle = '';
                }
                echo '<a class="fancybox-media" data-fancybox-type="iframe" href="' . $picture['video'] . '">';
                echo '<img class="" src="'. $picture_src[0] .'" alt="'. $imgTitle .'" />';
                    echo '<div class="caption-photos">' . $picture['caption_photo'] . '</div>';
                echo '</a>';
            }
            else {
                echo '<img class="" src="'. $picture_src[0] .'" alt="'. $imgTitle .'" />';
                echo '<div class="caption-photos">' . $picture['caption_photo'] . '</div>';
            }
            echo '</div>';
        }
        ?>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
