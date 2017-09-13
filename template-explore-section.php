<?php
/*
 * Template Name: Explore Section
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php showHeroSlides();

            $sub_head = get_field('sub_head');
            $intro_copy = get_field('intro_copy');
            if ($sub_head) {
                echo '<div class="container clearfix">';
                echo '<h2 class="subhead">' . $sub_head . '</h2>';
                echo '<div class="res-content bottom-30">' . $intro_copy . '</div>';
                echo '</div>';
            }
            ?>

            <div class="features clearfix">
                <?php
                    $features = get_field('features');
                    echo '<div class="features-column">';
                    foreach ( $features[0]['left_column'] as $feature ){
                        if( $feature['background_image'] ){
                            echo '<div class="feature feature-left" style="background-image: url('. $feature['background_image'] .');">';
                        } else {
                            echo '<div class="feature">';
                        }
                            echo '<div class="feature-wrapper">';
                                if( $feature['icon'] ){
                                    echo '<a href="' . $feature[icon_url] . '"><img class="feature-icon" src="'. $feature['icon'] .'" alt="" /></a>';
                                }
                                echo '<div class="description">'. $feature['content'] .'</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '<div class="features-column">';
                    foreach ( $features[0]['right_column'] as $feature ){
                        if( $feature['background_image'] ){
                            echo '<div class="feature feature-right" style="background-image: url('. $feature['background_image'] .');">';
                        } else {
                            echo '<div class="feature">';
                        }
                            echo '<div class="feature-wrapper">';
                                if( $feature['icon'] ){
                                    echo '<a href="' . $feature[icon_url] . '"><img class="feature-icon" src="'. $feature['icon'] .'" alt="" /></a>';
                                }
                                echo '<div class="description">'. $feature['content'] .'</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                ?>
            </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
