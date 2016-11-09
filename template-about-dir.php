<?php
/*
 * Template Name: About - Directions
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php $page_sub_heading = get_field( 'page_sub_heading' );
if ( $page_sub_heading ) {
    echo '<div class="container clearfix">';
    echo '<h2>' . $page_sub_heading . '</h2>';
    echo '</div>';
}
$columns = get_field( 'columns' );
if ( $columns ) {
    echo '<div class="container clearfix two-columns bottom-30">';
      foreach ($columns as $new_row ) { echo '<div class="column left-column bottom-30">' . $new_row['left_column'] . '</div>';
                echo '<div class="column right-column bottom-30">' . $new_row['right_column'] . '</div>';
        }
    echo '</div>';
}
?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
