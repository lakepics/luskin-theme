<?php
/*
 * Template Name: Dining
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <!--// BEGIN HERO //-->

    <?php showHeroSlides(); ?>

    <!--// END HERO //-->

    <!--// BEGIN CONTAINER //-->
    
    <div class="two-columns container clearfix">

        <?php
        $sub_heading = get_field( 'sub_heading' );
        if ( $sub_heading ) {
            echo '<h2>' . $sub_heading . '</h2>';
        }

        $content = get_field( 'columns' );

        if ( $content ) {
            if ( $content[0]['left_column'] ) {
                echo '<div class="column left-column">'. $content[0]['left_column'] .'</div>';
            }
            if ( $content[0]['right_column'] ) {
                echo '<div class="column right-column">'. $content[0]['right_column'] .'</div>';
            }
        }
        ?>

    </div>

    <div class="container clearfix">&nbsp;</div>

    <!--// END CONTAINER //-->

    <!--// BEGIN SLIDER //-->

    <div class="lemmonslider clearfix">
        
        <div id="slider1" class="slider">
            
            <ul>

            <?php
            foreach ( get_field( 'separator_images' ) as $image ) {
                if ( $image['image'] ) {
                    echo '<li><img src="'. $image['image'] .'" alt="" /></li>';
                }
            }
            endwhile;
            ?>

            </ul>

        </div>

        <div class="controls">
            <a href="#" class="prev-slide">Prev Slide</a>
            <a href="#" class="next-slide">Next Slide</a>
        </div>

    </div>

    <!--// END SLIDER //-->


<?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
