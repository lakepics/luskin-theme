<?php
/*
 * Template Name: Partner Signup
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

            <div class="container clearfix top-30">
            <?php
                $page_content = get_field('page_content');
                if( $page_content ){
                    echo '<div>'. $page_content .'</div>';
                }
                else {
                    gravity_form( 7, false, true, false, '', false );
                }
             ?>
            </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
