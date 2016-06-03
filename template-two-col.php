<?php
/*
 * Template Name: Basic Two Column Page
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
                echo '<div class="res-columns">' . $intro_copy . '</div>';
                echo '</div>';
            }
            ?>

            <div class="two-columns container clearfix top-30">
            <?php
                $columns = get_field('columns');
                if( $columns[0]['left_column'] ){
                    echo '<div class="column left-column">'. $columns[0]['left_column'] .'</div>';
                }
                if( $columns[0]['right_column'] ){
                    echo '<div class="column right-column">'. $columns[0]['right_column'] .'</div>';
                }
            ?>
            </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
