<?php
/*
 * Template Name: Partner Program
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides();

$content = get_field( 'content' );
if ( $content ) {
    echo '<div class="two-columns container clearfix">';
    $subhead = get_field( 'subhead' );
    if ( $subhead ) {
        echo '<h2>' . $subhead . '</h2>';
    }
    if ( $content[0]['left_column'] ) {
        echo '<div class="column left-column">'. $content[0]['left_column'] .'</div>';
    }
    if ( $content[0]['right_column'] ) {
        echo '<div class="column right-column">'. $content[0]['right_column'] .'</div>';
    }
    echo '</div>';
}

?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
