<?php
/*
 * Template Name: sustainability
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php showHeroSlides();

            $sub_head = get_field('sub_head');
            $intro_copy = get_field('intro_copy');
                echo '<div class="container clearfix">';
                echo '<div class="res-content">' . $intro_copy . '</div>';
                echo '</div>';
            ?>

        <?php
$content_block = get_field( "content_block" );

if ( $content_block ) {
    foreach ( $content_block as $entry ) {
                echo '<div class="clearfix container content_block">';
                    echo '<div class="clearfix entry">';
                        echo '<h3 class="content_block__heading">' . $entry['content__heading'] . '</h3>';
                        echo '<div class="content_block__copy">' . $entry['content__copy'] . '</div>';
                    echo '</div>';
                echo '</div>';

            }
        }
?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
