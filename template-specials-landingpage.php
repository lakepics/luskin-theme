<?php
/*
 * Template Name: Specials - Landing Page
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php
$intro_text = get_field( 'intro_copy' );
if ( $intro_text ) {
    echo '<div class="two-columns container clearfix">';
    $page_sub_head = get_field( 'page_sub_head' );
    if ( $page_sub_head ) {
        echo '<h1>' . $page_sub_head . '</h1>';
    }
    echo '<div class="res-content bottom-30">'. $intro_text .'</div>';
    echo '</div>';
}
?>

        <div class="specials__main">

        <?php
$special = get_field( "special" );

if ( $special ) {
    foreach ( $special as $entry ) {
                echo '<div class="clearfix container">';
					echo '<div class="clearfix entry">';
						echo '<h1 class="specials__main-heading">' . $entry['heading'] . '</h1>';
                         echo '<img class="client-img" src="'. $entry['image'] .'" alt="' . $entry['image'] . '" />';
						echo '<div class="specials__main-copy">' . $entry['list'] . '</div>';
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
