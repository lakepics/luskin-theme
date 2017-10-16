<?php
/*
 * Template Name: Sustainability
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
                echo '<div class="res-content bottom-30">' . $intro_copy . '</div>';
                echo '</div>';
            ?>
     <div id="content-heading-and-paragraph">

        <?php
$content_block = get_field( "content_block" );

if ( $content_block ) {
    foreach ( $content_block as $entry ) {
                echo '<div class="clearfix container">';
                    echo '<div class="clearfix entry">';
                        echo '<h3 class="client-contact">' . $entry['content__heading'] . '</h3>';
                        echo '<div class="client-title">' . $entry['content__copy'] . '</div>';
                    echo '</div>';
                echo '</div>';

            }
        }
?>

</div>
        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
