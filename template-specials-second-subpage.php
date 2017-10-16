<?php
/*
 * Template Name: Specials - 2nd Subpage
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php $intro_text = get_field( 'intro_copy' );
if ( $intro_text ) {
    echo '<div class="two-columns container clearfix">';
    $page_sub_head = get_field( 'page_sub_head' );
    if ( $page_sub_head ) {
        echo '<h2>' . $page_sub_head . '</h2>';
    }
    echo '<div class="res-content res-columns">'. $intro_text .'</div>';
    echo '</div>';
}
?>

        <div class="specials__secondsubpage">

        <?php
$special = get_field( "special" );

if ( $special ) {
    foreach ( $special as $entry ) {
                echo '<div class="clearfix container">';
					echo '<div class="clearfix entry">';
                    echo '<img class="specials__secondsubpage-img" src="'. $entry['image'] .'" alt="' . $entry['image'] . '" />';
						echo '<h1 class="specials__secondsubpage-heading">' . $entry['heading'] . '</h1>';
                        echo '<h4 class="specials__secondsubpage-subheading">' . $entry['subheading'] . '</h4>';
						echo '<div class="specials__secondsubpage-copy">' . $entry['list'] . '</div>';
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
