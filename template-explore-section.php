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
                                  echo '<a href="' . $feature[icon_url] . '">';
                            echo '<div class="zoom-block"><div class="feature feature-left" style="background-image: url('. $feature['background_image'] .');"><div class="overlay">';
                        } else {
                            echo '<div class="feature">';
                        }
                            echo '<div class="feature-wrapper"><img class="feature-icon" src="'. $feature['icon'] .'" alt="" />';

                                echo '<div class="description">'. $feature['content'] .'</div><div class="button" style="background-color: transparent;margin-top: 0px;background-color: transparent;background-image: url(/wp-content/themes/luskin/library/images/button-arrows.png);background-position: right -238px;background-repeat: no-repeat;color: #FFFFFF !important;display: inline-block;font-family: &quot;Proxima Nova Semibold&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;min-height: 42px;letter-spacing: 0.05em;line-height: 24px;margin: 0;padding: 10px 50px 10px 20px;text-transform: uppercase;zoom: 1;">Read More</div>';
                            echo '</div>';
                        echo '</div></div></div>';
                    }
                    echo '</div></a>';
                    echo '<div class="features-column">';
                    foreach ( $features[0]['right_column'] as $feature ){
                        if( $feature['background_image'] ){
                                echo '<a href="' . $feature[icon_url] . '">';
                            echo '<div class="zoom-block"><div class="feature feature-right" style="background-image: url('. $feature['background_image'] .');"><div class="overlay">';
                        } else {
                            echo '<div class="feature">';
                        }
                            echo '<div class="feature-wrapper"><img class="feature-icon" src="'. $feature['icon'] .'" alt="" />';
 
                                echo '<div class="description">'. $feature['content'] .'</div><div class="button" style="background-color: transparent;margin-top: 0px;background-color: transparent;background-image: url(/wp-content/themes/luskin/library/images/button-arrows.png);background-position: right -238px;background-repeat: no-repeat;color: #FFFFFF !important;display: inline-block;font-family: &quot;Proxima Nova Semibold&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;min-height: 42px;letter-spacing: 0.05em;line-height: 24px;margin: 0;padding: 10px 50px 10px 20px;text-transform: uppercase;zoom: 1;">Read More</div>';
                            echo '</div>';
                        echo '</div></div></div>';
                    }
                    echo '</div></a>';
                ?>
            </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
